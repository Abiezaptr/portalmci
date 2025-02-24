<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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

    // public function index()
    // {
    //     $data['title'] = 'Dashboard';

    //     // Total Count
    //     $data['total_users'] = $this->db->where_in('role', [1, 3, 4, 5, 6])->count_all_results('users');
    //     $data['report'] = $this->db->where('type', 'pdf')->count_all_results('reports');
    //     $data['article'] = $this->db->where('type', 'article')->count_all_results('reports');
    //     $data['videos'] = $this->db->count_all('videos');
    //     // Query to get count of users with status "NONAKTIF"
    //     $data['nonaktif_count'] = $this->db->where('status', 'NONAKTIF')->count_all_results('users');

    //     // Count reports and videos by category
    //     $categories = ['Mobile', 'Fixed', 'Digital Insight', 'Global'];
    //     $data['report_counts'] = ['pdf' => [], 'article' => [], 'videos' => []];

    //     foreach ($categories as $category) {
    //         // Count PDF reports by category
    //         $data['report_counts']['pdf'][$category] = $this->db->where('type', 'pdf')
    //             ->where('category', $category)
    //             ->count_all_results('reports');

    //         // Count Article reports by category
    //         $data['report_counts']['article'][$category] = $this->db->where('type', 'article')
    //             ->where('category', $category)
    //             ->count_all_results('reports');

    //         // Count Videos by category
    //         $data['report_counts']['videos'][$category] = $this->db->where('category', $category)
    //             ->count_all_results('videos');
    //     }

    //     // Fetch thread count by month
    //     $threads_by_month = [];
    //     for ($i = 1; $i <= 12; $i++) {
    //         $threads_by_month[] = $this->db->where('MONTH(created_at)', $i)
    //             ->count_all_results('forum_threads');
    //     }
    //     $data['threads_by_month'] = $threads_by_month;

    //     // Fetch last activity counts by month
    //     $data['activity_by_month'] = [];
    //     for ($i = 1; $i <= 12; $i++) {
    //         $data['activity_by_month'][$i] = $this->db->where('MONTH(login_time)', $i)
    //             ->count_all_results('login_logs'); // Replace 'activity_date' with your actual timestamp column
    //     }

    //     // Ambil acara yang akan datang
    //     $this->db->where('start_date >=', date('Y-m-d'));  // Pastikan start_date lebih besar atau sama dengan hari ini
    //     $this->db->or_where('end_date >=', date('Y-m-d'));  // Atau end_date lebih besar atau sama dengan hari ini
    //     $this->db->order_by('start_date', 'ASC');  // Urutkan berdasarkan start_date secara ascending
    //     $data['upcoming_events'] = $this->db->get('events')->result();

    //     $data['nonaktif_users'] = $this->db->where('status', 'NONAKTIF')
    //         ->order_by('created_at', 'DESC') // Replace 'id' with the column you want to order by
    //         ->get('users')
    //         ->result();

    //     // Memanggil fungsi-fungsi yang ditambahkan
    //     $user_logs = $this->user_log();
    //     $upload_logs = $this->get_upload_logs();
    //     $user_read_logs = $this->get_user_read_logs();
    //     $invitation_thread_logs = $this->get_invitation_thread_logs();

    //     // Menggabungkan semua log ke dalam satu array
    //     $notifications = [];

    //     foreach ($user_logs as $log) {
    //         $notifications[] = [
    //             'type' => 'user_log',
    //             'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
    //             'timestamp' => $log->created_at
    //         ];
    //     }

    //     foreach ($upload_logs as $log) {
    //         $notifications[] = [
    //             'type' => 'upload_log',
    //             'message' => $log->username . ' ' . $log->message . '.',
    //             'timestamp' => $log->upload_time
    //         ];
    //     }

    //     foreach ($user_read_logs as $log_id) {
    //         // Anda perlu mengambil detail log berdasarkan log_id jika diperlukan
    //         // Misalnya, ambil detail dari tabel user_read_logs
    //         $this->db->select('*');
    //         $this->db->from('user_read_logs');
    //         $this->db->where('log_id', $log_id);
    //         $log_detail = $this->db->get()->row();

    //         if ($log_detail) {
    //             $notifications[] = [
    //                 'type' => 'user_read_log',
    //                 'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
    //                 'timestamp' => $log_detail->read_time // Ganti dengan kolom waktu yang sesuai
    //             ];
    //         }
    //     }

    //     foreach ($invitation_thread_logs as $log) {
    //         $user_ids = explode(',', $log->user_id);
    //         foreach ($user_ids as $user_id) {
    //             $this->db->select('username');
    //             $this->db->from('users');
    //             $this->db->where('id', $user_id);
    //             $user = $this->db->get()->row();

    //             if ($user) {
    //                 $notifications[] = [
    //                     'type' => 'invitation_thread_log',
    //                     'message' => $user->username . ' ' . $log->message,
    //                     'timestamp' => $log->invitation_time
    //                 ];
    //             }
    //         }
    //     }

    //     // Mengurutkan notifikasi berdasarkan timestamp
    //     usort($notifications, function ($a, $b) {
    //         return strtotime($b['timestamp']) - strtotime($a['timestamp']);
    //     });

    //     // Batasi jumlah notifikasi yang ditampilkan (misalnya 5)
    //     $data['notifications'] = array_slice($notifications, 0, 5);

    //     // Menghitung total notifikasi
    //     $data['total_notifications'] = count($notifications);

    //     // Load the view
    //     $this->load->view('template/cms/header', $data);
    //     $this->load->view('admin/dashboard', $data);
    //     $this->load->view('template/cms/footer');
    // }

    public function index()
    {
        $data['title'] = 'Dashboard';

        // Total Count
        $data['total_users'] = $this->db->where_in('role', [1, 3, 4, 5, 6])->count_all_results('users');
        $data['report'] = $this->db->where('type', 'pdf')->count_all_results('reports');
        $data['article'] = $this->db->where('type', 'article')->count_all_results('reports');
        $data['videos'] = $this->db->count_all('videos');
        $data['nonaktif_count'] = $this->db->where('status', 'NONAKTIF')->count_all_results('users');

        // Count reports and videos by category
        $categories = ['Mobile', 'Fixed', 'Digital Insight', 'Global'];
        $data['report_counts'] = ['pdf' => [], 'article' => [], 'videos' => []];

        foreach ($categories as $category) {
            $data['report_counts']['pdf'][$category] = $this->db->where('type', 'pdf')
                ->where('category', $category)
                ->count_all_results('reports');

            $data['report_counts']['article'][$category] = $this->db->where('type', 'article')
                ->where('category', $category)
                ->count_all_results('reports');

            $data['report_counts']['videos'][$category] = $this->db->where('category', $category)
                ->count_all_results('videos');
        }

        // Fetch thread count by month
        $threads_by_month = [];
        for ($i = 1; $i <= 12; $i++) {
            $threads_by_month[] = $this->db->where('MONTH(created_at)', $i)
                ->count_all_results('forum_threads');
        }
        $data['threads_by_month'] = $threads_by_month;

        // Fetch last activity counts by month
        $data['activity_by_month'] = [];
        for ($i = 1; $i <= 12; $i++) {
            $data['activity_by_month'][$i] = $this->db->where('MONTH(login_time)', $i)
                ->count_all_results('login_logs');
        }

        // Ambil acara yang akan datang
        $this->db->where('start_date >=', date('Y-m-d'));
        $this->db->or_where('end_date >=', date('Y-m-d'));
        $this->db->order_by('start_date', 'ASC');
        $data['upcoming_events'] = $this->db->get('events')->result();

        $data['nonaktif_users'] = $this->db->where('status', 'NONAKTIF')
            ->order_by('created_at', 'DESC')
            ->get('users')
            ->result();

        // Tambahkan Query untuk Top 5 Report yang Sering Dikunjungi
        $data['top_reports'] = $this->db->select('dv.document_id, d.name, COUNT(*) AS visit_count')
            ->from('document_views dv')
            ->join('document d', 'dv.document_id = d.id')
            ->group_by('dv.document_id, d.name')
            ->order_by('visit_count', 'DESC')
            ->limit(5)
            ->get()
            ->result();

        $data['user_reports'] = $this->db->select("u.username, d.name, DATE_FORMAT(dv.view_time, '%b %Y') AS view_month_year")
            ->from('document_views dv')
            ->join('document d', 'dv.document_id = d.id')
            ->join('users u', 'dv.user_id = u.id')
            ->where('MONTH(dv.view_time)', date('m')) // Bulan saat ini
            ->where('YEAR(dv.view_time)', date('Y'))  // Tahun saat ini
            ->order_by('dv.view_time', 'DESC')
            ->limit(5)
            ->get()
            ->result();



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
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $notifications[] = [
                    'type' => 'user_read_log',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time
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
        $data['total_notifications'] = count($notifications);

        // Load the view
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/dashboard', $data);
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


    // Controller
    public function activate_user($user_id)
    {
        // Update the status to AKTIF
        $this->db->where('id', $user_id)->update('users', ['status' => 'AKTIF']);
        echo json_encode(['status' => 'success']);
    }
}
