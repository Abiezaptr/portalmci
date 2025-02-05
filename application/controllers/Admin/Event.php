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

        // Cek apakah session role ada dan apakah role termasuk dalam daftar yang diizinkan
        $allowed_roles = [1, 3, 4, 5, 6];
        if (!in_array($this->session->userdata('role'), $allowed_roles)) {
            redirect('login'); // Ganti 'unauthorized' sesuai dengan route halaman yang diinginkan
        }
    }

    // Menampilkan semua event
    public function index()
    {
        $data['title'] = 'Event Calendar';

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

        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/event/view', $data);
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


    // public function insert()
    // {
    //     // Ambil data dari form
    //     $event_name = $this->input->post('event_name');
    //     $title = $this->input->post('title');
    //     $start_date = $this->input->post('start_date');
    //     $end_date = $this->input->post('end_date');
    //     $location = $this->input->post('location');
    //     $description = $this->input->post('description');
    //     $color = $this->input->post('color');

    //     // Tangani upload gambar
    //     $image = $_FILES['image']['name'];

    //     // Upload gambar
    //     if ($image) {
    //         // Konfigurasi upload untuk gambar
    //         $config['upload_path'] = './uploads/event/'; // Path untuk gambar
    //         $config['allowed_types'] = 'jpg|jpeg|png'; // Tipe gambar yang diizinkan

    //         // Inisialisasi library upload dengan konfigurasi
    //         $this->upload->initialize($config);

    //         // Lakukan upload
    //         if (!$this->upload->do_upload('image')) {
    //             // Tangani error upload gambar
    //             $error = $this->upload->display_errors();
    //             echo "Error upload gambar: " . $error; // Pesan error dalam bahasa Indonesia
    //             return;
    //         } else {
    //             $image = $this->upload->data('file_name'); // Dapatkan nama file yang diupload
    //         }
    //     }

    //     // Siapkan data untuk dimasukkan
    //     $data = array(
    //         'event_name' => $event_name,
    //         'title' => $title,
    //         'start_date' => $start_date,
    //         'end_date' => $end_date,
    //         'location' => $location,
    //         'description' => $description,
    //         'color' => $color,
    //         'image' => $image,
    //     );

    //     // Masukkan ke database
    //     $this->db->insert('events', $data);

    //     $this->session->set_flashdata('success', 'Event berhasil ditambahkan.');
    //     // Redirect atau muat tampilan dengan pesan sukses
    //     redirect('event'); // Redirect ke halaman yang diinginkan
    // }

    public function insert()
    {
        // Ambil data dari form
        $event_name = $this->input->post('event_name');
        $title = $this->input->post('title');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $location = $this->input->post('location');
        $description = $this->input->post('description');
        $color = $this->input->post('color');

        // Validasi: end_date tidak boleh kurang dari start_date
        if (strtotime($end_date) < strtotime($start_date)) {
            $this->session->set_flashdata('error', 'The end date cannot be less than the start date.');
            redirect('event'); // Redirect kembali ke halaman tambah event
            return;
        }

        // Tangani upload gambar
        $image = $_FILES['image']['name'];

        // Upload gambar
        if ($image) {
            // Konfigurasi upload untuk gambar
            $config['upload_path'] = './uploads/event/'; // Path untuk gambar
            $config['allowed_types'] = 'jpg|jpeg|png'; // Tipe gambar yang diizinkan

            // Inisialisasi library upload dengan konfigurasi
            $this->upload->initialize($config);

            // Lakukan upload
            if (!$this->upload->do_upload('image')) {
                // Tangani error upload gambar
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', "Error upload gambar: " . $error);
                redirect('event/add');
                return;
            } else {
                $image = $this->upload->data('file_name'); // Dapatkan nama file yang diupload
            }
        }

        // Siapkan data untuk dimasukkan
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

        // Masukkan ke database
        $this->db->insert('events', $data);

        $this->session->set_flashdata('success', 'Event berhasil ditambahkan.');
        redirect('event'); // Redirect ke halaman yang diinginkan
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
