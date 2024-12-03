<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
        $this->load->library('upload'); // Load the upload library

        date_default_timezone_set('Asia/Jakarta');

        // Cek apakah session user_id ada, jika tidak redirect ke halaman login
        if (!$this->session->userdata('id')) {
            redirect('login'); // Ganti 'login' sesuai dengan route halaman login Anda
        }
    }

    // Menampilkan semua event
    public function index()
    {
        $data['title'] = 'Event Calendar';

        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/event/view', $data);
        $this->load->view('template/cms/footer');
    }

    public function getEvents()
    {
        // Ambil tanggal saat ini
        $today = date('Y-m-d');

        // Ambil event yang start_date lebih besar atau sama dengan hari ini, dan end_date lebih besar atau sama dengan hari ini
        $this->db->where('start_date >=', $today);
        $this->db->or_where('end_date >=', $today);
        $events = $this->db->get('events')->result();

        $data = [];
        foreach ($events as $event) {
            $data[] = [
                'title'       => $event->title,
                'start'       => $event->start_date,
                'end'         => $event->end_date ? date('Y-m-d', strtotime($event->end_date . ' +1 day')) : null, // Tambahkan 1 hari untuk FullCalendar
                'location'    => $event->location,
                'description' => $event->description,
                'color'       => $event->color
            ];
        }

        echo json_encode($data);
    }


    // Menyimpan event baru
    // public function insert()
    // {
    //     // Ambil data dari form
    //     $data = [
    //         'title'       => $this->input->post('title'),
    //         'start_date'  => $this->input->post('start_date'),
    //         'end_date'    => $this->input->post('end_date'),
    //         'location'    => $this->input->post('location'),
    //         'description' => $this->input->post('description'),
    //         'color'       => $this->input->post('color')
    //     ];

    //     // Validasi tanggal (start_date harus lebih awal dari end_date)
    //     if (strtotime($data['start_date']) > strtotime($data['end_date'])) {
    //         $this->session->set_flashdata('error', 'Start date cannot be later than end date.');
    //         redirect('event');
    //         return;
    //     }

    //     // Masukkan data ke database
    //     $this->db->insert('events', $data);

    //     // Berikan notifikasi sukses
    //     $this->session->set_flashdata('success', 'Event inserted successfully.');
    //     redirect('event');
    // }

    public function insert()
    {
        // Get form data
        $event_name = $this->input->post('event_name');
        $title = $this->input->post('title');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $location = $this->input->post('location');
        $description = $this->input->post('description');
        $color = $this->input->post('color');

        // Handle file uploads
        $image = $_FILES['image']['name'];
        $file = $_FILES['file']['name'];

        // Upload image
        if ($image) {
            // Configure upload for image
            $config['upload_path'] = './uploads/event/'; // Path for images
            $config['allowed_types'] = 'jpg|jpeg|png'; // Allowed image types

            // Initialize the upload library with the config
            $this->upload->initialize($config);

            // Perform the upload
            if (!$this->upload->do_upload('image')) {
                // Handle image upload error
                $error = $this->upload->display_errors();
                echo "Image upload error: " . $error;
                return;
            } else {
                $image = $this->upload->data('file_name'); // Get the uploaded file name
            }
        }

        // Prepare data for insertion
        $data = array(
            'event_name' => $event_name,
            'title' => $title,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'location' => $location,
            'description' => $description,
            'color' => $color,
            'image' => $image,
        );

        // Insert into the database
        $this->db->insert('events', $data);

        $this->session->set_flashdata('success', 'Events insert successfully.');
        // Redirect or load a view with a success message
        redirect('event'); // Redirect to the mobile page or another page
    }



    // Memperbarui event
    public function update($id)
    {
        // Ambil data event sebelumnya
        $oldEvent = $this->db->get_where('events', ['id' => $id])->row();

        // Data yang akan diperbarui
        $data = [
            'title' => $this->input->post('title'),
            'date' => $this->input->post('date'),
            'location' => $this->input->post('location'),
            'description' => $this->input->post('description')
        ];

        // Konfigurasi upload gambar
        $config['upload_path']   = './uploads/event/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048;

        $this->upload->initialize($config);

        // Proses upload gambar jika ada
        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
            $data['image'] = $uploadData['file_name'];

            // Hapus gambar lama dari server jika ada
            if (!empty($oldEvent->image) && file_exists('./uploads/event/' . $oldEvent->image)) {
                unlink('./uploads/event/' . $oldEvent->image);
            }
        } else {
            // Jika tidak ada gambar baru, tetap gunakan gambar lama
            $data['image'] = $oldEvent->image;
        }

        // Update data di database
        $this->db->where('id', $id);
        $this->db->update('events', $data);

        $this->session->set_flashdata('success', 'Events update successfully.');
        redirect('event');
    }

    // Menghapus event
    public function delete($id)
    {
        // Ambil data event untuk mendapatkan nama gambar
        $event = $this->db->get_where('events', ['id' => $id])->row();

        // Hapus gambar dari server jika ada
        if (!empty($event->image) && file_exists('./uploads/event/' . $event->image)) {
            unlink('./uploads/event/' . $event->image);
        }

        // Hapus data dari database
        $this->db->delete('events', ['id' => $id]);

        $this->session->set_flashdata('success', 'Events delete successfully.');
        redirect('event');
    }
}
