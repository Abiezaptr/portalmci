<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Articles extends CI_Controller
{

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

        // Load view dengan data
        $this->load->view('template/content/header', $data);
        $this->load->view('articles', $data);
        $this->load->view('template/content/footer');
    }
}
