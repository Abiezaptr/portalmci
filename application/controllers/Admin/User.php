<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Cek apakah session user_id ada, jika tidak redirect ke halaman login
        if (!$this->session->userdata('user_id')) {
            redirect('login'); // Ganti 'login' sesuai dengan route halaman login Anda
        }
    }

    public function index()
    {
        $data['title'] = 'Manage User';

        $roles = [3, 4, 5, 6];
        $this->db->where_in('role', $roles);
        $data['users'] = $this->db->get('users')->result_array(); // Ambil hasil sebagai array

        // Load tampilan
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/user/view', $data);
        $this->load->view('template/cms/footer');
    }

    public function insert()
    {
        // Ambil data dari form
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $role = $this->input->post('role');

        // Siapkan data untuk di-insert, dengan password yang di-hash menggunakan md5
        $data = [
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'password' => md5('123'), // Password default dengan md5 hash
            'created_at' => date('Y-m-d H:i:s'), // Optional: add created timestamp
        ];

        // Insert data ke database
        $this->db->insert('users', $data);

        // Set notifikasi berhasil dan redirect ke halaman kategori
        $this->session->set_flashdata('success', 'Users added successfully.');
        redirect('manage-user');
    }

    public function update($id)
    {
        // Ambil data dari form
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $role = $this->input->post('role');

        // Siapkan data untuk di-insert
        $data = [
            'username' => $username,
            'email' => $email,
            'role' => $role,
        ];

        // Update data di database
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        // Set notifikasi berhasil dan redirect ke halaman kategori
        $this->session->set_flashdata('success', 'User Data updated successfully.');
        redirect('manage-user');
    }

    public function delete($id)
    {
        // Periksa apakah ID kategori ada di database
        $user = $this->db->get_where('users', ['id' => $id])->row_array();

        if ($user) {
            // Jika kategori ada, hapus dari database
            $this->db->where('id', $id);
            $this->db->delete('users');

            // Set notifikasi berhasil dan redirect ke halaman kategori
            $this->session->set_flashdata('success', 'Users data has been successfully deleted.');
        } else {
            // Jika kategori tidak ditemukan, tampilkan pesan error
            $this->session->set_flashdata('error', 'User data not found.');
        }

        redirect('manage-user');
    }
}