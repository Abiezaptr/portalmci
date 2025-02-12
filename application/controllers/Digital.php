<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Digital extends CI_Controller
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
        $data['title'] = 'Digital Insight';

        // Ambil data kategori dari tabel forum_category
        $data['categories'] = $this->db->get('reports_category')->result_array();

        // Query to get data from the 'reports' table where category is 'digital' and type is 'pdf'
        $data['reports'] = $this->db->where('category', 'digital insight')
            ->where('type', 'pdf')
            ->order_by('created_at', 'DESC')
            ->limit(5)
            ->get('reports')
            ->result_array();

        // Query to get data from the 'reports' table where category is 'fixed' and type is 'articles'
        $data['articles'] = $this->db->where('category', 'digital insight')
            ->where('type', 'article')
            ->order_by('created_at', 'DESC')
            ->limit(10)
            ->get('reports')
            ->result_array();

        // Query to get data from the 'videos' table where category is 'fixed'
        $data['videos'] = $this->db->where('category', 'digital insight')->get('videos')->result();

        // Initialize a variable to track relevant notifications
        $relevant_notifications = [];

        // Fetch user logs (only for the current user)
        $user_logs = $this->user_log();
        foreach ($user_logs as $log) {
            $relevant_notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at,
                'is_read' => $log->is_read
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
                    'timestamp' => $log->upload_time,
                    'is_read' => $log->is_read
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
                        'timestamp' => $log->invitation_time,
                        'is_read' => $log->is_read
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
        $unread_notifications = array_filter($relevant_notifications, function ($notification) {
            return isset($notification['is_read']) && $notification['is_read'] == 0;
        });

        $data['total_relevant_notifications'] = count($unread_notifications);

        // Load the views with the data
        $this->load->view('template/content/header', $data);
        $this->load->view('digital/list', $data);
        $this->load->view('template/content/footer');
    }

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

    public function view_report($title)
    {
        // Convert hyphens back to spaces
        $decoded_title = str_replace('-', ' ', urldecode($title));

        // Query to get data from the 'reports' table where the title matches
        $data['viewreports'] = $this->db->select('*')
            ->from('reports')
            ->where('title', $decoded_title)
            ->get()
            ->row_array();

        // Check if the data is available
        if (empty($data['viewreports'])) {
            show_404();  // Show 404 page if no data found
        }

        // Pass the title to the view
        $data['page_title'] = $data['viewreports']['title'];

        // Pass the image URL to the view for dynamic background
        $data['background_image'] = base_url('uploads/images/' . $data['viewreports']['image']);

        // Query to get other reports in the same category but not the current one
        $data['others'] = $this->db->select('*')
            ->from('reports')
            ->where('category', $data['viewreports']['category'])
            ->where('title !=', $decoded_title)
            ->where('type !=', 'article') // Exclude 'article' type
            ->get()
            ->result_array();

        // Load the views with the data
        $this->load->view('fixed/report', $data);
    }

    public function view_pdf($id)
    {
        // Query to get the report based on the ID
        $data['viewreports'] = $this->db->select('*')
            ->from('reports')
            ->where('id', $id)
            ->get()
            ->row_array();

        // Check if the data is available
        if (empty($data['viewreports'])) {
            show_404();  // Show 404 page if no data found
        }

        // Pass the file name to the view
        $data['file_name'] = $data['viewreports']['file'];

        // Load the view with the PDF viewer
        $this->load->view('fixed/view_pdf', $data);
    }

    public function search_reports()
    {
        $file_name = $this->input->post('file_name');
        $keyword = $this->input->post('keywords'); // Expecting a single keyword  
        $posted_date = $this->input->post('posted_date');
        $categories = $this->input->post('category'); // Ambil category_id dari input      
        $group = 'digital insight'; // Kategori yang ingin dicari      
        $type = 'pdf'; // Tambahkan filter berdasarkan type      

        $this->db->where('category', $group); // Filter berdasarkan category      
        $this->db->where('type', $type); // Filter berdasarkan type      

        // Cek setiap filter secara terpisah  
        if (!empty($file_name)) {
            $this->db->like('title', $file_name);
        }

        if (!empty($keyword)) {
            // Gunakan WHERE untuk mencocokkan keyword  
            $this->db->where('keywords', $keyword); // Mencocokkan keyword  
        }

        if (!empty($categories)) {
            $this->db->where('report_category_id', $categories);
        }

        if (!empty($posted_date)) {
            $this->db->where('DATE(created_at)', $posted_date); // Mencocokkan tanggal 
        }

        // Hapus limit default jika ada pencarian  
        if (empty($file_name) && empty($keyword) && empty($categories) && empty($posted_date)) {
            $this->db->limit(5);
        }

        $this->db->order_by('created_at', 'DESC');

        $query = $this->db->get('reports'); // Mengambil laporan dari database      

        $reports = $query->result_array();

        // Format laporan menjadi chunk (untuk carousel)      
        $chunks = array_chunk($reports, 4);

        // Kembalikan hasil pencarian sebagai JSON      
        if ($reports) {
            echo json_encode([
                'status' => 'success',
                'reports' => $chunks
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No reports found'
            ]);
        }
    }
}
