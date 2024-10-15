<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Dashboard';
        // Load the view with the video data
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template/cms/footer');
    }
}
