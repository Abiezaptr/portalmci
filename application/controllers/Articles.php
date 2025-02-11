<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Articles extends CI_Controller
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
        $data['title'] = 'Articles List';

        // Konfigurasi pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('articles/index'); // URL pagination
        $config['total_rows'] = $this->db->where('type', 'article')->count_all_results('reports'); // Total data
        $config['per_page'] = 9; // Jumlah artikel per halaman
        $config['uri_segment'] = 3; // Posisi segmen di URL

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
        $data['articles'] = $this->db->select('title, desc, category, image, created_at AS date')
            ->from('reports')
            ->where('type', 'article')
            ->order_by('created_at', 'DESC')
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
        $this->load->view('articles', $data);
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
}
