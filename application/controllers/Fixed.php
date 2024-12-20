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

		// Load the views with the data
		$this->load->view('template/content/header', $data);
		$this->load->view('fixed/list', $data);
		$this->load->view('template/content/footer');
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
		$search_query = $this->input->post('search_query');
		$category = 'fixed'; // Kategori yang ingin dicari
		$type = 'pdf'; // Tambahkan filter berdasarkan type

		// Jika ada pencarian, ambil semua data yang sesuai dengan kata kunci
		if (!empty($search_query)) {
			// Pencarian berdasarkan judul, kategori, dan tipe
			$this->db->like('title', $search_query);
			$this->db->where('category', $category); // Filter berdasarkan kategori
			$this->db->where('type', $type); // Filter berdasarkan type
			$query = $this->db->get('reports'); // Mengambil laporan dari database

			$reports = $query->result_array();
		} else {
			// Jika tidak ada pencarian, ambil hanya 5 data pertama, urutkan dengan 'created_at' (contoh)
			$this->db->limit(5); // Batasi hanya 5 data
			$this->db->where('category', $category); // Filter berdasarkan kategori
			$this->db->where('type', $type); // Filter berdasarkan type
			$this->db->order_by('created_at', 'DESC'); // Urutkan berdasarkan kolom 'created_at' (terbaru)
			$query = $this->db->get('reports');

			$reports = $query->result_array();
		}

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
