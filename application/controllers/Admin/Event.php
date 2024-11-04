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

        // Mendapatkan tanggal hari ini dalam timezone Asia/Jakarta
        $today = date('Y-m-d');

        // Query hanya untuk event yang akan datang
        $this->db->where('date >=', $today);
        $query = $this->db->get('events');

        $data['events'] = $query->result();

        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/event/view', $data);
        $this->load->view('template/cms/footer');
    }

    // Menyimpan event baru
    public function insert()
    {
        $data = [
            'title' => $this->input->post('title'),
            'date' => $this->input->post('date'),
            'location' => $this->input->post('location'),
            'description' => $this->input->post('description')
        ];

        // Proses upload gambar
        $config['upload_path']   = './uploads/event'; // Pastikan folder ini sudah ada dan writable
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048; // Maksimal 2MB

        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
            $data['image'] = $uploadData['file_name'];
        }

        $this->db->insert('events', $data);
        redirect('event');
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
        redirect('event');
    }
}
