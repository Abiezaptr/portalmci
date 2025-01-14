<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        // Cek apakah session user_id ada, jika tidak redirect ke halaman login
        if (!$this->session->userdata('id')) {
            redirect('login'); // Ganti 'login' sesuai dengan route halaman login Anda
        }
    }

    public function index()
    {
        $data['title'] = 'Forum';

        // Ambil semua thread dengan join ke tabel category
        $this->db->select('forum_threads.*, forum_category.name AS category_name');
        $this->db->from('forum_threads');
        $this->db->join('forum_category', 'forum_threads.category_id = forum_category.id');
        $this->db->order_by('forum_threads.created_at', 'DESC'); // Mengurutkan secara descending berdasarkan kolom id  
        $this->db->limit(5); // Menambahkan limit di sini  
        $query = $this->db->get();
        $data['threads'] = $query->result_array();

        // Loop through threads to fetch users based on user_ids
        foreach ($data['threads'] as &$thread) {
            // Split user_ids string into array
            $user_ids = explode(',', $thread['user_id']);

            // Filter out invalid user_ids (0 or empty)
            $valid_user_ids = array_filter($user_ids, function ($id) {
                return !empty($id) && $id !== '0'; // Saring user_id yang tidak kosong dan bukan 0
            });

            // Get users data by user_id array only if there are valid user_ids
            if (!empty($valid_user_ids)) {
                $this->db->select('username');
                $this->db->where_in('id', $valid_user_ids);
                $queryUsers = $this->db->get('users');
                $thread['users'] = $queryUsers->result_array();
            } else {
                $thread['users'] = []; // Set to empty array if no valid user_ids
            }

            // Hitung jumlah kontribusi yang valid
            $thread['contribution_count'] = count($valid_user_ids); // Menghitung jumlah user_id yang valid
        }

        // Ambil semua kategori dari tabel forum_category
        $queryCategories = $this->db->get('forum_category');
        $data['categories'] = $queryCategories->result_array();

        // Initialize a variable to track relevant notifications
        $relevant_notifications = [];

        // Fetch user logs (only for the current user)
        $user_logs = $this->user_log();
        foreach ($user_logs as $log) {
            $relevant_notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        // Fetch upload logs
        $upload_logs = $this->get_upload_logs();
        foreach ($upload_logs as $log) {
            // Check if the report is related to the current user
            if ($log->user_id == $this->session->userdata('id')) {
                $relevant_notifications[] = [
                    'type' => 'upload_log',
                    'message' => $log->username . ' ' . $log->message . '.',
                    'timestamp' => $log->upload_time
                ];
            }
        }

        // Fetch user read logs
        $user_read_logs = $this->get_user_read_logs();
        foreach ($user_read_logs as $log_id) {
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $relevant_notifications[] = [
                    'type' => 'user_read_log',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time
                ];
            }
        }

        // Fetch invitation thread logs
        $invitation_thread_logs = $this->get_invitation_thread_logs();
        foreach ($invitation_thread_logs as $log) {
            $user_ids = explode(',', $log->user_id);
            foreach ($user_ids as $user_id) {
                if ($user_id == $this->session->userdata('id')) { // Check if the user is the current user
                    $relevant_notifications[] = [
                        'type' => 'invitation_thread_log',
                        'message' => $log->message,
                        'timestamp' => $log->invitation_time
                    ];
                }
            }
        }

        // Sort notifications by timestamp
        usort($relevant_notifications, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Limit the number of notifications displayed
        $data['notifications'] = array_slice($relevant_notifications, 0, 5);

        // Count only relevant notifications
        $data['total_relevant_notifications'] = count($relevant_notifications);

        // Load the views with the data
        $this->load->view('template/content/header', $data);
        $this->load->view('forum/list', $data);
        $this->load->view('template/content/footer');
    }

    public function all_topic()
    {
        $data['title'] = 'Topic List';

        // Konfigurasi pagination  
        $this->load->library('pagination');
        $config['base_url'] = site_url('forum/all_topic'); // URL pagination  
        $config['per_page'] = 9; // Jumlah artikel per halaman  
        $config['uri_segment'] = 3; // Posisi segmen di URL  

        // Hitung total jumlah thread untuk pagination  
        $config['total_rows'] = $this->db->count_all('forum_threads');

        // Customisasi tampilan pagination dengan Bootstrap  
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        // Ambil data artikel sesuai halaman  
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['threads'] = $this->db->select('forum_threads.*, forum_category.name AS category_name')
            ->from('forum_threads')
            ->join('forum_category', 'forum_threads.category_id = forum_category.id') // Pastikan join dilakukan  
            ->order_by('forum_threads.created_at', 'DESC')
            ->limit($config['per_page'], $page)
            ->get()
            ->result_array();

        $data['pagination'] = $this->pagination->create_links(); // Buat link pagination  

        // Initialize a variable to track relevant notifications  
        $relevant_notifications = [];

        // Fetch user logs (only for the current user)  
        $user_logs = $this->user_log();
        foreach ($user_logs as $log) {
            $relevant_notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        // Fetch upload logs  
        $upload_logs = $this->get_upload_logs();
        foreach ($upload_logs as $log) {
            // Check if the report is related to the current user  
            if ($log->user_id == $this->session->userdata('id')) {
                $relevant_notifications[] = [
                    'type' => 'upload_log',
                    'message' => $log->username . ' ' . $log->message . '.',
                    'timestamp' => $log->upload_time
                ];
            }
        }

        // Fetch user read logs  
        $user_read_logs = $this->get_user_read_logs();
        foreach ($user_read_logs as $log_id) {
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $relevant_notifications[] = [
                    'type' => 'user_read_log',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time
                ];
            }
        }

        // Fetch invitation thread logs  
        $invitation_thread_logs = $this->get_invitation_thread_logs();
        foreach ($invitation_thread_logs as $log) {
            $user_ids = explode(',', $log->user_id);
            foreach ($user_ids as $user_id) {
                if ($user_id == $this->session->userdata('id')) { // Check if the user is the current user  
                    $relevant_notifications[] = [
                        'type' => 'invitation_thread_log',
                        'message' => $log->message,
                        'timestamp' => $log->invitation_time
                    ];
                }
            }
        }

        // Sort notifications by timestamp  
        usort($relevant_notifications, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Limit the number of notifications displayed  
        $data['notifications'] = array_slice($relevant_notifications, 0, 5);

        // Count only relevant notifications  
        $data['total_relevant_notifications'] = count($relevant_notifications);

        // Load view dengan data  
        $this->load->view('template/content/header', $data);
        $this->load->view('forum/all_topic', $data);
        $this->load->view('template/content/footer');
    }


    // Update the user_log function to filter by the current user
    public function user_log()
    {
        $user_id = $this->session->userdata('id'); // Get the current user's ID
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.id', $user_id); // Filter by the current user's ID
        $this->db->where('users.status', 'NONAKTIF'); // Adding condition for inactive status
        $this->db->order_by('users.created_at', 'DESC'); // Sort by user creation time
        $this->db->limit(5); // Get a maximum of 5 entries
        $query = $this->db->get();
        return $query->result();
    }

    // Method untuk mengambil semua log
    public function get_upload_logs()
    {
        $this->db->select('report_log.*, users.username, reports.title as document_name');
        $this->db->from('report_log');
        $this->db->join('users', 'report_log.user_id = users.id');
        $this->db->join('reports', 'report_log.report_id = reports.id');
        $this->db->order_by('upload_time', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user_read_logs()
    {
        $user_id = $this->session->userdata('id');
        $this->db->select('log_id');
        $this->db->from('user_read_logs');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return array_column($query->result_array(), 'log_id');
    }

    public function get_invitation_thread_logs()
    {
        $this->db->select('invitation_thread_log.*, invited_by_users.username as invited_by_username');
        $this->db->from('invitation_thread_log');
        $this->db->join('users as invited_by_users', 'invitation_thread_log.invited_by = invited_by_users.id');
        $this->db->order_by('invitation_thread_log.invitation_time', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    public function category($category_id)
    {
        // Ambil semua kategori untuk ditampilkan
        $query_all = $this->db->get('forum_category');
        $data['forum_category'] = $query_all->result_array(); // Ambil semua kategori untuk menampilkan menu

        // Filter kategori yang dipilih berdasarkan ID
        $query = $this->db->get_where('forum_category', ['id' => $category_id]);

        // Cek apakah kategori ada
        if ($query->num_rows() > 0) {
            $selected_category = $query->row_array(); // Ambil kategori yang dipilih sebagai array
            $data['selected_category'] = $selected_category['name']; // Ambil nama kategori yang dipilih
            $data['title'] = $selected_category['name']; // Set judul dengan nama kategori yang dipilih

            // Ambil thread berdasarkan kategori yang dipilih
            $this->db->select('forum_threads.*, forum_category.name as category_name');
            $this->db->from('forum_threads');
            $this->db->join('forum_category', 'forum_threads.category_id = forum_category.id');
            $this->db->where('forum_category.id', $category_id);
            $query_threads = $this->db->get();
            $data['threads'] = $query_threads->result_array(); // Ambil semua thread terkait kategori

            // Loop through threads to fetch users based on user_ids
            foreach ($data['threads'] as &$thread) {
                // Split user_ids string into array
                $user_ids = explode(',', $thread['user_id']);

                // Filter out invalid user_ids (0 or empty)
                $valid_user_ids = array_filter($user_ids, function ($id) {
                    return !empty($id) && $id !== '0'; // Saring user_id yang tidak kosong dan bukan 0
                });

                // Get users data by user_id array only if there are valid user_ids
                if (!empty($valid_user_ids)) {
                    $this->db->select('username');
                    $this->db->where_in('id', $valid_user_ids);
                    $queryUsers = $this->db->get('users');
                    $thread['users'] = $queryUsers->result_array();
                } else {
                    $thread['users'] = []; // Set to empty array if no valid user_ids
                }

                // Hitung jumlah kontribusi yang valid
                $thread['contribution_count'] = count($valid_user_ids); // Menghitung jumlah user_id yang valid
            }
        } else {
            // Jika kategori tidak ditemukan, redirect atau tangani error
            $data['selected_category'] = null;
            $data['title'] = 'Kategori tidak ditemukan'; // Set judul jika kategori tidak ada
            $data['threads'] = []; // Kosongkan thread jika kategori tidak ada
        }

        // Filter kategori untuk menghindari kategori yang sedang dipilih
        $data['other_categories'] = array_filter($data['forum_category'], function ($category) use ($category_id) {
            return $category['id'] != $category_id; // Ambil kategori lain yang ID-nya tidak sama dengan kategori saat ini
        });

        // Initialize a variable to track relevant notifications
        $relevant_notifications = [];

        // Fetch user logs (only for the current user)
        $user_logs = $this->user_log();
        foreach ($user_logs as $log) {
            $relevant_notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        // Fetch upload logs
        $upload_logs = $this->get_upload_logs();
        foreach ($upload_logs as $log) {
            // Check if the report is related to the current user
            if ($log->user_id == $this->session->userdata('id')) {
                $relevant_notifications[] = [
                    'type' => 'upload_log',
                    'message' => $log->username . ' ' . $log->message . '.',
                    'timestamp' => $log->upload_time
                ];
            }
        }

        // Fetch user read logs
        $user_read_logs = $this->get_user_read_logs();
        foreach ($user_read_logs as $log_id) {
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $relevant_notifications[] = [
                    'type' => 'user_read_log',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time
                ];
            }
        }

        // Fetch invitation thread logs
        $invitation_thread_logs = $this->get_invitation_thread_logs();
        foreach ($invitation_thread_logs as $log) {
            $user_ids = explode(',', $log->user_id);
            foreach ($user_ids as $user_id) {
                if ($user_id == $this->session->userdata('id')) { // Check if the user is the current user
                    $relevant_notifications[] = [
                        'type' => 'invitation_thread_log',
                        'message' => $log->message,
                        'timestamp' => $log->invitation_time
                    ];
                }
            }
        }

        // Sort notifications by timestamp
        usort($relevant_notifications, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Limit the number of notifications displayed
        $data['notifications'] = array_slice($relevant_notifications, 0, 5);

        // Count only relevant notifications
        $data['total_relevant_notifications'] = count($relevant_notifications);

        // Load view dengan kategori yang difilter dan nama kategori yang dipilih
        $this->load->view('template/content/header', $data);
        $this->load->view('forum/forum_view', $data);
        $this->load->view('template/content/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Forum Discussion';

        // Increment views count for the thread
        $this->db->set('views_count', 'views_count+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('forum_threads');

        // Get the current user's ID
        $current_user_id = $this->session->userdata('id');

        // Fetch the thread details
        $this->db->select('forum_threads.*, forum_category.name AS category_name');
        $this->db->from('forum_threads');
        $this->db->where('forum_threads.id', $id);
        $this->db->join('forum_category', 'forum_threads.category_id = forum_category.id', 'left');
        $thread = $this->db->get()->row_array();

        // Check if the current user is authorized to comment
        if ($current_user_id) {
            // Use LIKE to check if the user_id exists in the comma-separated list in `forum_threads.user_id`
            $this->db->like('user_id', $current_user_id);
            $this->db->from('forum_threads');
            $this->db->where('id', $id);
            $is_authorized = $this->db->count_all_results() > 0;
        } else {
            $is_authorized = false;
        }

        // Query to fetch comments and replies
        $comments = $this->db->select('comments.*, 
                        replies.id AS reply_id, 
                        replies.name AS reply_name, 
                        replies.reply_text, 
                        replies.likes AS reply_likes, 
                        replies.unlikes AS reply_unlikes, 
                        replies.created_at AS reply_created_at, 
                        replies.parent_id AS reply_parent_id,
                        users.username,
                        users.job_title,
                        parent_replies.name AS parent_name')
            ->from('forum_comments AS comments')
            ->join('forum_replies AS replies', 'replies.comment_id = comments.id', 'left')
            ->join('users', 'users.id = comments.user_id', 'left')
            ->join(
                'forum_replies AS parent_replies',
                'replies.parent_id = parent_replies.id',
                'left'
            )
            ->where('comments.thread_id', $id)
            ->order_by('comments.created_at', 'ASC')
            ->order_by('replies.created_at', 'ASC')
            ->get()
            ->result_array();

        // Organize comments and replies
        $data['comments'] = [];
        foreach ($comments as $comment) {
            if (!isset($data['comments'][$comment['id']])) {
                $data['comments'][$comment['id']] = $comment;
                $data['comments'][$comment['id']]['replies'] = [];
            }
            if ($comment['reply_id']) {
                $reply = [
                    'id' => $comment['reply_id'],
                    'name' => $comment['reply_name'],
                    'reply_text' => $comment['reply_text'],
                    'likes' => $comment['reply_likes'],
                    'unlikes' => $comment['reply_unlikes'],
                    'created_at' => $comment['reply_created_at'],
                    'parent_id' => $comment['reply_parent_id'],
                    'parent_name' => $comment['parent_name'] ? $comment['parent_name'] : $comment['name']
                ];
                $data['comments'][$comment['id']]['replies'][] = $reply;
            }
        }

        // Count the number of comments on the thread
        $data['comment_count'] = $this->db->where('thread_id', $id)
            ->from('forum_comments')
            ->count_all_results();

        // Pass data to the view
        $data['thread'] = $thread;
        $data['is_authorized'] = $is_authorized; // Pass authorization status to the view

        // Initialize a variable to track relevant notifications
        $relevant_notifications = [];

        // Fetch user logs (only for the current user)
        $user_logs = $this->user_log();
        foreach ($user_logs as $log) {
            $relevant_notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        // Fetch upload logs
        $upload_logs = $this->get_upload_logs();
        foreach ($upload_logs as $log) {
            // Check if the report is related to the current user
            if ($log->user_id == $this->session->userdata('id')) {
                $relevant_notifications[] = [
                    'type' => 'upload_log',
                    'message' => $log->username . ' ' . $log->message . '.',
                    'timestamp' => $log->upload_time
                ];
            }
        }

        // Fetch user read logs
        $user_read_logs = $this->get_user_read_logs();
        foreach ($user_read_logs as $log_id) {
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $relevant_notifications[] = [
                    'type' => 'user_read_log',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time
                ];
            }
        }

        // Fetch invitation thread logs
        $invitation_thread_logs = $this->get_invitation_thread_logs();
        foreach ($invitation_thread_logs as $log) {
            $user_ids = explode(',', $log->user_id);
            foreach ($user_ids as $user_id) {
                if ($user_id == $this->session->userdata('id')) { // Check if the user is the current user
                    $relevant_notifications[] = [
                        'type' => 'invitation_thread_log',
                        'message' => $log->message,
                        'timestamp' => $log->invitation_time
                    ];
                }
            }
        }

        // Sort notifications by timestamp
        usort($relevant_notifications, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Limit the number of notifications displayed
        $data['notifications'] = array_slice($relevant_notifications, 0, 5);

        // Count only relevant notifications
        $data['total_relevant_notifications'] = count($relevant_notifications);

        // Load the views
        $this->load->view('template/content/header', $data);
        $this->load->view('forum/detail', $data);
        $this->load->view('template/content/footer');
    }


    public function add_comment()
    {
        // Ambil data dari form
        $comment = $this->input->post('comment');
        $thread_id = $this->input->post('thread_id');
        $user_id = $this->input->post('user_id');

        // Masukkan data ke database
        $this->db->insert(
            'forum_comments',
            [
                'comment' => $comment,
                'thread_id' => $thread_id,
                'user_id' => $user_id,
            ]
        );

        // Update replies_count di forum_threads
        $this->db->set('replies_count', 'IFNULL(replies_count, 0) + 1', FALSE);
        $this->db->where('id', $thread_id);
        $this->db->update('forum_threads');

        // Redirect ke halaman form-discussion dengan membawa thread_id
        redirect('form-discussion/' . $thread_id);
    }


    public function add_comment_user()
    {
        // Ambil data dari form
        $reply_text = $this->input->post('reply_text');
        $comment_id  = $this->input->post('comment_id');
        $thread_id = $this->input->post('thread_id');

        // Masukkan data ke database
        $this->db->insert(
            'forum_replies',
            [
                'name' => 'Unknown',
                'reply_text' => $reply_text,
                'comment_id' => $comment_id
            ]
        );

        // Update replies_count di forum_threads
        $this->db->set('replies_count', 'IFNULL(replies_count, 0) + 1', FALSE);
        $this->db->where('id', $thread_id);
        $this->db->update('forum_threads');


        // Redirect ke halaman form-discussion dengan membawa thread_id
        redirect('form-discussion/' . $thread_id);
    }


    public function add_reply_user()
    {
        $comment_id = $this->input->post('comment_id');
        $parent_id = $this->input->post('parent_id'); // Mengambil parent_id dari balasan yang sedang dibalas
        $thread_id = $this->input->post('thread_id');

        $data = [
            'comment_id' => $comment_id,
            'parent_id' => $parent_id, // Ini akan menyimpan ID dari balasan yang sedang dibalas
            'name' => 'Unknown',
            'reply_text' => $this->input->post('reply_text'),
            'likes' => 0,
            'unlikes' => 0,
        ];

        $this->db->insert('forum_replies', $data);

        // Update replies_count di forum_threads
        $this->db->set('replies_count', 'IFNULL(replies_count, 0) + 1', FALSE);
        $this->db->where('id', $thread_id);
        $this->db->update('forum_threads');

        // Redirect ke halaman form-discussion dengan membawa thread_id
        redirect('form-discussion/' . $thread_id);
    }


    public function likeComment()
    {
        $id = $this->input->post('id');
        // Increment like count in database
        $this->db->set('likes', 'likes + 1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('forum_comments');

        // Return the updated like count
        $like_count = $this->db->select('likes')->where('id', $id)->get('forum_comments')->row()->likes;
        echo json_encode(['likes' => $like_count]);
    }

    public function unlikeComment()
    {
        $id = $this->input->post('id');
        // Increment unlike count in database
        $this->db->set('unlikes', 'unlikes + 1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('forum_comments');

        // Return the updated unlike count
        $unlike_count = $this->db->select('unlikes')->where('id', $id)->get('forum_comments')->row()->unlikes;
        echo json_encode(['unlikes' => $unlike_count]);
    }

    public function likeReply()
    {
        $id = $this->input->post('id');
        // Increment like count in database
        $this->db->set('likes', 'likes + 1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('forum_replies');

        // Return the updated like count
        $like_count = $this->db->select('likes')->where('id', $id)->get('forum_replies')->row()->likes;
        echo json_encode(['likes' => $like_count]);
    }

    public function unlikeReply()
    {
        $id = $this->input->post('id');
        $this->db->set('unlikes', 'unlikes + 1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('forum_replies');

        // Return the updated unlike count
        $unlike_count = $this->db->select('unlikes')->where('id', $id)->get('forum_replies')->row()->unlikes;
        echo json_encode(['unlikes' => $unlike_count]);
    }

    public function filter()
    {
        // Dapatkan input dari request
        $topicSearch = $this->input->post('topicSearch');
        $categorySelect = $this->input->post('categorySelect');

        // Lakukan query untuk mengambil threads yang sesuai
        $this->db->select('*');
        $this->db->from('forum_threads');

        if ($topicSearch) {
            $this->db->like('title', $topicSearch);
        }

        if ($categorySelect && $categorySelect != 'all') {
            $this->db->where('category_id', $categorySelect);
        }

        $query = $this->db->get();
        $threads = $query->result_array();

        // Kembalikan hasil dalam format JSON
        echo json_encode($threads);
    }
}
