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
    }

    public function index()
    {
        $data['title'] = 'Notification List';

        // Memanggil fungsi-fungsi yang ditambahkan
        $user_logs = $this->user_log();
        $upload_logs = $this->get_upload_logs();
        $library_logs = $this->upload_logs();
        $user_read_logs = $this->get_user_read_logs();
        $invitation_thread_logs = $this->get_invitation_thread_logs();

        // Menggabungkan semua log ke dalam satu array
        $notifications = [];

        foreach ($user_logs as $log) {
            $notifications[] = [
                'type' => 'users_log',
                'title' => 'Pendaftaran Akun Baru',
                'message' => ' Terima kasih, registrasi Akun Anda berhasil.',
                'timestamp' => $log->created_at,
                'id' => $log->id,
                'is_read' => $log->is_read
            ];
        }

        foreach ($upload_logs as $log) {
            $notifications[] = [
                'type' => 'upload_log',
                'title' => 'Upload Dokumen Baru',
                'message' => $log->username . ' ' . $log->message . '.',
                'timestamp' => $log->upload_time,
                'id' => $log->id,
                'is_read' => $log->is_read
            ];
        }

        foreach ($library_logs as $log) {
            $notifications[] = [
                'type' => 'library_log',
                'title' => 'Upload Dokumen Baru',
                'message' => $log->username . ' ' . $log->message . '.',
                'timestamp' => $log->upload_time,
                'id' => $log->id,
                'is_read' => $log->is_read
            ];
        }

        foreach ($user_read_logs as $log) {
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log);
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
                        'id' => $log->id,
                        'title' => 'Undangan Thread Baru',
                        'message' => 'Anda telah' . ' ' . $log->message,
                        'timestamp' => $log->invitation_time,
                        'is_read' => $log->is_read
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
                'title' => 'Pendaftaran Akun Baru',
                'message' => ' Terima kasih, registrasi Akun Anda berhasil.',
                'timestamp' => $log->created_at,
                'id' => $log->id,
                'is_read' => $log->is_read
            ];
        }

        // Fetch upload logs
        foreach ($upload_logs as $log) {
            // Check if the report is related to the current user
            if ($log->user_id == $this->session->userdata('id')) {
                $relevant_notifications[] = [
                    'type' => 'upload_log',
                    'message' => $log->username . ' ' . $log->message . '.',
                    'timestamp' => $log->upload_time,
                    'is_read' => $log->is_read,
                ];
            }
        }

        foreach ($library_logs as $log) {
            // Check if the report is related to the current user
            if ($log->user_id == $this->session->userdata('id')) {
                $relevant_notifications[] = [
                    'type' => 'upload_log',
                    'message' => $log->username . ' ' . $log->message . '.',
                    'timestamp' => $log->upload_time,
                    'is_read' => $log->is_read,
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
                        'timestamp' => $log->invitation_time,
                        'is_read' => $log->is_read,
                    ];
                }
            }
        }

        $unread_notifications = array_filter($relevant_notifications, function ($notification) {
            return isset($notification['is_read']) && $notification['is_read'] == 0;
        });

        $data['total_relevant_notifications'] = count($unread_notifications);

        // Load the views with the data
        $this->load->view('template/content/header', $data);
        $this->load->view('notification', $data);
        $this->load->view('template/content/footer');
    }

    public function user_log()
    {
        $user_id = $this->session->userdata('id');
        $this->db->select('users_log.*');
        $this->db->from('users_log');
        $this->db->join('users', 'users_log.user_id = users.id');
        $this->db->where('users_log.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

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

    public function upload_logs()
    {
        $this->db->select('upload_log.*, users.username, document.name as document_name');
        $this->db->from('upload_log');
        $this->db->join('users', 'upload_log.user_id = users.id', 'left');
        $this->db->join('document', 'upload_log.document_id = document.id', 'left');
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
        $user_id = $this->session->userdata('id');
        $this->db->select('invitation_thread_log.*, invited_by_users.username as invited_by_username');
        $this->db->from('invitation_thread_log');
        $this->db->join('users as invited_by_users', 'invitation_thread_log.invited_by = invited_by_users.id');
        $this->db->where('invitation_thread_log.user_id', $user_id);
        $this->db->order_by('invitation_thread_log.invitation_time', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_notification_status()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('type');

        // Update berdasarkan tipe notifikasi
        if ($type === 'upload_log') {
            $this->db->where('id', $id);
            $this->db->update('report_log', ['is_read' => 1]);
        } elseif ($type === 'users_log') {
            $this->db->where('id', $id);
            $this->db->update('users_log', ['is_read' => 1]);
        } elseif ($type === 'library_log') {
            $this->db->where('id', $id);
            $this->db->update('upload_log', ['is_read' => 1]);
        } elseif ($type === 'invitation_thread_log') {
            $this->db->where('id', $id);
            $this->db->update('invitation_thread_log', ['is_read' => 1]);
        }

        echo json_encode(['status' => 'success']);
    }
}
