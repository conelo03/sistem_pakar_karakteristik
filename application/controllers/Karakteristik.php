<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karakteristik extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login') != true) {
			$url = base_url() . 'login';
			redirect($url);
		}
		$this->load->library('session');
		$this->load->model('karakteristik_m');
		$this->load->model('indikator_m');
		$this->load->model('admin_m');
	}

	public function index()
	{

		$data['title'] = 'Data Karakteristik';
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
		$this->load->view('karakteristik/index', $data);
		$this->load->view('templates/footer');
	}

	public function hapus_karakteristik($id)
	{
		$this->karakteristik_m->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');
		redirect(base_url('karakteristik'));
	}

	public function aksi_edit_karakteristik($id)
	{
		$kode = $_POST['kode'];
		$nama = $_POST['nama'];
		$deskripsi = $_POST['deskripsi'];
		$solusi = str_replace("<br />", '', nl2br($_POST['solusi']));
		$this->karakteristik_m->update($kode, $nama, $deskripsi, $solusi, $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diedit!</div>');
		redirect(base_url('karakteristik'));
	}

	public function aksi_tambah_karakteristik()
	{
		$kode = $_POST['kode'];
		$nama = $_POST['nama'];
		$deskripsi = $_POST['deskripsi'];
		$solusi = str_replace("<br />", '', nl2br($_POST['solusi']));
		$this->karakteristik_m->insert($kode, $nama, $deskripsi, $solusi);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan!</div>');
		redirect(base_url('karakteristik'));
	}
}
