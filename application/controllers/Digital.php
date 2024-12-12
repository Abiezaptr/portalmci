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
        // Query to get data from the 'reports' table where category is 'digital' and type is 'pdf'
        $data['reports'] = $this->db->where('category', 'digital insight')
            ->where('type', 'pdf')
            ->order_by('created_at', 'DESC')
            ->get('reports')
            ->result_array();

        // Query to get data from the 'reports' table where category is 'fixed' and type is 'articles'
        $data['articles'] = $this->db->where('category', 'digital insight')
            ->where('type', 'article')
            ->order_by('created_at', 'DESC')
            ->get('reports')
            ->result_array();

        // Query to get data from the 'videos' table where category is 'fixed'
        $data['videos'] = $this->db->where('category', 'digital insight')->get('videos')->result();

        // Load the views with the data
        $this->load->view('template/content/header', $data);
        $this->load->view('digital/list', $data);
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
}
