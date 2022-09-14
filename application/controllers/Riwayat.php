<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{

	public function index()
	{
		$data['riwayat']	= $this->db->select('*, riwayat.nama as namariwayat')
			->from('hasil')
			->join('riwayat', 'riwayat.id_periksa=hasil.id_periksa')
			->join('karakteristik', 'karakteristik.kode_karakteristik=hasil.kode_karakteristik')
			->get()->result();

		$data['title'] 		= 'Riwayat Diagnosa';
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('riwayat', $data);
		$this->load->view('templates/footer');
	}
}
