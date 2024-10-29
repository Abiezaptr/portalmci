<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Cek apakah session user_id ada, jika tidak redirect ke halaman login
        if (!$this->session->userdata('id')) {
            redirect('login'); // Ganti 'login' sesuai dengan route halaman login Anda
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        // Load the view with the video data
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template/cms/footer');
    }
}
