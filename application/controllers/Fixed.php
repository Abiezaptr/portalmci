<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fixed extends CI_Controller
{

	public function index()
	{
		// Query to get data from the 'reports' table where category is 'fixed' and type is 'pdf'
		$data['reports'] = $this->db->where('category', 'fixed')
			->where('type', 'pdf')
			->get('reports')
			->result_array();

		// Query to get data from the 'reports' table where category is 'fixed' and type is 'articles'
		$data['articles'] = $this->db->where('category', 'fixed')
			->where('type', 'article')
			->get('reports')
			->result_array();

		// Query to get data from the 'videos' table where category is 'fixed'
		$data['videos'] = $this->db->where('category', 'fixed')->get('videos')->result();

		// Load the views with the data
		$this->load->view('template/content/header');
		$this->load->view('fixed/list', $data);
		$this->load->view('template/content/footer');
	}

	public function view_report($title)
	{
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



	public function view_article($title)
	{
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

		// Query to get comments related to this report
		$data['comments'] = $this->db->select('*')
			->from('comments')
			->where('id_report', $report_id)
			->order_by('created_at', 'ASC') // Sort comments by creation time
			->get()
			->result_array();

		// Query to get the count of comments related to this report
		$data['comment_count'] = $this->db->where('id_report', $data['viewreports']['id'])
			->from('comments')
			->count_all_results();

		// Pass the title to the view
		$data['page_title'] = $data['viewreports']['title'];

		// Load the views with the data
		$this->load->view('fixed/articles', $data);
	}

	public function comment($id)
	{
		// Join comments with reports table
		$this->db->select('comments.*, reports.id as report_id, reports.title as report_title, reports.created_at as date_report, reports.image as image_report, reports.desc'); // Select fields from both tables
		$this->db->from('comments');
		$this->db->join('reports', 'comments.id_report = reports.id'); // Assuming 'id' is the primary key in reports
		$this->db->where('comments.id_report', $id);
		$this->db->order_by('comments.created_at', 'DESC');
		$query = $this->db->get();

		$data['comments'] = $query->result_array(); // Get comments as an array

		// Set the page title to the report title if comments exist
		if (!empty($data['comments'])) {
			$data['page_title'] = $data['comments'][0]['report_title']; // Set page title to the report title
			$data['image_report'] = $data['comments'][0]['image_report']; // Get the report image
			$data['desc'] = $data['comments'][0]['desc']; // Get the report image
			$data['date_report'] = $data['comments'][0]['date_report']; // Get the report image
			$data['report_id'] = $data['comments'][0]['report_id']; // Get the report image
		} else {
			// Fetch report details even if there are no comments
			$this->db->select('id as report_id, title as report_title, created_at as date_report, image as image_report, desc');
			$this->db->from('reports');
			$this->db->where('id', $id);
			$report_query = $this->db->get();
			$report = $report_query->row_array();

			if ($report) {
				$data['page_title'] = $report['report_title']; // Set page title to the report title
				$data['image_report'] = $report['image_report']; // Get the report image
				$data['desc'] = $report['desc']; // Get the report description
				$data['date_report'] = $report['date_report']; // Get the report date
				$data['report_id'] = $report['report_id']; // Get the report ID
			} else {
				$data['page_title'] = 'Fixed Articles'; // Fallback title if no comments
				$data['image_report'] = 'Image not found'; // No image if no comments
				$data['desc'] = 'Description not found'; // No description if no comments
				$data['date_report'] = 'Date not found'; // No date if no comments
				$data['report_id'] = $id; // Use the provided ID
			}
		}

		// Load the view and pass the comments data
		$this->load->view('fixed/comments', $data);
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
		// ambil data dari form
		$comment = $this->input->post('comment');
		$id_report = $this->input->post('id_report');

		// masukan data ke database
		$this->db->insert(
			'comments',
			[
				'name' => 'Unknown',
				'comment_text' => $comment,
				'id_report' => $id_report
			]
		);

		// Check if the insert was successful
		if ($this->db->affected_rows() > 0) {
			// Set success flashdata
			$this->session->set_flashdata('message', 'Comment added successfully!');
			// Redirect to comments page of the report
			redirect('comments/' . $id_report);
		} else {
			// Set error flashdata
			$this->session->set_flashdata('error', 'Failed to add comment');
			// Redirect back with an error message
			redirect('comments/' . $id_report . '?error=Failed to add comment');
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
}
