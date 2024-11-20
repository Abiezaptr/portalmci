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
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        // Total Count
        $data['total_users'] = $this->db->where_in('role', [1, 3, 4, 5, 6])->count_all_results('users');
        $data['report'] = $this->db->where('type', 'pdf')->count_all_results('reports');
        $data['article'] = $this->db->where('type', 'article')->count_all_results('reports');
        $data['videos'] = $this->db->count_all('videos');
        // Query to get count of users with status "NONAKTIF"
        $data['nonaktif_count'] = $this->db->where('status', 'NONAKTIF')->count_all_results('users');


        // Count reports and videos by category
        $categories = ['Mobile', 'Fixed', 'Digital Insight', 'Global'];
        $data['report_counts'] = ['pdf' => [], 'article' => [], 'videos' => []];

        foreach ($categories as $category) {
            // Count PDF reports by category
            $data['report_counts']['pdf'][$category] = $this->db->where('type', 'pdf')
                ->where('category', $category)
                ->count_all_results('reports');

            // Count Article reports by category
            $data['report_counts']['article'][$category] = $this->db->where('type', 'article')
                ->where('category', $category)
                ->count_all_results('reports');

            // Count Videos by category
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
                ->count_all_results('login_logs'); // Replace 'activity_date' with your actual timestamp column
        }

        // Ambil acara yang akan datang
        $this->db->where('start_date >=', date('Y-m-d'));  // Pastikan start_date lebih besar atau sama dengan hari ini
        $this->db->or_where('end_date >=', date('Y-m-d'));  // Atau end_date lebih besar atau sama dengan hari ini
        $this->db->order_by('start_date', 'ASC');  // Urutkan berdasarkan start_date secara ascending
        $data['upcoming_events'] = $this->db->get('events')->result();


        $data['nonaktif_users'] = $this->db->where('status', 'NONAKTIF')
            ->order_by('created_at', 'DESC') // Replace 'id' with the column you want to order by
            ->get('users')
            ->result();


        // Load the view
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template/cms/footer');
    }

    // Controller
    public function activate_user($user_id)
    {
        // Update the status to AKTIF
        $this->db->where('id', $user_id)->update('users', ['status' => 'AKTIF']);
        echo json_encode(['status' => 'success']);
    }
}
