<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relasi_m extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public $tabel = 'relasi';

	public function get_where($kode_indikator)
	{
		return $this->db->query("SELECT r.id_relasi, r.kode_indikator, r.kode_karakteristik, p.nama, p.deskripsi, p.solusi FROM relasi r JOIN karakteristik p ON r.kode_karakteristik = p.kode_karakteristik WHERE kode_indikator = '$kode_indikator'");
	}

	public function get_memasuki_indikator($kode_indikator)
	{
		return $this->db->query("SELECT r.id_relasi, r.kode_indikator, r.kode_karakteristik, p.nama, p.deskripsi, p.solusi FROM relasi r JOIN karakteristik p ON r.kode_karakteristik = p.kode_karakteristik WHERE kode_indikator like '%$kode_indikator%'");
	}

	public function insert($kode_karakteristik,$kode_indikator){
		$this->db->query("INSERT INTO $this->tabel(kode_karakteristik,kode_indikator) VALUES ('$kode_karakteristik','$kode_indikator')");
	}

	public function get()
	{
		return $this->db->query("SELECT r.id_relasi, r.kode_indikator, r.kode_karakteristik, g.nama as nama_indikator, p.nama as nama_karakteristik, p.deskripsi, p.solusi FROM relasi r JOIN karakteristik p join indikator g ON r.kode_karakteristik = p.kode_karakteristik and r.kode_indikator = g.kode_indikator");
	}

	public function delete($id){
		// $this->db->query("DELETE FROM $this->tabel WHERE id_relasi = '$id'");
		$this->db->where('kode_karakteristik', $id);
		$this->db->delete('relasi');
	}

	public function update($kode_karakteristik, $kode_indikator){
		$this->db->query("UPDATE $this->tabel SET kode_indikator = '$kode_indikator' WHERE kode_karakteristik = '$kode_karakteristik'");
		// $this->db->insert('relasi',)
	}
}
