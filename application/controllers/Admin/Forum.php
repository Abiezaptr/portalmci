<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
    }

    public function index()
    {
        $data['title'] = 'Forum Threads';

        $user_id = $this->session->userdata('id'); // Ambil user_id dari session
        $role = $this->session->userdata('role');

        if ($role == 1) {
            // Jika role adalah 1, ambil semua thread
            $this->db->select('forum_threads.*, forum_category.name AS category_name, GROUP_CONCAT(users.username) as usernames, GROUP_CONCAT(users.id) as user_ids');
            $this->db->join('users', 'forum_threads.user_id = users.id', 'left');
            $this->db->join('forum_category', 'forum_category.id = forum_threads.category_id', 'left');
            $this->db->group_by('forum_threads.id'); // Group by thread ID
            $data['threads'] = $this->db->get('forum_threads')->result_array();
        } else {
            // Jika bukan role 1, ambil thread yang diposting oleh user yang sama
            $this->db->where('posted_by', $user_id);
            $this->db->select('forum_threads.*, forum_category.name AS category_name, GROUP_CONCAT(users.username) as usernames, GROUP_CONCAT(users.id) as user_ids');
            $this->db->join('users', 'forum_threads.user_id = users.id', 'left');
            $this->db->join('forum_category', 'forum_category.id = forum_threads.category_id', 'left');
            $this->db->group_by('forum_threads.id'); // Group by thread ID
            $data['threads'] = $this->db->get('forum_threads')->result_array();
        }

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/forum/view', $data);
        $this->load->view('template/cms/footer');
    }

    public function add()
    {
        $data['title'] = 'New Threads';

        // Ambil data kategori dari tabel forum_category
        $data['categories'] = $this->db->get('forum_category')->result_array();

        // Ambil data users dengan role selain 1
        $data['users'] = $this->db->select('id, username')
            ->where('role !=', 1) // Tambahkan kondisi role != 1
            ->get('users')
            ->result_array();

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/forum/add', $data); // Pass data to the view
        $this->load->view('template/cms/footer');
    }

    public function submit()
    {
        // Ambil data dari form
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $category_id = $this->input->post('category_id');
        $posted_by = $this->input->post('posted_by');
        $user_ids = $this->input->post('user_id');

        // Siapkan data untuk disimpan ke tabel forum
        $data = [
            'title' => $title,
            'content' => $content,
            'category_id' => $category_id,
            'posted_by' => $posted_by,
            'replies_count' => 0,
            'views_count' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Simpan data forum ke tabel forum
        $this->db->insert('forum_threads', $data);
        $forum_id = $this->db->insert_id(); // Ambil ID forum yang baru saja dimasukkan

        // Gabungkan user_id yang dipilih menjadi string
        if ($user_ids) {
            $user_ids_string = implode(',', $user_ids); // Menggabungkan menjadi format "12,14,17"
            $this->db->update('forum_threads', ['user_id' => $user_ids_string], ['id' => $forum_id]);
        }

        // Redirect ke halaman forum atau berikan pesan sukses
        $this->session->set_flashdata('success', 'Thread created successfully.');
        redirect('admin/forum'); // Sesuaikan dengan rute yang sesuai
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Threads';

        // Fetch the thread details by ID
        $data['threads'] = $this->db->get_where('forum_threads', ['id' => $id])->row_array();

        // Fetch categories from forum_category table
        $data['categories'] = $this->db->get('forum_category')->result_array();

        // Fetch users with role other than 1
        $data['users'] = $this->db->select('id, username')
            ->where('role !=', 1)
            ->get('users')
            ->result_array();

        // Get user_ids from the thread
        if (!empty($data['threads']['user_id'])) {
            // Split user_id string into an array
            $data['joined_user_ids'] = explode(',', $data['threads']['user_id']);
        } else {
            $data['joined_user_ids'] = [];
        }

        if (empty($data['threads'])) {
            $this->session->set_flashdata('error', 'Report not found.');
            redirect('admin/forum');
        }

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/forum/edit', $data);
        $this->load->view('template/cms/footer');
    }



    public function update($id)
    {
        // Cek apakah thread dengan ID yang diberikan ada
        $thread = $this->db->get_where('forum_threads', ['id' => $id])->row_array();

        if (empty($thread)) {
            // Jika thread tidak ditemukan, tampilkan pesan error
            $this->session->set_flashdata('error', 'Thread not found.');
            redirect('admin/forum');
        }

        // Ambil data dari form
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $category_id = $this->input->post('category_id');
        $user_ids = $this->input->post('user_id'); // Ambil array user_id

        // Update data thread
        $data = [
            'title' => $title,
            'content' => $content,
            'category_id' => $category_id,
            'user_id' => implode(',', $user_ids) // Menggabungkan user_id menjadi string
        ];

        // Lakukan update di database
        $this->db->where('id', $id);
        $updated = $this->db->update('forum_threads', $data);

        if ($updated) {
            // Jika update berhasil
            $this->session->set_flashdata('success', 'Thread updated successfully.');
        } else {
            // Jika update gagal
            $this->session->set_flashdata('error', 'Failed to update thread.');
        }

        // Redirect kembali ke halaman forum
        redirect('admin/forum');
    }


    public function delete($id)
    {
        // Cek apakah thread dengan ID yang diberikan ada
        $thread = $this->db->get_where('forum_threads', ['id' => $id])->row_array();

        if (empty($thread)) {
            // Jika thread tidak ditemukan, tampilkan pesan error
            $this->session->set_flashdata('error', 'Thread not found.');
            redirect('admin/forum');
        }

        // Hapus thread dari database
        $this->db->where('id', $id);
        $deleted = $this->db->delete('forum_threads');

        if ($deleted) {
            // Jika penghapusan berhasil
            $this->session->set_flashdata('success', 'Thread deleted successfully.');
        } else {
            // Jika penghapusan gagal
            $this->session->set_flashdata('error', 'Failed to delete thread.');
        }

        // Redirect kembali ke halaman forum
        redirect('admin/forum');
    }
}
