<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Globals extends CI_Controller
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
        $data['title'] = 'Global';
        // Query to get data from the 'reports' table where category is 'digital' and type is 'pdf'
        $data['reports'] = $this->db->where('category', 'global')
            ->where('type', 'pdf')
            ->order_by('created_at', 'DESC')
            ->limit(5)
            ->get('reports')
            ->result_array();

        // Query to get data from the 'reports' table where category is 'fixed' and type is 'articles'
        $data['articles'] = $this->db->where('category', 'global')
            ->where('type', 'article')
            ->order_by('created_at', 'DESC')
            ->limit(10)
            ->get('reports')
            ->result_array();

        // Query to get data from the 'videos' table where category is 'fixed'
        $data['videos'] = $this->db->where('category', 'global')->get('videos')->result();

        // Load the views with the data
        $this->load->view('template/content/header', $data);
        $this->load->view('global/list', $data);
        $this->load->view('template/content/footer');
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
        $search_query = $this->input->post('search_query');
        $category = 'global'; // Kategori yang ingin dicari
        $type = 'pdf'; // Tambahkan filter berdasarkan type

        // Jika ada pencarian, ambil semua data yang sesuai dengan kata kunci
        if (!empty($search_query)) {
            // Pencarian berdasarkan judul, kategori, dan tipe
            $this->db->like('title', $search_query);
            $this->db->where('category', $category); // Filter berdasarkan kategori
            $this->db->where('type', $type); // Filter berdasarkan type
            $query = $this->db->get('reports'); // Mengambil laporan dari database

            $reports = $query->result_array();
        } else {
            // Jika tidak ada pencarian, ambil hanya 5 data pertama, urutkan dengan 'created_at' (contoh)
            $this->db->limit(5); // Batasi hanya 5 data
            $this->db->where('category', $category); // Filter berdasarkan kategori
            $this->db->where('type', $type); // Filter berdasarkan type
            $this->db->order_by('created_at', 'DESC'); // Urutkan berdasarkan kolom 'created_at' (terbaru)
            $query = $this->db->get('reports');

            $reports = $query->result_array();
        }

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
