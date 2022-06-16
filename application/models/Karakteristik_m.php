<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karakteristik_m extends CI_Model {

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
	public $tabel = 'karakteristik';
	public function get()
	{
		return $this->db->order_by('kode_karakteristik', 'ASC')->get($this->tabel);
	}
	
	public function get_unrelated()
	{
		return $this->db->query("SELECT p.kode_karakteristik, p.nama, r.kode_indikator FROM $this->tabel p LEFT JOIN relasi r ON p.kode_karakteristik = r.kode_karakteristik WHERE r.kode_karakteristik is null;");
	}

	public function get_where($where){
		$this->db->where($where);
		return $this->db->get_where($this->tabel);
	}

	public function insert($kode,$nama,$deskripsi,$solusi){
		$this->db->query("INSERT INTO $this->tabel(kode_karakteristik, nama,deskripsi,solusi) VALUES ('$kode','$nama','$deskripsi','$solusi')");
	}

	public function update($kode,$nama,$deskripsi,$solusi,$id){
		$this->db->query("UPDATE $this->tabel SET kode_karakteristik = '$kode', nama = '$nama', deskripsi = '$deskripsi', solusi = '$solusi' WHERE kode_karakteristik = '$id'");
	}

	public function get_where_relasi($id_relasi)
	{
		return $this->db->query("SELECT r.id_relasi, r.id_indikator, r.kode_karakteristik, p.nama, p.deskripsi, p.solusi FROM relasi r JOIN karakteristik p ON r.kode_karakteristik = p.kode_karakteristik WHERE id_relasi = '$id_relasi'");
	}

	public function delete($id){
		$this->db->query("DELETE FROM $this->tabel WHERE kode_karakteristik = '$id'");
	}
	
}
