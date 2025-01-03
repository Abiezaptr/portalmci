<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        // Cek apakah session user_id ada, jika tidak redirect ke halaman login
        if (!$this->session->userdata('id')) {
            redirect('login'); // Ganti 'login' sesuai dengan route halaman login Anda
        }

        // Cek apakah session role ada dan apakah role termasuk dalam daftar yang diizinkan
        $allowed_roles = [1, 3, 4, 5, 6];
        if (!in_array($this->session->userdata('role'), $allowed_roles)) {
            redirect('login'); // Ganti 'unauthorized' sesuai dengan route halaman yang diinginkan
        }
    }

    public function index()
    {
        $data['title'] = 'Notification List';

        // Memanggil fungsi-fungsi yang ditambahkan
        $user_logs = $this->user_log();
        $upload_logs = $this->get_upload_logs();
        $user_read_logs = $this->get_user_read_logs();
        $invitation_thread_logs = $this->get_invitation_thread_logs();

        // Menggabungkan semua log ke dalam satu array
        $notifications = [];

        foreach ($user_logs as $log) {
            $notifications[] = [
                'type' => 'user_log',
                'title' => 'Pendaftaran Akun Baru',
                'message' => $log->username . ', telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        foreach ($upload_logs as $log) {
            $notifications[] = [
                'type' => 'upload_log',
                'title' => 'Upload Dokumen Baru',
                'message' => $log->username . ' ' . $log->message . '.',
                'timestamp' => $log->upload_time
            ];
        }

        foreach ($user_read_logs as $log_id) {
            // Anda perlu mengambil detail log berdasarkan log_id jika diperlukan
            // Misalnya, ambil detail dari tabel user_read_logs
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $notifications[] = [
                    'type' => 'user_read_log',
                    'title' => 'Notifikasi Telah Dibaca',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time // Ganti dengan kolom waktu yang sesuai
                ];
            }
        }

        foreach ($invitation_thread_logs as $log) {
            $user_ids = explode(',', $log->user_id);
            foreach ($user_ids as $user_id) {
                $this->db->select('username');
                $this->db->from('users');
                $this->db->where('id', $user_id);
                $user = $this->db->get()->row();

                if ($user) {
                    $notifications[] = [
                        'type' => 'invitation_thread_log',
                        'title' => 'Undangan Thread Baru',
                        'message' => $user->username . ' ' . $log->message,
                        'timestamp' => $log->invitation_time
                    ];
                }
            }
        }

        // Mengurutkan notifikasi berdasarkan timestamp
        usort($notifications, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Batasi jumlah notifikasi yang ditampilkan (misalnya 5)
        $data['notifications'] = array_slice($notifications, 0, 5);

        // Menghitung total notifikasi
        $data['total_notifications'] = count($notifications);

        // Initialize a variable to track relevant notifications
        $relevant_notifications = [];

        // Fetch user logs (only for the current user)
        foreach ($user_logs as $log) {
            $relevant_notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        // Fetch upload logs
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

        // Count only relevant notifications
        $data['total_relevant_notifications'] = count($relevant_notifications);

        // Load the view
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/notification', $data);
        $this->load->view('template/cms/footer');
    }

    // Fungsi-fungsi yang ditambahkan
    public function user_log()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.status', 'NONAKTIF'); // Menambahkan kondisi untuk status non-aktif
        $this->db->order_by('users.created_at', 'DESC'); // Mengurutkan berdasarkan waktu pembuatan pengguna
        $this->db->limit(5); // Mengambil maksimal 5 entri
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
