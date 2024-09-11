<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Contact';
        // Load the views with the data
        $this->load->view('template/content/header', $data);
        $this->load->view('contact/index', $data);
        $this->load->view('template/content/footer');
    }
}
