<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
        $this->load->library('upload'); // Load the upload library

        // Cek apakah session user_id ada, jika tidak redirect ke halaman login
        if (!$this->session->userdata('id')) {
            redirect('login'); // Ganti 'login' sesuai dengan route halaman login Anda
        }
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

    // public function submit()
    // {
    //     // Ambil data dari form
    //     $title = $this->input->post('title');
    //     $content = $this->input->post('content');
    //     $category_id = $this->input->post('category_id');
    //     $posted_by = $this->input->post('posted_by');
    //     $user_ids = $this->input->post('user_id');

    //     // Siapkan data untuk disimpan ke tabel forum
    //     $data = [
    //         'title' => $title,
    //         'content' => $content,
    //         'category_id' => $category_id,
    //         'posted_by' => $posted_by,
    //         'replies_count' => 0,
    //         'views_count' => 0,
    //         'created_at' => date('Y-m-d H:i:s'),
    //     ];

    //     // Simpan data forum ke tabel forum
    //     $this->db->insert('forum_threads', $data);
    //     $forum_id = $this->db->insert_id(); // Ambil ID forum yang baru saja dimasukkan

    //     // Gabungkan user_id yang dipilih menjadi string
    //     if ($user_ids) {
    //         $user_ids_string = implode(',', $user_ids); // Menggabungkan menjadi format "12,14,17"
    //         $this->db->update('forum_threads', ['user_id' => $user_ids_string], ['id' => $forum_id]);
    //     }

    //     // Redirect ke halaman forum atau berikan pesan sukses
    //     $this->session->set_flashdata('success', 'Thread created successfully.');
    //     redirect('admin/forum'); // Sesuaikan dengan rute yang sesuai
    // }

    // public function submit()
    // {
    //     // Collect form data
    //     $title = $this->input->post('title');
    //     $content = $this->input->post('content');
    //     $category_id = $this->input->post('category_id');
    //     $posted_by = $this->input->post('posted_by');
    //     $user_ids = $this->input->post('user_id');

    //     // Prepare data for the forum_threads table
    //     $data = [
    //         'title' => $title,
    //         'content' => $content, // Contains both text and image URLs
    //         'category_id' => $category_id,
    //         'posted_by' => $posted_by,
    //         'replies_count' => 0,
    //         'views_count' => 0,
    //         'created_at' => date('Y-m-d H:i:s'),
    //     ];

    //     // Save to forum_threads table
    //     $this->db->insert('forum_threads', $data);
    //     $forum_id = $this->db->insert_id();

    //     // Save user IDs as a comma-separated string if provided
    //     if ($user_ids) {
    //         $user_ids_string = implode(',', $user_ids);
    //         $this->db->update('forum_threads', ['user_id' => $user_ids_string], ['id' => $forum_id]);
    //     }

    //     // Redirect with success message
    //     $this->session->set_flashdata('success', 'Thread created successfully.');
    //     redirect('admin/forum');
    // }

    public function submit()
    {
        // Collect form data
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $category_id = $this->input->post('category_id');
        $posted_by = $this->input->post('posted_by');
        $user_ids = $this->input->post('user_id');

        // Handle image upload if provided
        $image_name = null;
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './uploads/forum_threads/'; // Set the upload directory
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Set allowed file types
            $config['file_name'] = time() . '_' . $_FILES['image']['name']; // Unique file name

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $image_data = $this->upload->data();
                $image_name = $image_data['file_name']; // Save only the file name
            } else {
                // Handle upload error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Image upload failed: ' . $error);
                redirect('admin/forum');
                return;
            }
        }

        // Prepare data for the forum_threads table
        $data = [
            'title' => $title,
            'content' => $content, // Contains both text and image URLs
            'category_id' => $category_id,
            'posted_by' => $posted_by,
            'image' => $image_name, // Save only the image name if available
            'replies_count' => 0,
            'views_count' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Save to forum_threads table
        $this->db->insert('forum_threads', $data);
        $forum_id = $this->db->insert_id();

        // Save user IDs as a comma-separated string if provided
        if ($user_ids) {
            $user_ids_string = implode(',', $user_ids);
            $this->db->update('forum_threads', ['user_id' => $user_ids_string], ['id' => $forum_id]);
        }

        // Redirect with success message
        $this->session->set_flashdata('success', 'Thread created successfully.');
        redirect('admin/forum');
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
        // Check if the thread with the given ID exists
        $thread = $this->db->get_where('forum_threads', ['id' => $id])->row_array();

        if (empty($thread)) {
            // If the thread is not found, display an error message
            $this->session->set_flashdata('error', 'Thread not found.');
            redirect('admin/forum');
        }

        // Get data from the form
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $category_id = $this->input->post('category_id');
        $user_ids = $this->input->post('user_id'); // Get user_id array

        // Handle image upload
        if ($_FILES['image']['name']) {
            // Configure upload for the image
            $config['upload_path'] = './uploads/forum_threads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $this->upload->initialize($config);

            // Attempt to upload the new image
            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Image upload error: ' . $error);
                redirect('admin/forum/edit/' . $id); // Redirect back to edit page on error
            } else {
                // Delete the old image if it exists
                $old_image_path = './uploads/forum_threads/' . $thread['image'];
                if (file_exists($old_image_path)) {
                    unlink($old_image_path); // Delete old image
                }
                // Update the image data
                $data['image'] = $this->upload->data('file_name');
            }
        } else {
            // If no new image is uploaded, keep the old image
            $data['image'] = $thread['image'];
        }

        // Prepare the data for the update
        $data = [
            'title' => $title,
            'content' => $content,
            'image' => $data['image'], // Set the image here
            'category_id' => $category_id,
            'user_id' => implode(',', $user_ids) // Combine user_id into a string
        ];

        // Perform the update in the database
        $this->db->where('id', $id);
        $updated = $this->db->update('forum_threads', $data);

        if ($updated) {
            // If the update is successful
            $this->session->set_flashdata('success', 'Thread updated successfully.');
        } else {
            // If the update fails
            $this->session->set_flashdata('error', 'Failed to update thread.');
        }

        // Redirect back to the forum page
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

    public function forum_category()
    {
        $data['title'] = 'Threads Category ';

        // Ambil semua thread dengan join ke tabel category
        $this->db->select('*');
        $this->db->from('forum_category');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $data['categories'] = $query->result_array();

        // Load the views with the data
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/forum/category_list', $data);
        $this->load->view('template/cms/footer');
    }

    public function insert_category()
    {
        // Ambil data dari form
        $name = $this->input->post('name');

        // Siapkan data untuk di-insert
        $data = [
            'name' => $name,
        ];

        // Insert data ke database
        $this->db->insert('forum_category', $data);

        // Set notifikasi berhasil dan redirect ke halaman kategori
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan.');
        redirect('threads-category');
    }

    public function update_category($id)
    {
        // Ambil data dari form
        $name = $this->input->post('name');

        // Siapkan data untuk di-update
        $data = [
            'name' => $name,
        ];

        // Update data di database
        $this->db->where('id', $id);
        $this->db->update('forum_category', $data);

        // Set notifikasi berhasil dan redirect ke halaman kategori
        $this->session->set_flashdata('success', 'Kategori berhasil diupdate.');
        redirect('threads-category');
    }

    public function delete_category($id)
    {
        // Periksa apakah ID kategori ada di database
        $category = $this->db->get_where('forum_category', ['id' => $id])->row_array();

        if ($category) {
            // Jika kategori ada, hapus dari database
            $this->db->where('id', $id);
            $this->db->delete('forum_category');

            // Set notifikasi berhasil dan redirect ke halaman kategori
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus.');
        } else {
            // Jika kategori tidak ditemukan, tampilkan pesan error
            $this->session->set_flashdata('error', 'Kategori tidak ditemukan.');
        }

        redirect('threads-category');
    }
}
