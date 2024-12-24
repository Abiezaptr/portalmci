<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
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
        $data['title'] = 'Role Administration';

        // Fetch users with role_id 3, 4, or 5
        $this->db->where_in('role', [3, 4, 5, 6]);
        $data['users'] = $this->db->get('users')->result_array();

        // Fetch permissions for each user
        foreach ($data['users'] as &$user) {
            $permissions = $this->db->get_where('permissions', ['user_id' => $user['id']])->row_array();
            $user['permissions'] = $permissions;
        }

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
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        foreach ($upload_logs as $log) {
            $notifications[] = [
                'type' => 'upload_log',
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

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/role_view', $data);
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

    public function update_permissions()
    {
        // Ambil data dari POST
        $user_id = $this->input->post('user_id');
        $permission_type = $this->input->post('permission'); // Tipe permission
        $value = $this->input->post('value');

        // Debug: Pastikan data yang diterima benar
        log_message('debug', 'User ID: ' . $user_id . ' Permission Type: ' . $permission_type . ' Value: ' . $value);

        // Cek apakah user_id valid
        if (!$user_id || !$permission_type) {
            echo json_encode(['status' => 'error', 'message' => 'User ID or Permission Type is missing.']);
            return;
        }

        // Siapkan data untuk diinsert atau diupdate
        $data = [$permission_type => $value];

        // Cek apakah data sudah ada di tabel
        $existing_permission = $this->db->get_where('permissions', ['user_id' => $user_id])->row();

        if ($existing_permission) {
            // Jika data sudah ada, lakukan update
            $this->db->where('user_id', $user_id);
            $this->db->update('permissions', $data);

            if ($this->db->affected_rows() > 0) {
                // Fetch updated permissions
                $updated_permissions = $this->db->get_where('permissions', ['user_id' => $user_id])->row_array();
                // Set updated permissions in session
                $this->session->set_userdata('permissions', $updated_permissions);

                echo json_encode(['status' => 'success', 'message' => 'Permission updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No rows updated.']);
            }
        } else {
            // Jika data belum ada, lakukan insert
            $data['user_id'] = $user_id; // Tambahkan user_id ke data
            $this->db->insert('permissions', $data);

            if ($this->db->affected_rows() > 0) {
                // Fetch updated permissions
                $updated_permissions = $this->db->get_where('permissions', ['user_id' => $user_id])->row_array();
                // Set updated permissions in session
                $this->session->set_userdata('permissions', $updated_permissions);

                echo json_encode(['status' => 'success', 'message' => 'Permission inserted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to insert permission.']);
            }
        }
    }
}
