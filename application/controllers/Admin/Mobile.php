<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobile extends CI_Controller
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
        $data['title'] = 'Mobile Content';

        // Fetch data from the 'report' table where category is 'mobile'
        $this->db->where('category', 'mobile'); // Specify the category condition
        $this->db->where('type', 'pdf');
        $this->db->order_by('created_at', 'DESC');
        $data['reports'] = $this->db->get('reports')->result_array(); // Fetch results as an array

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/mobile/view', $data); // Pass data to the view
        $this->load->view('template/cms/footer');
    }

    public function add()
    {
        $data['title'] = 'New Report | Mobile Content';

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/mobile/add', $data); // Pass data to the view
        $this->load->view('template/cms/footer');
    }

    public function submit()
    {
        // Get form data
        $title = $this->input->post('title');
        $category = $this->input->post('category');
        $type = $this->input->post('type');

        // Handle file uploads
        $image = $_FILES['image']['name'];
        $file = $_FILES['file']['name'];

        // Upload image
        if ($image) {
            // Configure upload for image
            $config['upload_path'] = './uploads/image/'; // Path for images
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

        // Upload file (report)
        if ($file) {
            // Configure upload for report
            $config['upload_path'] = './uploads/report/'; // Path for reports
            $config['allowed_types'] = 'pdf'; // Allowed report types

            // Initialize the upload library with the config
            $this->upload->initialize($config);

            // Perform the upload
            if (!$this->upload->do_upload('file')) {
                // Handle file upload error
                $error = $this->upload->display_errors();
                echo "File upload error: " . $error;
                return;
            } else {
                $file = $this->upload->data('file_name'); // Get the uploaded file name
            }
        }

        // Prepare data for insertion
        $data = array(
            'title' => $title,
            'category' => $category,
            'type' => $type,
            'image' => $image,
            'file' => $file,
            'created_at' => date('Y-m-d H:i:s'), // Optional: add created timestamp
        );

        // Insert into the database
        $this->db->insert('reports', $data);

        $this->session->set_flashdata('success', 'Report insert successfully.');

        // Redirect or load a view with a success message
        redirect('admin/mobile'); // Redirect to the mobile page or another page
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Report | Mobile Content';

        // Fetch the report details by ID
        $data['report'] = $this->db->get_where('reports', ['id' => $id])->row_array();

        if (empty($data['report'])) {
            // If the report doesn't exist, show an error message
            $this->session->set_flashdata('error', 'Report not found.');
            redirect('admin/mobile');
        }

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/mobile/edit', $data); // Pass data to the view
        $this->load->view('template/cms/footer');
    }


    public function update($id)
    {
        // Get form data
        $title = $this->input->post('title');
        $category = $this->input->post('category');
        $type = $this->input->post('type');

        // Prepare data for updating
        $data = array(
            'title' => $title,
            'category' => $category,
            'type' => $type,
        );

        // Get old report details
        $old_report = $this->db->get_where('reports', ['id' => $id])->row_array();

        // Handle image upload
        if ($_FILES['image']['name']) {
            // Configure upload for image
            $config['upload_path'] = './uploads/image/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                echo "Image upload error: " . $error;
                return;
            } else {
                // Delete old image if exists
                $old_image_path = './uploads/image/' . $old_report['image'];
                if (file_exists($old_image_path)) {
                    unlink($old_image_path); // Delete old image
                }
                // Update the image data
                $data['image'] = $this->upload->data('file_name');
            }
        } else {
            // If no new image is uploaded, keep the old image
            $data['image'] = $old_report['image'];
        }

        // Handle file upload
        if ($_FILES['file']['name']) {
            // Configure upload for report
            $config['upload_path'] = './uploads/report/';
            $config['allowed_types'] = 'pdf';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();
                echo "File upload error: " . $error;
                return;
            } else {
                // Delete old file if exists
                $old_file_path = './uploads/report/' . $old_report['file'];
                if (file_exists($old_file_path)) {
                    unlink($old_file_path); // Delete old file
                }
                // Update the file data
                $data['file'] = $this->upload->data('file_name');
            }
        } else {
            // If no new file is uploaded, keep the old file
            $data['file'] = $old_report['file'];
        }

        // Update the report in the database
        $this->db->update('reports', $data, ['id' => $id]);

        // Redirect with success message
        $this->session->set_flashdata('success', 'Report updated successfully.');
        redirect('admin/mobile'); // Redirect to the mobile page or another page
    }


    public function delete($id)
    {
        // Fetch the report details by ID
        $report = $this->db->get_where('reports', ['id' => $id])->row_array();

        if ($report) {
            // Define the paths to the files
            $image_path = './uploads/image/' . $report['image'];
            $file_path = './uploads/report/' . $report['file'];

            // Delete the files if they exist
            if (file_exists($image_path)) {
                unlink($image_path); // Delete image
            }
            if (file_exists($file_path)) {
                unlink($file_path); // Delete file
            }

            // Delete the report from the database
            $this->db->delete('reports', ['id' => $id]);

            // Redirect or load a view with a success message
            $this->session->set_flashdata('success', 'Report deleted successfully.');
            redirect('admin/mobile'); // Redirect to the mobile page or another page
        } else {
            // If the report doesn't exist
            $this->session->set_flashdata('error', 'Report not found.');
            redirect('admin/mobile');
        }
    }

    public function article()
    {
        $data['title'] = 'Mobile Articles';

        // Fetch data from the 'reports' table where category is 'mobile' and type is 'article'
        $this->db->where('category', 'mobile'); // Specify the category condition
        $this->db->where('type', 'article'); // Specify the type condition
        $this->db->order_by('created_at', 'DESC');
        $data['reports'] = $this->db->get('reports')->result_array(); // Fetch results as an array

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/mobile/view_article', $data); // Pass data to the view
        $this->load->view('template/cms/footer');
    }

    public function submit_article()
    {
        // Get form data
        $title = $this->input->post('title');
        $desc = $this->input->post('desc');
        $content = $this->input->post('content');

        // Handle file uploads
        $image = $_FILES['image']['name'];
        $file = $_FILES['file']['name'];

        // Upload image
        if ($image) {
            // Configure upload for image
            $config['upload_path'] = './uploads/image/'; // Path for images
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

        // Upload file (report)
        if ($file) {
            // Configure upload for report
            $config['upload_path'] = './uploads/articles/mobile/'; // Path for reports
            $config['allowed_types'] = 'pdf'; // Allowed report types

            // Initialize the upload library with the config
            $this->upload->initialize($config);

            // Perform the upload
            if (!$this->upload->do_upload('file')) {
                // Handle file upload error
                $error = $this->upload->display_errors();
                echo "File upload error: " . $error;
                return;
            } else {
                $file = $this->upload->data('file_name'); // Get the uploaded file name
            }
        }

        // Prepare data for insertion
        $data = array(
            'title' => $title,
            'desc' => $desc,
            'content' => $content,
            'category' => 'mobile',
            'type' => 'article',
            'image' => $image,
            'file' => $file,
            'created_at' => date('Y-m-d H:i:s'), // Optional: add created timestamp
        );

        // Insert into the database
        $this->db->insert('reports', $data);

        $this->session->set_flashdata('success', 'Articles insert successfully.');
        // Redirect or load a view with a success message
        redirect('mobile-article'); // Redirect to the mobile page or another page
    }

    public function update_articles($id)
    {
        // Get form data
        $title = $this->input->post('title');
        $desc = $this->input->post('desc');
        $content = $this->input->post('content');

        // Prepare data for updating
        $data = array(
            'title' => $title,
            'desc' => $desc,
            'content' => $content,
        );

        // Get old report details
        $old_report = $this->db->get_where('reports', ['id' => $id])->row_array();

        // Handle image upload
        if ($_FILES['image']['name']) {
            // Configure upload for image
            $config['upload_path'] = './uploads/image/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                echo "Image upload error: " . $error;
                return;
            } else {
                // Delete old image if exists
                $old_image_path = './uploads/image/' . $old_report['image'];
                if (file_exists($old_image_path)) {
                    unlink($old_image_path); // Delete old image
                }
                // Update the image data
                $data['image'] = $this->upload->data('file_name');
            }
        } else {
            // If no new image is uploaded, keep the old image
            $data['image'] = $old_report['image'];
        }

        // Handle file upload
        if ($_FILES['file']['name']) {
            // Configure upload for report
            $config['upload_path'] = './uploads/articles/mobile/';
            $config['allowed_types'] = 'pdf';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();
                echo "File upload error: " . $error;
                return;
            } else {
                // Delete old file if exists
                $old_file_path = './uploads/articles/mobile/' . $old_report['file'];
                if (file_exists($old_file_path)) {
                    unlink($old_file_path); // Delete old file
                }
                // Update the file data
                $data['file'] = $this->upload->data('file_name');
            }
        } else {
            // If no new file is uploaded, keep the old file
            $data['file'] = $old_report['file'];
        }

        // Update the report in the database
        $this->db->update('reports', $data, ['id' => $id]);

        // Redirect with success message
        $this->session->set_flashdata('success', 'Articles updated successfully.');
        redirect('mobile-article'); // Redirect to the mobile page or another page
    }

    public function delete_article($id)
    {
        // Fetch the report details by ID
        $report = $this->db->get_where('reports', ['id' => $id])->row_array();

        if ($report) {
            // Define the paths to the files
            $image_path = './uploads/image/' . $report['image'];
            $file_path = './uploads/articles/mobile/' . $report['file'];

            // Delete the files if they exist
            if (file_exists($image_path)) {
                unlink($image_path); // Delete image
            }
            if (file_exists($file_path)) {
                unlink($file_path); // Delete file
            }

            // Delete the report from the database
            $this->db->delete('reports', ['id' => $id]);

            // Redirect or load a view with a success message
            $this->session->set_flashdata('success', 'Articles deleted successfully.');
            redirect('mobile-article'); // Redirect to the mobile page or another page
        } else {
            // If the report doesn't exist
            $this->session->set_flashdata('error', 'Articles not found.');
            redirect('mobile-article');
        }
    }

    public function videos()
    {
        $data['title'] = 'Videos List';

        // Fetch data from the 'report' table where category is 'mobile'
        $this->db->where('category', 'mobile'); // Specify the category condition
        $data['videos'] = $this->db->get('videos')->result_array(); // Fetch results as an array

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/mobile/view_videos', $data); // Pass data to the view
        $this->load->view('template/cms/footer');
    }

    public function insert_videos()
    {
        // Ambil data dari form
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $link = $this->input->post('link');

        // Siapkan data untuk di-insert
        $data = [
            'title' => $title,
            'category' => 'mobile',
            'description' => $description,
            'link' => $link,
            'created_at' => date('Y-m-d H:i:s'), // Optional: add created timestamp
        ];

        // Insert data ke database
        $this->db->insert('videos', $data);

        // Set notifikasi berhasil dan redirect ke halaman kategori
        $this->session->set_flashdata('success', 'Video berhasil ditambahkan.');
        redirect('mobile-videos');
    }

    public function update_videos($id)
    {
        // Ambil data dari form
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $link = $this->input->post('link');

        // Siapkan data untuk di-insert
        $data = [
            'title' => $title,
            'description' => $description,
            'link' => $link,
        ];

        // Update data di database
        $this->db->where('id', $id);
        $this->db->update('videos', $data);

        // Set notifikasi berhasil dan redirect ke halaman kategori
        $this->session->set_flashdata('success', 'Video berhasil diupdate.');
        redirect('mobile-videos');
    }

    public function delete_videos($id)
    {
        // Periksa apakah ID kategori ada di database
        $category = $this->db->get_where('videos', ['id' => $id])->row_array();

        if ($category) {
            // Jika kategori ada, hapus dari database
            $this->db->where('id', $id);
            $this->db->delete('videos');

            // Set notifikasi berhasil dan redirect ke halaman kategori
            $this->session->set_flashdata('success', 'Video berhasil dihapus.');
        } else {
            // Jika kategori tidak ditemukan, tampilkan pesan error
            $this->session->set_flashdata('error', 'Kategori tidak ditemukan.');
        }

        redirect('mobile-videos');
    }
}
