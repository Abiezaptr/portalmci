<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
		// Fetch the latest videos from the 'videos' table
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit(6);
		$query = $this->db->get('videos');
		$data['videos'] = $query->result();

		// Fetch the latest reports from the 'reports' table, ordered by 'created_at'
		$this->db->order_by('created_at', 'DESC');
		$this->db->where('type !=', 'article');
		$query = $this->db->get('reports');
		$reports = $query->result_array(); // Fetch as an array

		// Pass reports to the view
		$data['reports'] = $reports;

		$data['articleReport'] = $this->db->select('*')
			->from('reports')
			->where('type', 'article')
			->order_by('created_at', 'DESC') // Tambahkan urutan berdasarkan tanggal terbaru
			->limit(1)
			->get()
			->row_array(); // Fetch the latest article report

		// Pass the image URL to the view for dynamic background
		$data['background_image'] = base_url('uploads/images/' . $data['articleReport']['image']);


		// Load the view with the video data
		$this->load->view('template/landing/header', $data);
		$this->load->view('home', $data);
		$this->load->view('template/landing/footer');
	}
}
