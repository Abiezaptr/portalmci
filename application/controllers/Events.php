<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
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
        $data['title'] = 'Events Calendar';

        // Ambil acara yang akan datang
        $this->db->where('start_date >=', date('Y-m-d'));  // Pastikan start_date lebih besar atau sama dengan hari ini
        $this->db->or_where('end_date >=', date('Y-m-d'));  // Atau end_date lebih besar atau sama dengan hari ini
        $this->db->order_by('start_date', 'ASC');  // Urutkan berdasarkan start_date secara ascending
        $data['upcoming_events'] = $this->db->get('events')->result();

        // Load view dengan data
        $this->load->view('template/content/header', $data);
        $this->load->view('event-calendar', $data);
        $this->load->view('template/content/footer');
    }

    public function getEvents()
    {
        // Ambil tanggal saat ini
        $today = date('Y-m-d');

        // Ambil event yang start_date lebih besar atau sama dengan hari ini, dan end_date lebih besar atau sama dengan hari ini
        $this->db->where('start_date >=', $today);
        $this->db->or_where('end_date >=', $today);
        $events = $this->db->get('events')->result();

        // Log the events to check if image data is present
        log_message('info', print_r($events, true)); // This will log the events to your log file

        $data = [];
        foreach ($events as $event) {
            $data[] = [
                'title'       => $event->title,
                'start'       => $event->start_date,
                'end'         => $event->end_date ? date('Y-m-d', strtotime($event->end_date . ' +1 day')) : null,
                'location'    => $event->location,
                'description' => $event->description,
                'color'       => $event->color,
                'image'       => $event->image // Ensure this is being set
            ];
        }

        echo json_encode($data);
    }
}
