<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fixed extends CI_Controller
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
		$data['title'] = 'Fixed';

		// Ambil data kategori dari tabel forum_category
		$data['categories'] = $this->db->get('reports_category')->result_array();

		// Query to get data from the 'reports' table where category is 'fixed' and type is 'pdf'
		$data['reports'] = $this->db->where('category', 'fixed')
			->where('type', 'pdf')
			->order_by('created_at', 'DESC')
			->limit(5)
			->get('reports')
			->result_array();

		// Query to get data from the 'reports' table where category is 'fixed' and type is 'articles'
		$data['articles'] = $this->db->where('category', 'fixed')
			->where('type', 'article')
			->order_by('created_at', 'DESC')
			->limit(10)
			->get('reports')
			->result_array();

		// Query to get data from the 'videos' table where category is 'fixed'
		$data['videos'] = $this->db->where('category', 'fixed')->get('videos')->result();

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

		// Load the views with the data
		$this->load->view('template/content/header', $data);
		$this->load->view('fixed/list', $data);
		$this->load->view('template/content/footer');
	}

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

	public function view_report($title)
	{
		$data['title'] = 'View Report';
		// Convert hyphens back to spaces
		$decoded_title = str_replace('-', ' ', urldecode($title));

		// Query to get data from the 'reports' table where the title matches
		$data['viewreports'] = $this->db->select('*')
			->from('reports')
			->where('title', $decoded_title)
			->get()
			->row_array();

		// Check if the data is available
		if (empty($data['viewreports'])) {
			show_404();  // Show 404 page if no data found
		}

		// Pass the title to the view
		$data['page_title'] = $data['viewreports']['title'];

		// Pass the image URL to the view for dynamic background
		$data['background_image'] = base_url('uploads/images/' . $data['viewreports']['image']);

		// Query to get other reports in the same category but not the current one
		$data['others'] = $this->db->select('*')
			->from('reports')
			->where('category', $data['viewreports']['category'])
			->where('title !=', $decoded_title)
			->where('type !=', 'article') // Exclude 'article' type
			->get()
			->result_array();

		// Initialize a variable to track relevant notifications
		$relevant_notifications = [];

		// Fetch user logs (only for the current user)
		$user_logs = $this->user_log();
		foreach ($user_logs as $log) {
			$relevant_notifications[] = [
				'type' => 'user_log',
				'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
				'timestamp' => $log->created_at,
				'is_read' => $log->is_read
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
					'is_read' => $log->is_read
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
						'is_read' => $log->is_read
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
		// Count only relevant notifications
		$unread_notifications = array_filter($relevant_notifications, function ($notification) {
			return isset($notification['is_read']) && $notification['is_read'] == 0;
		});

		$data['total_relevant_notifications'] = count($unread_notifications);

		// Load the views with the data
		$this->load->view('fixed/report', $data);
	}

	public function view_pdf($id)
	{
		$data['title'] = 'View PDF';
		// Query to get the report based on the ID
		$data['viewreports'] = $this->db->select('*')
			->from('reports')
			->where('id', $id)
			->get()
			->row_array();

		// Check if the data is available
		if (empty($data['viewreports'])) {
			show_404();  // Show 404 page if no data found
		}

		// Pass the file name to the view
		$data['file_name'] = $data['viewreports']['file'];

		// Load the view with the PDF viewer
		$this->load->view('fixed/view_pdf', $data);
	}

	public function view_pdf_article($id)
	{
		$data['title'] = 'View Article';
		// Query to get the report based on the ID
		$data['viewreports'] = $this->db->select('*')
			->from('reports')
			->where('id', $id)
			->get()
			->row_array();

		// Check if the data is available
		if (empty($data['viewreports'])) {
			show_404();  // Show 404 page if no data found
		}

		// Pass the file name to the view
		$data['file_name'] = $data['viewreports']['file'];

		// Load the view with the PDF viewer
		$this->load->view('fixed/view_pdf_article', $data);
	}

	public function view_article($title)
	{
		$data['title'] = 'View Article';
		// Convert hyphens back to spaces
		$decoded_title = str_replace('-', ' ', urldecode($title));

		// Query to get data from the 'reports' table where the title matches
		$data['viewreports'] = $this->db->select('*')
			->from('reports')
			->where('title', $decoded_title)
			->get()
			->row_array();

		// Check if the article exists
		if (!$data['viewreports']) {
			show_404(); // Show 404 error if the article is not found
			return;
		}

		// Get the report ID from the retrieved article data
		$report_id = $data['viewreports']['id'];
		$data['report_id'] = $report_id;

		// Query to get comments and their replies with parent names and user details
		$comments = $this->db->select('comments.*, 
                replies.id AS reply_id, 
                replies.reply_text, 
                replies.likes AS reply_likes, 
                replies.unlikes AS reply_unlikes, 
                replies.created_at AS reply_created_at, 
                replies.parent_id AS reply_parent_id,
                users.username,
                reply_users.username AS reply_username') // Get the parent reply's name
			->from('comments')
			->join('replies', 'replies.comment_id = comments.id', 'left')
			->join('replies as parent_replies', 'replies.parent_id = parent_replies.id', 'left')
			->join('users', 'users.id = comments.user_id', 'left') // Fetch username of the comment author
			->join('users as reply_users', 'reply_users.id = replies.user_id', 'left') // Fetch username of the reply author
			->where('comments.id_report', $report_id)
			->order_by('comments.created_at', 'ASC')
			->order_by('replies.created_at', 'ASC')
			->get()
			->result_array();

		// Organize comments and replies
		$data['comments'] = [];
		foreach ($comments as $comment) {
			if (!isset($data['comments'][$comment['id']])) {
				$data['comments'][$comment['id']] = $comment;
				$data['comments'][$comment['id']]['replies'] = [];
				$data['comments'][$comment['id']]['comment_name'] = $comment['username']; // Add the comment author's username
			}
			if ($comment['reply_id']) {
				$reply = [
					'id' => $comment['reply_id'],
					'reply_text' => $comment['reply_text'],
					'likes' => $comment['reply_likes'],
					'unlikes' => $comment['reply_unlikes'],
					'created_at' => $comment['reply_created_at'],
					'parent_id' => $comment['reply_parent_id'],
					// Set parent_name to the comment's username directly since the field is no longer available
					'parent_name' => $comment['username'], // Use comment's username directly
					'reply_username' => $comment['reply_username'], // Add the reply author's username
				];
				// Add replies to their respective parent comments
				$data['comments'][$comment['id']]['replies'][] = $reply;
			}
		}

		// Query to get the count of comments related to this report
		$data['comment_count'] = $this->db->where('id_report', $report_id)
			->from('comments')
			->count_all_results();

		// Pass the title to the view
		$data['page_title'] = $data['viewreports']['title'];

		// Initialize a variable to track relevant notifications
		$relevant_notifications = [];

		// Fetch user logs (only for the current user)
		$user_logs = $this->user_log();
		foreach ($user_logs as $log) {
			$relevant_notifications[] = [
				'type' => 'user_log',
				'message' => $log->username . ' telah berhasil mendaftarkan akun baru.',
				'timestamp' => $log->created_at,
				'is_read' => $log->is_read
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
					'is_read' => $log->is_read
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
						'is_read' => $log->is_read
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

		// Load the views with the data
		$this->load->view('fixed/articles', $data);
	}

	// Report.php Controller
	public function like()
	{
		$id = $this->input->post('id');
		// Increment like count in database
		$this->db->set('likes', 'likes + 1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('reports');

		// Return the updated like count
		$like_count = $this->db->select('likes')->where('id', $id)->get('reports')->row()->likes;
		echo json_encode(['likes' => $like_count]);
	}

	public function unlike()
	{
		$id = $this->input->post('id');
		// Increment unlike count in database
		$this->db->set('unlikes', 'unlikes + 1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('reports');

		// Return the updated unlike count
		$unlike_count = $this->db->select('unlikes')->where('id', $id)->get('reports')->row()->unlikes;
		echo json_encode(['unlikes' => $unlike_count]);
	}

	public function add_comment()
	{
		// Ambil data dari form
		$comment = $this->input->post('comment');
		$id_report = $this->input->post('id_report');
		$user_id = $this->input->post('user_id');

		// Masukkan data ke database
		$this->db->insert(
			'comments',
			[
				'name' => 'Unknown',
				'comment_text' => $comment,
				'id_report' => $id_report,
				'user_id' => $user_id,
			]
		);

		// Cek apakah insert berhasil
		if ($this->db->affected_rows() > 0) {
			// Ambil title dari tabel reports berdasarkan id_report
			$report = $this->db->get_where('reports', ['id' => $id_report])->row();

			if ($report) {
				$title = $report->title; // Ambil title dari report

				// Ubah title menjadi URL-friendly format
				$url_title = urlencode(str_replace(' ', '-', $title));
			} else {
				// Jika tidak ditemukan, gunakan id_report sebagai fallback
				$url_title = $id_report;
			}

			// Set success flashdata
			$this->session->set_flashdata('message', 'Comment added successfully!');

			// Redirect ke halaman view-article dengan title yang diformat
			redirect('view-article/' . $url_title);
		} else {
			// Set error flashdata
			$this->session->set_flashdata('error', 'Failed to add comment');

			// Redirect kembali dengan pesan error
			redirect('view-article/' . $id_report . '?error=Failed to add comment');
		}
	}

	public function filter_comments()
	{
		$order = $this->input->get('order', TRUE) ?: 'terbaru';
		$id_report = $this->input->get('id_report', TRUE);

		$this->db->where('id_report', $id_report);
		$this->db->order_by('created_at', $order === 'terbaru' ? 'DESC' : 'ASC');
		$query = $this->db->get('comments');
		$comments = $query->result_array();
		echo json_encode(['comments' => $comments]);
	}

	public function likeComment()
	{
		$id = $this->input->post('id');
		// Increment like count in database
		$this->db->set('likes', 'likes + 1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('comments');

		// Return the updated like count
		$like_count = $this->db->select('likes')->where('id', $id)->get('comments')->row()->likes;
		echo json_encode(['likes' => $like_count]);
	}

	public function unlikeComment()
	{
		$id = $this->input->post('id');
		// Increment unlike count in database
		$this->db->set('unlikes', 'unlikes + 1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('comments');

		// Return the updated unlike count
		$unlike_count = $this->db->select('unlikes')->where('id', $id)->get('comments')->row()->unlikes;
		echo json_encode(['unlikes' => $unlike_count]);
	}

	public function add_comment_user()
	{
		// Ambil data dari form
		$reply_text = $this->input->post('reply_text');
		$comment_id  = $this->input->post('comment_id');
		$id_report = $this->input->post('id_report'); // Pastikan id_report dikirim dari form
		$user_id = $this->input->post('user_id');

		// Masukkan data ke database
		$this->db->insert(
			'replies',
			[
				'reply_text' => $reply_text,
				'user_id' => $user_id,
				'comment_id' => $comment_id
			]
		);

		// Cek apakah insert berhasil
		if ($this->db->affected_rows() > 0) {
			// Ambil title dari tabel reports berdasarkan id_report
			$report = $this->db->get_where('reports', ['id' => $id_report])->row();

			if ($report) {
				$title = $report->title; // Ambil title dari report

				// Ubah title menjadi URL-friendly format
				$url_title = urlencode(str_replace(' ', '-', $title));
			} else {
				// Jika tidak ditemukan, gunakan id_report sebagai fallback
				$url_title = $id_report;
			}

			// Set success flashdata
			$this->session->set_flashdata('message', 'Comment added successfully!');

			// Redirect ke halaman view-article dengan title yang diformat
			redirect('view-article/' . $url_title);
		} else {
			// Set error flashdata
			$this->session->set_flashdata('error', 'Failed to add comment');

			// Redirect kembali dengan pesan error
			redirect('view-article/' . $id_report . '?error=Failed to add comment');
		}
	}

	public function add_reply_user()
	{
		$comment_id = $this->input->post('comment_id');
		$parent_id = $this->input->post('parent_id'); // Mengambil parent_id dari balasan yang sedang dibalas
		$id_report = $this->input->post('id_report');
		$user_id = $this->input->post('user_id');

		$data = [
			'comment_id' => $comment_id,
			'parent_id' => $parent_id,
			'reply_text' => $this->input->post('reply_text'),
			'user_id' => $user_id,
			'likes' => 0,
			'unlikes' => 0,
		];

		$this->db->insert('replies', $data);

		// Cek apakah insert berhasil
		if ($this->db->affected_rows() > 0) {
			// Ambil title dari tabel reports berdasarkan id_report
			$report = $this->db->get_where('reports', ['id' => $id_report])->row();

			if ($report) {
				$title = $report->title; // Ambil title dari report

				// Ubah title menjadi URL-friendly format
				$url_title = urlencode(str_replace(' ', '-', $title));
			} else {
				// Jika tidak ditemukan, gunakan id_report sebagai fallback
				$url_title = $id_report;
			}

			// Set success flashdata
			$this->session->set_flashdata('message', 'Comment added successfully!');

			// Redirect ke halaman view-article dengan title yang diformat
			redirect('view-article/' . $url_title);
		} else {
			// Set error flashdata
			$this->session->set_flashdata('error', 'Failed to add comment');

			// Redirect kembali dengan pesan error
			redirect('view-article/' . $id_report . '?error=Failed to add comment');
		}
	}

	public function likeReply()
	{
		$id = $this->input->post('id');
		// Increment like count in database
		$this->db->set('likes', 'likes + 1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('replies');

		// Return the updated like count
		$like_count = $this->db->select('likes')->where('id', $id)->get('replies')->row()->likes;
		echo json_encode(['likes' => $like_count]);
	}

	public function unlikeReply()
	{
		$id = $this->input->post('id');
		$this->db->set('unlikes', 'unlikes + 1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('replies');

		// Return the updated unlike count
		$unlike_count = $this->db->select('unlikes')->where('id', $id)->get('replies')->row()->unlikes;
		echo json_encode(['unlikes' => $unlike_count]);
	}

	public function search_reports()
	{
		$file_name = $this->input->post('file_name');
		$keyword = $this->input->post('keywords'); // Expecting a single keyword  
		$posted_date = $this->input->post('posted_date');
		$categories = $this->input->post('category'); // Ambil category_id dari input      
		$group = 'fixed'; // Kategori yang ingin dicari      
		$type = 'pdf'; // Tambahkan filter berdasarkan type      

		$this->db->where('category', $group); // Filter berdasarkan category      
		$this->db->where('type', $type); // Filter berdasarkan type      

		// Cek setiap filter secara terpisah  
		if (!empty($file_name)) {
			$this->db->like('title', $file_name);
		}

		if (!empty($keyword)) {
			// Gunakan WHERE untuk mencocokkan keyword  
			$this->db->where('keywords', $keyword); // Mencocokkan keyword  
		}

		if (!empty($categories)) {
			$this->db->where('report_category_id', $categories);
		}

		if (!empty($posted_date)) {
			$this->db->where('DATE(created_at)', $posted_date); // Mencocokkan tanggal 
		}

		// Hapus limit default jika ada pencarian  
		if (empty($file_name) && empty($keyword) && empty($categories) && empty($posted_date)) {
			$this->db->limit(5);
		}

		$this->db->order_by('created_at', 'DESC');

		$query = $this->db->get('reports'); // Mengambil laporan dari database      

		$reports = $query->result_array();

		// Format laporan menjadi chunk (untuk carousel)      
		$chunks = array_chunk($reports, 4);

		// Kembalikan hasil pencarian sebagai JSON      
		if ($reports) {
			echo json_encode([
				'status' => 'success',
				'reports' => $chunks
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'No reports found'
			]);
		}
	}
}
