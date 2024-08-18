<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fixed extends CI_Controller
{

	public function index()
	{
		// Query to get data from the 'reports' table where category is 'fixed'
		$data['reports'] = $this->db->where('category', 'fixed')->get('reports')->result_array();

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

		// Pass the title to the view
		$data['page_title'] = $data['viewreports']['title'];

		// Load the views with the data
		$this->load->view('fixed/articles', $data);
	}
}
