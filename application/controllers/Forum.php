<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Forum';

        // Ambil semua thread dengan join ke tabel category
        $this->db->select('forum_threads.*, forum_category.name AS category_name');
        $this->db->from('forum_threads');
        $this->db->join('forum_category', 'forum_threads.category_id = forum_category.id'); // Join berdasarkan category_id
        $query = $this->db->get();
        $data['threads'] = $query->result_array();

        // Ambil semua kategori dari tabel forum_category
        $queryCategories = $this->db->get('forum_category');
        $data['categories'] = $queryCategories->result_array();

        // Load the views with the data
        $this->load->view('template/content/header', $data);
        $this->load->view('forum/list', $data);
        $this->load->view('template/content/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Forum Discussion';

        // Tambahkan view count
        $this->db->set('views_count', 'views_count+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('forum_threads');

        // Ambil thread berdasarkan ID
        $this->db->where('forum_threads.id', $id);
        $this->db->select('forum_threads.*, forum_category.name AS category_name');
        $this->db->from('forum_threads');
        $this->db->join('forum_category', 'forum_threads.category_id = forum_category.id', 'left'); // Menggunakan LEFT JOIN jika Anda ingin tetap menampilkan thread meski tidak ada kategori
        $thread = $this->db->get()->row_array();


        // Query untuk mendapatkan komentar dan balasan mereka dengan nama parent
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
                        parent_replies.name AS parent_name') // Ambil nama balasan parent
            ->from('forum_comments AS comments')
            ->join('forum_replies AS replies', 'replies.comment_id = comments.id', 'left')
            ->join('users', 'users.id = comments.user_id', 'left')
            ->join('forum_replies AS parent_replies', 'replies.parent_id = parent_replies.id', 'left') // Join untuk mendapatkan nama parent reply
            ->where('comments.thread_id', $id) // Gunakan alias yang benar
            ->order_by('comments.created_at', 'ASC')
            ->order_by('replies.created_at', 'ASC')
            ->get()
            ->result_array();

        // Atur komentar dan balasan
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
                    'parent_name' => $comment['parent_name'] ? $comment['parent_name'] : $comment['name'] // Gunakan nama komentar jika parent_name NULL
                ];
                // Tambahkan balasan ke komentar induk mereka
                $data['comments'][$comment['id']]['replies'][] = $reply;
            }
        }

        // Query untuk menghitung jumlah komentar terkait thread ini
        $data['comment_count'] = $this->db->where('thread_id', $id) // Ganti id_report dengan thread_id
            ->from('forum_comments')
            ->count_all_results();

        $data['thread'] = $thread;

        // Load the views with the data
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

        // Load view dengan kategori yang difilter dan nama kategori yang dipilih
        $this->load->view('template/content/header', $data);
        $this->load->view('forum/forum_view', $data);
        $this->load->view('template/content/footer');
    }
}
