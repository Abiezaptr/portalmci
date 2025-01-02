<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
		// Fetch the latest videos from the 'videos' table
		$this->db->order_by('RAND()');
		$this->db->limit(6);
		$query = $this->db->get('videos');
		$data['videos'] = $query->result();

		// Fetch the latest reports from the 'reports' table, ordered by 'created_at'
		$this->db->order_by('created_at', 'DESC');
		$this->db->where('type !=', 'article');
		$this->db->limit(8);
		$query = $this->db->get('reports');
		$reports = $query->result_array(); // Fetch as an array

		// Pass reports to the view
		$data['reports'] = $reports;

		$data['articleReport'] = $this->db->select('*')
			->from('reports')
			->where('title', 'Factors influencing the effects of the Starlink Satellite Project on the internet service provider market in Thailand')
			->limit(1)
			->get()
			->row_array(); // Fetch the latest article report

		// Pass the image URL to the view for dynamic background
		$data['background_image'] = base_url('uploads/images/' . $data['articleReport']['image']);

		$data['specificReport'] = $this->db->select('*')
			->from('reports')
			->like('title', 'Are mobile and fixed broadband')
			->limit(1)
			->get()
			->row_array(); // Fetch one row as an array

		// Ambil acara yang akan datang
		$this->db->where('start_date >=', date('Y-m-d'));  // Pastikan start_date lebih besar atau sama dengan hari ini
		$this->db->or_where('end_date >=', date('Y-m-d'));  // Atau end_date lebih besar atau sama dengan hari ini
		$this->db->order_by('start_date', 'ASC');  // Urutkan berdasarkan start_date secara ascending
		$data['upcoming_events'] = $this->db->get('events')->result();

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

		// Load the view with the video data
		$this->load->view('template/landing/header', $data);
		$this->load->view('home', $data);
		$this->load->view('template/landing/footer');
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
}
