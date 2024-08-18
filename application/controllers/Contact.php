<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

    public function index()
    {
        // Load the views with the data
        $this->load->view('template/content/header');
        $this->load->view('contact/index');
        $this->load->view('template/content/footer');
    }
}
