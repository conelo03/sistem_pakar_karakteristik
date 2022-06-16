<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rule extends CI_Controller {

	function __construct()
	{
	    parent::__construct();
	    if ($this->session->userdata('login') != true)
	    {
	      $url=base_url().'login';
	      redirect($url);
	    }
	    $this->load->library('session');
	    $this->load->model('karakteristik_m');
	    $this->load->model('admin_m');
	}

	public function index()
	{
		$data['title'] = 'Rule';
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

		$karakteristik = $this->karakteristik_m->get();
		if ($karakteristik->num_rows() > 0) {
			$karakteristik = $karakteristik->result_array();
			$data['karakteristik'] = $karakteristik;
		} else {
			$data['karakteristik'] = NULL;
		}

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/sidebar', $data);
	    $this->load->view('templates/topbar', $data);
	    $this->load->view('rule/index', $data);
	    $this->load->view('templates/footer');
	}
}
