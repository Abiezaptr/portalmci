<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
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
        $data['title'] = 'Events Calendar';

        // Ambil acara yang akan datang
        $this->db->where('start_date >=', date('Y-m-d'));  // Pastikan start_date lebih besar atau sama dengan hari ini
        $this->db->or_where('end_date >=', date('Y-m-d'));  // Atau end_date lebih besar atau sama dengan hari ini
        $this->db->order_by('start_date', 'ASC');  // Urutkan berdasarkan start_date secara ascending
        $data['upcoming_events'] = $this->db->get('events')->result();

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

        // Ambil 3 event terakhir yang sudah lewat
        $this->db->where('end_date <', date('Y-m-d')); // Event yang sudah lewat
        $this->db->order_by('end_date', 'DESC'); // Urutkan dari yang terbaru
        $this->db->limit(3); // Batasi hanya 3 event
        $data['past_events'] = $this->db->get('events')->result();

        // Load view dengan data
        $this->load->view('template/content/header', $data);
        $this->load->view('event-calendar', $data);
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

    // public function getEvents()
    // {
    //     // Ambil tanggal saat ini
    //     $today = date('Y-m-d');

    //     // Ambil event yang start_date lebih besar atau sama dengan hari ini, dan end_date lebih besar atau sama dengan hari ini
    //     $this->db->where('start_date >=', $today);
    //     $this->db->or_where('end_date >=', $today);
    //     $events = $this->db->get('events')->result();

    //     // Log the events to check if image data is present
    //     log_message('info', print_r($events, true)); // This will log the events to your log file

    //     $data = [];
    //     foreach ($events as $event) {
    //         $data[] = [
    //             'title'       => $event->title,
    //             'start'       => $event->start_date,
    //             'end'         => $event->end_date ? date('Y-m-d', strtotime($event->end_date . ' +1 day')) : null,
    //             'location'    => $event->location,
    //             'description' => $event->description,
    //             'color'       => $event->color,
    //             'image'       => $event->image // Ensure this is being set
    //         ];
    //     }

    //     echo json_encode($data);
    // }

    public function getEvents()
    {
        $this->db->order_by('start_date', 'ASC'); // Urutkan berdasarkan tanggal
        $events = $this->db->get('events')->result();

        $data = [];
        foreach ($events as $event) {
            $data[] = [
                'title'       => $event->title,
                'start'       => $event->start_date,
                'end'         => $event->end_date ? date('Y-m-d', strtotime($event->end_date . ' +1 day')) : null,
                'location'    => $event->location,
                'description' => $event->description,
                'color'       => $event->color,
                'image'       => $event->image
            ];
        }

        echo json_encode($data);
    }
}
