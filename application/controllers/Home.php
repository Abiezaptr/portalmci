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

		// Fetch article report
		$data['articleReport'] = $this->db->select('*')
			->from('reports')
			->where('title', 'Factors influencing the effects of the Starlink Satellite Project on the internet service provider market in Thailand')
			->limit(1)
			->get()
			->row_array(); // Fetch the latest article report

		// Pass the image URL to the view for dynamic background
		$data['background_image'] = base_url('uploads/images/' . $data['articleReport']['image']);

		// Fetch specific report
		$data['specificReport'] = $this->db->select('*')
			->from('reports')
			->like('title', 'Are mobile and fixed broadband')
			->limit(1)
			->get()
			->row_array(); // Fetch one row as an array

		// Fetch upcoming events
		$this->db->where('start_date >=', date('Y-m-d'));  // Ensure start_date is today or later
		$this->db->or_where('end_date >=', date('Y-m-d'));  // Or end_date is today or later
		$this->db->order_by('start_date', 'ASC');  // Sort by start_date ascending
		$data['upcoming_events'] = $this->db->get('events')->result();

		// Initialize a variable to track relevant notifications
		$relevant_notifications = [];

		// Fetch user logs (only for the current user)
		$user_logs = $this->user_log();
		foreach ($user_logs as $log) {
			$relevant_notifications[] = [
				'type' => 'user_log',
				'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
				'timestamp' => $log->created_at,
				'is_read' => $log->is_read,
			];
		}

		// Fetch upload logs
		$upload_logs = $this->get_upload_logs();
		foreach ($upload_logs as $log) {
			// Check if the report is related to the current user
			if ($log->user_id == $this->session->userdata('id')) {
				$relevant_notifications[] = [
					'type' => 'upload_log',
					'message' => $log->username . ' ' . $log->message . '.',
					'timestamp' => $log->upload_time,
					'is_read' => $log->is_read,
				];
			}
		}

		// Fetch user read logs
		$user_read_logs = $this->get_user_read_logs();
		foreach ($user_read_logs as $log_id) {
			$this->db->select('*');
			$this->db->from('user_read_logs');
			$this->db->where('log_id', $log_id);
			$log_detail = $this->db->get()->row();

			if ($log_detail) {
				$relevant_notifications[] = [
					'type' => 'user_read_log',
					'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
					'timestamp' => $log_detail->read_time
				];
			}
		}

		// Fetch invitation thread logs
		$invitation_thread_logs = $this->get_invitation_thread_logs();
		foreach ($invitation_thread_logs as $log) {
			$user_ids = explode(',', $log->user_id);
			foreach ($user_ids as $user_id) {
				if ($user_id == $this->session->userdata('id')) { // Check if the user is the current user
					$relevant_notifications[] = [
						'type' => 'invitation_thread_log',
						'message' => $log->message,
						'timestamp' => $log->invitation_time,
						'is_read' => $log->is_read,
					];
				}
			}
		}

		// Sort notifications by timestamp
		usort($relevant_notifications, function ($a, $b) {
			return strtotime($b['timestamp']) - strtotime($a['timestamp']);
		});

		// Limit the number of notifications displayed
		$data['notifications'] = array_slice($relevant_notifications, 0, 5);

		// Count only relevant notifications
		$unread_notifications = array_filter($relevant_notifications, function ($notification) {
			return isset($notification['is_read']) && $notification['is_read'] == 0;
		});

		$data['total_relevant_notifications'] = count($unread_notifications);

		// Load the view with the video data
		$this->load->view('template/landing/header', $data);
		$this->load->view('home', $data);
		$this->load->view('template/landing/footer');
	}

	// Update the user_log function to filter by the current user
	public function user_log()
	{
		$user_id = $this->session->userdata('id'); // Get the current user's ID
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.id', $user_id); // Filter by the current user's ID
		$this->db->where('users.status', 'NONAKTIF'); // Adding condition for inactive status
		$this->db->order_by('users.created_at', 'DESC'); // Sort by user creation time
		$this->db->limit(5); // Get a maximum of 5 entries
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

	public function search()
	{
		// Get the query from the POST request      
		$query = $this->input->post('query');

		// Query to search in the reports table      
		$this->db->group_start(); // Mulai grup kondisi  
		$this->db->like('title', $query);
		$this->db->or_like('keywords', $query);
		$this->db->group_end(); // Akhiri grup kondisi  

		$this->db->where('type', 'pdf'); // Tambahkan kondisi untuk hanya mengambil type 'pdf'    
		$result = $this->db->get('reports');

		// Return results as JSON      
		echo json_encode($result->result_array()); // Use result_array() for easier JSON encoding      
	}

	public function search_report()
	{

		$data['title'] = 'Search Result';

		// Initialize a variable to track relevant notifications
		$relevant_notifications = [];

		// Fetch user logs (only for the current user)
		$user_logs = $this->user_log();
		foreach ($user_logs as $log) {
			$relevant_notifications[] = [
				'type' => 'user_log',
				'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
				'timestamp' => $log->created_at
			];
		}

		// Fetch upload logs
		$upload_logs = $this->get_upload_logs();
		foreach ($upload_logs as $log) {
			// Check if the report is related to the current user
			if ($log->user_id == $this->session->userdata('id')) {
				$relevant_notifications[] = [
					'type' => 'upload_log',
					'message' => $log->username . ' ' . $log->message . '.',
					'timestamp' => $log->upload_time
				];
			}
		}

		// Fetch user read logs
		$user_read_logs = $this->get_user_read_logs();
		foreach ($user_read_logs as $log_id) {
			$this->db->select('*');
			$this->db->from('user_read_logs');
			$this->db->where('log_id', $log_id);
			$log_detail = $this->db->get()->row();

			if ($log_detail) {
				$relevant_notifications[] = [
					'type' => 'user_read_log',
					'message' => 'User telah membaca log dengan ID ' . $log_id . '.',
					'timestamp' => $log_detail->read_time
				];
			}
		}

		// Fetch invitation thread logs
		$invitation_thread_logs = $this->get_invitation_thread_logs();
		foreach ($invitation_thread_logs as $log) {
			$user_ids = explode(',', $log->user_id);
			foreach ($user_ids as $user_id) {
				if ($user_id == $this->session->userdata('id')) { // Check if the user is the current user
					$relevant_notifications[] = [
						'type' => 'invitation_thread_log',
						'message' => $log->message,
						'timestamp' => $log->invitation_time
					];
				}
			}
		}

		// Sort notifications by timestamp
		usort($relevant_notifications, function ($a, $b) {
			return strtotime($b['timestamp']) - strtotime($a['timestamp']);
		});

		// Limit the number of notifications displayed
		$data['notifications'] = array_slice($relevant_notifications, 0, 5);

		// Count only relevant notifications
		$data['total_relevant_notifications'] = count($relevant_notifications);

		// Ambil query dari request POST
		$query = $this->input->post('query');

		// Cek jika query kosong
		if (empty($query)) {
			$this->session->set_flashdata('error', 'Please enter a search query.');
			redirect('home'); // Redirect ke halaman utama jika kosong
		}

		// Query untuk mencari laporan berdasarkan title atau keywords
		$this->db->group_start();
		$this->db->like('title', $query);
		$this->db->or_like('keywords', $query);
		$this->db->group_end();
		$this->db->where('type', 'pdf');

		$result = $this->db->get('reports')->result_array();

		// Kirim hasil pencarian ke view
		$data['search_results'] = $result;

		$this->load->view('template/content/header', $data);
		$this->load->view('search_results', $data); // View khusus untuk hasil pencarian
		$this->load->view('template/content/footer');
	}
}
