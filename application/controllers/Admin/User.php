<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
        $data['title'] = 'Manage User';

        // Query dengan filter role
        $roles = [1, 2, 3, 4, 5, 6];
        $this->db->where_in('role', $roles);
        $data['users'] = $this->db->get('users')->result_array();

        // Query untuk semua username dan email tanpa filter role
        $data['all_users'] = $this->db->select('username, email')->get('users')->result_array();

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

        // Load tampilan
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/user/view', $data);
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
        $data['title'] = 'Insert User';

        // Query untuk username dan email dengan filter status 'NONAKTIF'
        $data['all_users'] = $this->db->select('username, email')
            ->where('status', 'AKTIF')
            ->get('users')
            ->result_array();

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

        // Load tampilan
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/user/add', $data);
        $this->load->view('template/cms/footer');
    }


    public function get_email_by_username()
    {
        $username = $this->input->post('username');
        $user = $this->db->get_where('users', ['username' => $username])->row_array();

        if ($user) {
            echo json_encode(['email' => $user['email']]);
        } else {
            echo json_encode(['email' => '']);
        }
    }

    public function insert()
    {
        // Ambil data dari form
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $role = $this->input->post('role');

        // Cek apakah user dengan username tersebut sudah ada
        $existing_user = $this->db->get_where('users', ['username' => $username])->row_array();

        if ($existing_user) {
            // Jika user sudah ada, update role-nya
            $this->db->where('username', $username);
            $this->db->update('users', ['role' => $role]);

            $this->session->set_flashdata('success', 'User role updated successfully.');
        } else {
            // Jika user tidak ada, insert data baru
            $data = [
                'username' => $username,
                'email' => $email,
                'role' => $role,
                'password' => md5('123'), // Password default dengan md5 hash
                'created_at' => date('Y-m-d H:i:s'), // Optional: add created timestamp
            ];

            $this->db->insert('users', $data);

            $this->session->set_flashdata('success', 'User added successfully.');
        }

        // Redirect ke halaman manage-user
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

    // public function export_excel()
    // {
    //     // Membuat objek spreadsheet
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     // Header kolom
    //     $sheet->setCellValue('A1', 'No');
    //     $sheet->setCellValue('B1', 'Name');
    //     $sheet->setCellValue('C1', 'Email');
    //     $sheet->setCellValue('D1', 'Microsoft ID');
    //     $sheet->setCellValue('E1', 'Job Title');
    //     $sheet->setCellValue('F1', 'Role');
    //     $sheet->setCellValue('G1', 'Status');

    //     // Ambil data dari tabel users
    //     $users = $this->db->get('users')->result();

    //     $row = 2; // Mulai dari baris kedua (baris pertama untuk header)
    //     foreach ($users as $user) {
    //         // Cek role dan ubah menjadi teks
    //         if ($user->role == 1) {
    //             $role_text = 'Superadmin';
    //         } elseif ($user->role == 2) {
    //             $role_text = 'Guest';
    //         } elseif ($user->role == 3) {
    //             $role_text = 'Admin Mobile';
    //         } elseif ($user->role == 4) {
    //             $role_text = 'Admin Fixed';
    //         } elseif ($user->role == 5) {
    //             $role_text = 'Admin Digital';
    //         } elseif ($user->role == 6) {
    //             $role_text = 'Admin Global';
    //         } else {
    //             $role_text = 'Unknown'; // Jika role tidak sesuai
    //         }

    //         // Isi data ke dalam spreadsheet
    //         $sheet->setCellValue('A' . $row, $row - 1); // Nomor urut
    //         $sheet->setCellValue('B' . $row, $user->username);
    //         $sheet->setCellValue('C' . $row, $user->email);
    //         $sheet->setCellValue('D' . $row, $user->microsoft_id);
    //         $sheet->setCellValue('E' . $row, $user->job_title);
    //         $sheet->setCellValue('F' . $row, $role_text); // Tampilkan role sebagai teks
    //         $sheet->setCellValue('G' . $row, $user->status);
    //         $row++;
    //     }

    //     // Set header untuk download file Excel
    //     $filename = 'data_users.xlsx';
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment; filename="' . $filename . '"');
    //     header('Cache-Control: no-cache, no-store, must-revalidate');
    //     header('Pragma: no-cache');
    //     header('Expires: 0');

    //     // Bersihkan output buffer
    //     ob_clean();
    //     flush();

    //     // Membuat objek writer untuk menyimpan file Excel
    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save('php://output');

    //     exit;
    // }

    public function export_excel()
    {
        // Membuat objek spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Microsoft ID');
        $sheet->setCellValue('E1', 'Job Title');
        $sheet->setCellValue('F1', 'Role');
        $sheet->setCellValue('G1', 'Status');

        // Style header
        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD'], // Blue color for header background
            ],
        ];

        // Apply the style to the header row
        $sheet->getStyle('A1:G1')->applyFromArray($styleArray);

        // Ambil data dari tabel users
        $users = $this->db->get('users')->result();

        $row = 2; // Mulai dari baris kedua (baris pertama untuk header)
        foreach ($users as $user) {
            // Cek role dan ubah menjadi teks
            if ($user->role == 1) {
                $role_text = 'Superadmin';
            } elseif ($user->role == 2) {
                $role_text = 'Guest';
            } elseif ($user->role == 3) {
                $role_text = 'Admin Mobile';
            } elseif ($user->role == 4) {
                $role_text = 'Admin Fixed';
            } elseif ($user->role == 5) {
                $role_text = 'Admin Digital';
            } elseif ($user->role == 6) {
                $role_text = 'Admin Global';
            } else {
                $role_text = 'Unknown'; // Jika role tidak sesuai
            }

            // Isi data ke dalam spreadsheet
            $sheet->setCellValue('A' . $row, $row - 1); // Nomor urut
            $sheet->setCellValue('B' . $row, $user->username);
            $sheet->setCellValue('C' . $row, $user->email);
            $sheet->setCellValue('D' . $row, $user->microsoft_id);
            $sheet->setCellValue('E' . $row, $user->job_title);
            $sheet->setCellValue('F' . $row, $role_text); // Tampilkan role sebagai teks
            $sheet->setCellValue('G' . $row, $user->status);
            $row++;
        }

        // Auto wrap text and adjust column width
        foreach (range('A', 'G') as $columnID) {
            // Set column width
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
            // Apply text wrapping
            $sheet->getStyle($columnID)->getAlignment()->setWrapText(true);
        }

        // Set header untuk download file Excel
        $filename = 'data_users.xlsx';

        // Set Content-Type untuk Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Bersihkan output buffer agar file dapat terunduh
        ob_clean();
        flush();

        // Membuat objek writer untuk menyimpan file Excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        exit;
    }
}
