<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Digital extends CI_Controller
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

        // Cek apakah session role ada dan apakah role termasuk dalam daftar yang diizinkan
        $allowed_roles = [1, 3, 4, 5, 6];
        if (!in_array($this->session->userdata('role'), $allowed_roles)) {
            redirect('login'); // Ganti 'unauthorized' sesuai dengan route halaman yang diinginkan
        }
    }

    public function index()
    {
        $data['title'] = 'Digital Report';

        // Fetch data from the 'report' table where category is 'mobile'
        $this->db->where('category', 'digital insight'); // Specify the category condition
        $this->db->where('type', 'pdf');
        $this->db->order_by('created_at', 'DESC');
        $data['reports'] = $this->db->get('reports')->result_array(); // Fetch results as an array

        // Memanggil fungsi-fungsi yang ditambahkan
        $user_logs = $this->user_log();
        $upload_logs = $this->get_upload_logs();
        $user_read_logs = $this->get_user_read_logs();
        $invitation_thread_logs = $this->get_invitation_thread_logs();

        // Menggabungkan semua log ke dalam satu array
        $notifications = [];

        foreach ($user_logs as $log) {
            $notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        foreach ($upload_logs as $log) {
            $notifications[] = [
                'type' => 'upload_log',
                'message' => $log->username . ' ' . $log->message . '.',
                'timestamp' => $log->upload_time
            ];
        }

        foreach ($user_read_logs as $log_id) {
            // Anda perlu mengambil detail log berdasarkan log_id jika diperlukan
            // Misalnya, ambil detail dari tabel user_read_logs
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $notifications[] = [
                    'type' => 'user_read_log',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time // Ganti dengan kolom waktu yang sesuai
                ];
            }
        }

        foreach ($invitation_thread_logs as $log) {
            $user_ids = explode(',', $log->user_id);
            foreach ($user_ids as $user_id) {
                $this->db->select('username');
                $this->db->from('users');
                $this->db->where('id', $user_id);
                $user = $this->db->get()->row();

                if ($user) {
                    $notifications[] = [
                        'type' => 'invitation_thread_log',
                        'message' => $user->username . ' ' . $log->message,
                        'timestamp' => $log->invitation_time
                    ];
                }
            }
        }

        // Mengurutkan notifikasi berdasarkan timestamp
        usort($notifications, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Batasi jumlah notifikasi yang ditampilkan (misalnya 5)
        $data['notifications'] = array_slice($notifications, 0, 5);

        // Menghitung total notifikasi
        $data['total_notifications'] = count($notifications);

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/digital/view', $data); // Pass data to the view
        $this->load->view('template/cms/footer');
    }

    // Fungsi-fungsi yang ditambahkan
    public function user_log()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.status', 'NONAKTIF'); // Menambahkan kondisi untuk status non-aktif
        $this->db->order_by('users.created_at', 'DESC'); // Mengurutkan berdasarkan waktu pembuatan pengguna
        $this->db->limit(5); // Mengambil maksimal 5 entri
        $query = $this->db->get();
        return $query->result();
    }

    // Method untuk mengambil semua log
    public function get_upload_logs()
    {
        $this->db->select('report_log.*, users.username, reports.title as document_name');
        $this->db->from('report_log');
        $this->db->join('users', 'report_log.user_id = users.id');
        $this->db->join('reports', 'report_log.report_id = reports.id');
        $this->db->order_by('upload_time', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user_read_logs()
    {
        $user_id = $this->session->userdata('id');
        $this->db->select('log_id');
        $this->db->from('user_read_logs');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return array_column($query->result_array(), 'log_id');
    }

    public function get_invitation_thread_logs()
    {
        $this->db->select('invitation_thread_log.*, invited_by_users.username as invited_by_username');
        $this->db->from('invitation_thread_log');
        $this->db->join('users as invited_by_users', 'invitation_thread_log.invited_by = invited_by_users.id');
        $this->db->order_by('invitation_thread_log.invitation_time', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    public function add()
    {
        $data['title'] = 'New Report';

        // Memanggil fungsi-fungsi yang ditambahkan
        $user_logs = $this->user_log();
        $upload_logs = $this->get_upload_logs();
        $user_read_logs = $this->get_user_read_logs();
        $invitation_thread_logs = $this->get_invitation_thread_logs();

        // Menggabungkan semua log ke dalam satu array
        $notifications = [];

        foreach ($user_logs as $log) {
            $notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        foreach ($upload_logs as $log) {
            $notifications[] = [
                'type' => 'upload_log',
                'message' => $log->username . ' ' . $log->message . '.',
                'timestamp' => $log->upload_time
            ];
        }

        foreach ($user_read_logs as $log_id) {
            // Anda perlu mengambil detail log berdasarkan log_id jika diperlukan
            // Misalnya, ambil detail dari tabel user_read_logs
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $notifications[] = [
                    'type' => 'user_read_log',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time // Ganti dengan kolom waktu yang sesuai
                ];
            }
        }

        foreach ($invitation_thread_logs as $log) {
            $user_ids = explode(',', $log->user_id);
            foreach ($user_ids as $user_id) {
                $this->db->select('username');
                $this->db->from('users');
                $this->db->where('id', $user_id);
                $user = $this->db->get()->row();

                if ($user) {
                    $notifications[] = [
                        'type' => 'invitation_thread_log',
                        'message' => $user->username . ' ' . $log->message,
                        'timestamp' => $log->invitation_time
                    ];
                }
            }
        }

        // Mengurutkan notifikasi berdasarkan timestamp
        usort($notifications, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Batasi jumlah notifikasi yang ditampilkan (misalnya 5)
        $data['notifications'] = array_slice($notifications, 0, 5);

        // Menghitung total notifikasi
        $data['total_notifications'] = count($notifications);

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/digital/add', $data); // Pass data to the view
        $this->load->view('template/cms/footer');
    }

    public function submit()
    {
        // Get form data
        $title = $this->input->post('title');
        $keywords = $this->input->post('keywords');

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
            'category' => 'digital insight',
            'type' => 'pdf',
            'image' => $image,
            'file' => $file,
            'created_at' => date('Y-m-d H:i:s'), // Optional: add created timestamp
        );

        $data['keywords'] = $keywords;

        // Insert into the database
        $this->db->insert('reports', $data);

        // Get the last inserted report ID
        $report_id = $this->db->insert_id();

        $log_data = array(
            'user_id' => $this->session->userdata('id'), // Get user_id from session
            'report_id' => $report_id,
            'upload_time' => date('Y-m-d H:i:s'), // Current timestamp
            'message' => 'telah menambahkan report ' . $title . ' pada Group Digital Consumer Inisght', // Custom message with title and category
            'is_read' => 0 // Default value for is_read
        );

        // Insert into the report_log table
        $this->db->insert('report_log', $log_data);

        $this->session->set_flashdata('success', 'Report insert successfully.');
        // Redirect or load a view with a success message
        redirect('digital-report'); // Redirect to the mobile page or another page
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Report';

        // Fetch the report details by ID
        $data['report'] = $this->db->get_where('reports', ['id' => $id])->row_array();

        if (empty($data['report'])) {
            // If the report doesn't exist, show an error message
            $this->session->set_flashdata('error', 'Report not found.');
            redirect('digital-report');
        }

        // Memanggil fungsi-fungsi yang ditambahkan
        $user_logs = $this->user_log();
        $upload_logs = $this->get_upload_logs();
        $user_read_logs = $this->get_user_read_logs();
        $invitation_thread_logs = $this->get_invitation_thread_logs();

        // Menggabungkan semua log ke dalam satu array
        $notifications = [];

        foreach ($user_logs as $log) {
            $notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        foreach ($upload_logs as $log) {
            $notifications[] = [
                'type' => 'upload_log',
                'message' => $log->username . ' ' . $log->message . '.',
                'timestamp' => $log->upload_time
            ];
        }

        foreach ($user_read_logs as $log_id) {
            // Anda perlu mengambil detail log berdasarkan log_id jika diperlukan
            // Misalnya, ambil detail dari tabel user_read_logs
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $notifications[] = [
                    'type' => 'user_read_log',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time // Ganti dengan kolom waktu yang sesuai
                ];
            }
        }

        foreach ($invitation_thread_logs as $log) {
            $user_ids = explode(',', $log->user_id);
            foreach ($user_ids as $user_id) {
                $this->db->select('username');
                $this->db->from('users');
                $this->db->where('id', $user_id);
                $user = $this->db->get()->row();

                if ($user) {
                    $notifications[] = [
                        'type' => 'invitation_thread_log',
                        'message' => $user->username . ' ' . $log->message,
                        'timestamp' => $log->invitation_time
                    ];
                }
            }
        }

        // Mengurutkan notifikasi berdasarkan timestamp
        usort($notifications, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Batasi jumlah notifikasi yang ditampilkan (misalnya 5)
        $data['notifications'] = array_slice($notifications, 0, 5);

        // Menghitung total notifikasi
        $data['total_notifications'] = count($notifications);

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/digital/edit', $data); // Pass data to the view
        $this->load->view('template/cms/footer');
    }


    public function update($id)
    {
        // Get form data
        $title = $this->input->post('title');
        $keywords = $this->input->post('keywords');

        // Prepare data for updating
        $data = array(
            'title' => $title,
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

        // Check if keywords are empty and set to NULL if so    
        $data['keywords'] = !empty($keywords) ? $keywords : NULL; // Set to NULL if empty 

        // Update the report in the database
        $this->db->update('reports', $data, ['id' => $id]);

        // Redirect with success message
        $this->session->set_flashdata('success', 'Report updated successfully.');
        redirect('digital-report'); // Redirect to the mobile page or another page
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
            redirect('digital-report'); // Redirect to the mobile page or another page
        } else {
            // If the report doesn't exist
            $this->session->set_flashdata('error', 'Report not found.');
            redirect('digital-report');
        }
    }

    public function article()
    {
        $data['title'] = 'Digital Insight Articles';

        $this->db->where('category', 'digital insight'); // Specify the category condition
        $this->db->where('type', 'article'); // Specify the type condition
        $this->db->order_by('created_at', 'DESC');
        $data['reports'] = $this->db->get('reports')->result_array(); // Fetch results as an array

        // Memanggil fungsi-fungsi yang ditambahkan
        $user_logs = $this->user_log();
        $upload_logs = $this->get_upload_logs();
        $user_read_logs = $this->get_user_read_logs();
        $invitation_thread_logs = $this->get_invitation_thread_logs();

        // Menggabungkan semua log ke dalam satu array
        $notifications = [];

        foreach ($user_logs as $log) {
            $notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        foreach ($upload_logs as $log) {
            $notifications[] = [
                'type' => 'upload_log',
                'message' => $log->username . ' ' . $log->message . '.',
                'timestamp' => $log->upload_time
            ];
        }

        foreach ($user_read_logs as $log_id) {
            // Anda perlu mengambil detail log berdasarkan log_id jika diperlukan
            // Misalnya, ambil detail dari tabel user_read_logs
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $notifications[] = [
                    'type' => 'user_read_log',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time // Ganti dengan kolom waktu yang sesuai
                ];
            }
        }

        foreach ($invitation_thread_logs as $log) {
            $user_ids = explode(',', $log->user_id);
            foreach ($user_ids as $user_id) {
                $this->db->select('username');
                $this->db->from('users');
                $this->db->where('id', $user_id);
                $user = $this->db->get()->row();

                if ($user) {
                    $notifications[] = [
                        'type' => 'invitation_thread_log',
                        'message' => $user->username . ' ' . $log->message,
                        'timestamp' => $log->invitation_time
                    ];
                }
            }
        }

        // Mengurutkan notifikasi berdasarkan timestamp
        usort($notifications, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Batasi jumlah notifikasi yang ditampilkan (misalnya 5)
        $data['notifications'] = array_slice($notifications, 0, 5);

        // Menghitung total notifikasi
        $data['total_notifications'] = count($notifications);

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/digital/view_article', $data); // Pass data to the view
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
            $config['upload_path'] = './uploads/articles/digital_insight/'; // Path for reports
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
            'category' => 'digital insight',
            'type' => 'article',
            'image' => $image,
            'file' => $file,
            'created_at' => date('Y-m-d H:i:s'), // Optional: add created timestamp
        );

        // Insert into the database
        $this->db->insert('reports', $data);

        $this->session->set_flashdata('success', 'Articles insert successfully.');
        // Redirect or load a view with a success message
        redirect('digital-article'); // Redirect to the mobile page or another page
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
            $config['upload_path'] = './uploads/articles/digital_insight/';
            $config['allowed_types'] = 'pdf';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();
                echo "File upload error: " . $error;
                return;
            } else {
                // Delete old file if exists
                $old_file_path = './uploads/articles/digital_insight/' . $old_report['file'];
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
        redirect('digital-article'); // Redirect to the mobile page or another page
    }

    public function delete_article($id)
    {
        // Fetch the report details by ID
        $report = $this->db->get_where('reports', ['id' => $id])->row_array();

        if ($report) {
            // Define the paths to the files
            $image_path = './uploads/image/' . $report['image'];
            $file_path = './uploads/articles/digital_insight/' . $report['file'];

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
            redirect('digital-article'); // Redirect to the mobile page or another page
        } else {
            // If the report doesn't exist
            $this->session->set_flashdata('error', 'Articles not found.');
            redirect('digital-article');
        }
    }

    public function videos()
    {
        $data['title'] = 'Videos List';

        // Fetch data from the 'report' table where category is 'mobile'
        $this->db->where('category', 'digital insight'); // Specify the category condition
        $data['videos'] = $this->db->get('videos')->result_array(); // Fetch results as an array

        // Memanggil fungsi-fungsi yang ditambahkan
        $user_logs = $this->user_log();
        $upload_logs = $this->get_upload_logs();
        $user_read_logs = $this->get_user_read_logs();
        $invitation_thread_logs = $this->get_invitation_thread_logs();

        // Menggabungkan semua log ke dalam satu array
        $notifications = [];

        foreach ($user_logs as $log) {
            $notifications[] = [
                'type' => 'user_log',
                'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
                'timestamp' => $log->created_at
            ];
        }

        foreach ($upload_logs as $log) {
            $notifications[] = [
                'type' => 'upload_log',
                'message' => $log->username . ' ' . $log->message . '.',
                'timestamp' => $log->upload_time
            ];
        }

        foreach ($user_read_logs as $log_id) {
            // Anda perlu mengambil detail log berdasarkan log_id jika diperlukan
            // Misalnya, ambil detail dari tabel user_read_logs
            $this->db->select('*');
            $this->db->from('user_read_logs');
            $this->db->where('log_id', $log_id);
            $log_detail = $this->db->get()->row();

            if ($log_detail) {
                $notifications[] = [
                    'type' => 'user_read_log',
                    'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
                    'timestamp' => $log_detail->read_time // Ganti dengan kolom waktu yang sesuai
                ];
            }
        }

        foreach ($invitation_thread_logs as $log) {
            $user_ids = explode(',', $log->user_id);
            foreach ($user_ids as $user_id) {
                $this->db->select('username');
                $this->db->from('users');
                $this->db->where('id', $user_id);
                $user = $this->db->get()->row();

                if ($user) {
                    $notifications[] = [
                        'type' => 'invitation_thread_log',
                        'message' => $user->username . ' ' . $log->message,
                        'timestamp' => $log->invitation_time
                    ];
                }
            }
        }

        // Mengurutkan notifikasi berdasarkan timestamp
        usort($notifications, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Batasi jumlah notifikasi yang ditampilkan (misalnya 5)
        $data['notifications'] = array_slice($notifications, 0, 5);

        // Menghitung total notifikasi
        $data['total_notifications'] = count($notifications);

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/digital/view_videos', $data); // Pass data to the view
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
            'category' => 'digital insight',
            'description' => $description,
            'link' => $link,
            'created_at' => date('Y-m-d H:i:s'), // Optional: add created timestamp
        ];

        // Insert data ke database
        $this->db->insert('videos', $data);

        // Set notifikasi berhasil dan redirect ke halaman kategori
        $this->session->set_flashdata('success', 'Video berhasil ditambahkan.');
        redirect('digital-videos');
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
        redirect('digital-videos');
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

        redirect('digital-videos');
    }
}
