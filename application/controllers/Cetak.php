<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {
	
	public function print($id_periksa)
	{
		// $data['penyakit']	= $this->db->get_where('hasil', [
		// 		'id_periksa'	=> $id_periksa
		// 	])->result();
		
		$data['karakteristik']	= $this->db->query("SELECT *, hasil.nama as nama_pasien FROM hasil join karakteristik on hasil.karakteristik=karakteristik.nama where hasil.id_periksa='$id_periksa' order by hasil.peluang DESC")->result();
		$data['title'] 		= 'Hasil Diagnosa';
		$this->load->view('templates/header', $data);
	    $this->load->view('hasil.php', $data);
	    $this->load->view('templates/footer');	
	}
}
