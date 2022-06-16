<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HalamanUser extends CI_Controller {

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

    function __construct()
    {
        parent::__construct();
        $this->load->model('karakteristik_m');
    }


	public function index()
	{
		$data['title'] = 'Beranda';
		$this->load->view('depan/beranda', $data);
	}

    public function login()
    {
        $data['title'] = 'Login';
        $this->load->view('depan/login', $data);
    }

    public function proses_login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = $this->db->get_where('user', array('username' => $username, 'password' => $password));
        /*var_dump($email);
        var_dump($password);
        var_dump($user->result_array());
        die; */
        if ($user->num_rows() > 0) {
            $this->session->set_userdata('login_user', true);
            $user = $user->result_array();
            $sesi = array(
                'nama' => $user[0]['nama'],
                'username' => $user[0]['username'],
                'id_user' => $user[0]['id_user'],
            );
            $this->session->set_userdata($sesi);
            redirect('HalamanUser/diagnosa');
        } else {
            redirect('HalamanUser/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('login_user');
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('logout_success', '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Sukses!</strong> Anda berhasil logout.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>');
        redirect(base_url('HalamanUser/login'));
    }

    public function register()
    {
        $this->validation_register();
        if (!$this->form_validation->run()) {
            $data['title'] = 'Register';
            $this->load->view('depan/register', $data);
        } else {
            $data       = $this->input->post(null, true);
            $data_user  = [
                'nama'          => $data['nama'],
                'jenis_kelamin'         => $data['jenis_kelamin'],
                'alamat'            => $data['alamat'],
                'no_hp'            => $data['no_hp'],
                'email'         => $data['email'],
                'username'      => $data['username'],
                'password'      => $data['password'],
            ];
            if ($this->db->insert('user', $data_user)) {
                $this->session->set_flashdata('akun', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Sukses!</strong> Akun berhasil dibuat.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>');
                redirect('HalamanUser/login');
            } else {
                $this->session->set_flashdata('akun', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Gagal!</strong> Akun gagal dibuat.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>');
                redirect('HalamanUser/register');
            }
        }
        
    }

    private function validation_register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|alpha_numeric|is_unique[user.username]', ['is_unique'    => 'Username Sudah Terdaftar']);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'matches[password]|required');
    }

	public function karakteristik()
	{
		$data['title'] = 'Karakteristik';
        $karakteristik = $this->karakteristik_m->get();
        if ($karakteristik->num_rows() > 0) {
            $karakteristik = $karakteristik->result_array();
            $data['karakteristik'] = $karakteristik;
        } else {
            $data['karakteristik'] = NULL;
        }
		$this->load->view('depan/karakteristik', $data);
	}

	public function diagnosa()
	{
        if($this->session->userdata('login_user') != true){
            $this->session->set_flashdata('login_required', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Gagal!</strong> Anda harus login terlebih dahulu untuk masuk ke halaman diagnosa.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
            redirect('HalamanUser/login');
        }
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->db->get_where('user', ['id_user' => $id_user])->row_array();
		$this->db->query("DELETE from rule_temp");
        $this->session->unset_userdata('id_periksa');
		$data['title'] = 'Dianosa';
		$this->load->view('depan/diagnosa', $data);
	}

	public function simpan_pasien(){

        $id_periksa = uniqid('periksa');
        $data['title'] = 'Cek Diagnosa';
        $id_user = $this->session->userdata('id_user');
   
        $this->db->insert('pasien', [
            'id_periksa'    => $id_periksa,
            'id_user'       => $id_user,
            'nama'          => $this->input->post('nama'),
            'no_telp'       => $this->input->post('no_telp'),
            'alamat'        => $this->input->post('alamat'),
            'umur'          => $this->input->post('umur'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        ]); 

        $this->session->set_userdata('id_periksa', $id_periksa);  
		redirect('HalamanUser/cek_diagnosa');
	}

	public function cek_diagnosa($jawaban = null, $id= null, $index = 0){
        $data['title'] = 'Cek Diagnosa';

        if(is_null($jawaban) && is_null($id)){
            $data['indikator'] = $this->db->get('indikator')->result_array();
            $data['index'] = 0;
        } else {
            $cek = $this->db->get_where('rule_temp', ['pilihan' => $id])->num_rows();
            if($cek == 0){
                $this->db->insert('rule_temp', [
                    'id_periksa'    => $this->session->userdata('id_periksa'),
                    'pilihan'          => $id,
                    'jawaban'       => $jawaban
                ]); 
            }
            $data['index'] = $index;
            $data['indikator'] = $this->db->get('indikator')->result_array();
            if(empty($data['indikator'][$index])){
                redirect('HalamanUser/hasil_diagnosa');
            } 
        }

        $this->load->view('depan/pertanyaan', $data);
    }

    public function hasil_diagnosa(){
        $data['title'] = 'Hasil Diagnosa';
        $data['pertanyaan'] = $this->db->get('rule_temp')->result_array(); 

        if(empty($data['pertanyaan'])){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" >Belum ada diagnosa! Silahkan input data baru.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Diagnosa');
        }

        $id_periksa = $this->session->userdata('id_periksa');
        $rule = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'jawaban' => 'y'])->result_array();

        $gej = array();
        foreach ($rule as $key) {
            $gej[] = $key['pilihan'];
        }

        $indikator = $gej;

        $no  = 0;
        $i = 1;
        $n = [];
        // print_r($indikator);echo "</br>";
        for ($l=0; $l < count($indikator); $l++) { 
            $m = $this->db->get_where('indikator', [
                'kode_indikator' => $indikator[$l]
            ])->row();
            $n[$l] = $m->nama;
        }
        for ($k = 0; $k < count($indikator); $k++) {
            $this->db->select('relasi.kode_karakteristik, nama'); 
            $this->db->from('relasi');
            $this->db->join('karakteristik', 'relasi.kode_karakteristik = karakteristik.kode_karakteristik');
            $this->db->where('kode_indikator', $indikator[0]);
            for ($a = 1; $a < count($indikator); $a++) {
                $this->db->or_where('kode_indikator', $indikator[$a]);    
            }
            $b = $this->db->get()->result();
            $v = [];
            $no = 0;
            for ($c=0; $c < count($b); $c++) {
                if ($c == 0) {
                  $x = 1;
                } else {
                  if ($b[$c]->kode_karakteristik == $b[$c - 1]->kode_karakteristik) {
                    $x = 0;
                  } else {
                    $x = 1;
                  }
                }
                if ($x == 1) {
                  $v[$no] = $b[$c];
                  $no++;
                }
            }
            // print_r($v);echo "</br>";
            if (count($v) == 1) {
                $kode_karakteristik = $b[0]->kode_karakteristik;
                //var_dump($kode_karakteristik);
                
                $get_tot_indikator = $this->db->get_where('relasi', ['kode_karakteristik' => $kode_karakteristik])->num_rows();
                //$peluang = count($indikator)/$get_tot_indikator * 100;
                $peluang = count($indikator);
                $data['karakteristik'] = $v;
                $data['peluang'] = $peluang;
            } else {
               if ($k == count($indikator) - 1) {
                    $peluang= array();
                    for ($z = 0; $z < count($v); $z++) {
                        $this->db->select('kode_indikator');
                        $this->db->from('relasi');
                        $this->db->where('kode_karakteristik', $v[$z]->kode_karakteristik);
                        $d = $this->db->get()->result_array();
                        $data1 = array();
                        for ($s = 0; $s < count($d); $s++) {
                            $data1[] = $d[$s]['kode_indikator'];
                        }
                        $data3 = [];
                        $q     = 0;
                        for ($l = 0; $l < count($indikator); $l++) {
                            $data2  = in_array($indikator[$l], $data1);
                            if ($data2) {
                                $data3[$q] = $indikator[$l];
                                $q++;
                            }
                        }
                        //$peluang[$z] = count($data3) / count($data1) * 100;
                        $peluang[$z] = count($data3);
                
                    }
                    $data['karakteristik']   = $v;
                    $data['peluang']    = $peluang;
                    $data['tertinggi']  = max($peluang);
                } else {
                    $i++;    
                } 
            }
        }

        $karakteristik_terpilih = array();
        $peluang_terpilih = array();
        for ($i=0; $i < count($data['karakteristik']); $i++) {
            if (is_array($data['peluang'])) {
                 $peluang = $data['peluang'][$i];
                 
            } else {
             $peluang = $data['peluang'];
            }
            $peluang_terpilih[] = $peluang;
            $karakteristik_terpilih[] = $data['karakteristik'][$i]->kode_karakteristik; 
        }     

        $max_peluang = max($peluang_terpilih);
        $index = array_search($max_peluang, $peluang_terpilih);
        $id_periksa = $this->session->userdata('id_periksa');
        $kode_karakteristik = $karakteristik_terpilih[$index];
        $cek_id = $this->db->get_where('hasil', ['id_periksa' => $id_periksa])->num_rows();
        if($cek_id == 0){
            $this->db->insert('hasil', [
                'id_periksa'    => $id_periksa,
                'kode_karakteristik' => $kode_karakteristik,
            ]); 
        }
        $data['karakteristik'] = $this->db->get_where('karakteristik', ['kode_karakteristik' => $kode_karakteristik])->row_array(); 

        $this->load->view('depan/hasil_diagnosa', $data);
    }

    public function cetak_diagnosa($id_periksa = null){
        if($id_periksa == null){
            $id_periksa = $this->session->userdata('id_periksa');
        }
        $data['pasien'] = $this->db->get_where('pasien', ['id_periksa' => $id_periksa])->row_array();
        $data['title'] = 'Hasil Diagnosa';
        $data['pertanyaan'] = $this->db->get('rule_temp')->result_array(); 

        if(empty($data['pertanyaan'])){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" >Belum ada diagnosa! Silahkan input data baru.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Diagnosa');
        }

        $id_periksa = $this->session->userdata('id_periksa');
        $rule = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'jawaban' => 'y'])->result_array();

        $gej = array();
        foreach ($rule as $key) {
            $gej[] = $key['pilihan'];
        }

        $indikator = $gej;

        $no  = 0;
        $i = 1;
        $n = [];
        // print_r($indikator);echo "</br>";
        for ($l=0; $l < count($indikator); $l++) { 
            $m = $this->db->get_where('indikator', [
                'kode_indikator' => $indikator[$l]
            ])->row();
            $n[$l] = $m->nama;
        }
        for ($k = 0; $k < count($indikator); $k++) {
            $this->db->select('relasi.kode_karakteristik, nama'); 
            $this->db->from('relasi');
            $this->db->join('karakteristik', 'relasi.kode_karakteristik = karakteristik.kode_karakteristik');
            $this->db->where('kode_indikator', $indikator[0]);
            for ($a = 1; $a < count($indikator); $a++) {
                $this->db->or_where('kode_indikator', $indikator[$a]);    
            }
            $b = $this->db->get()->result();
            $v = [];
            $no = 0;
            for ($c=0; $c < count($b); $c++) {
                if ($c == 0) {
                  $x = 1;
                } else {
                  if ($b[$c]->kode_karakteristik == $b[$c - 1]->kode_karakteristik) {
                    $x = 0;
                  } else {
                    $x = 1;
                  }
                }
                if ($x == 1) {
                  $v[$no] = $b[$c];
                  $no++;
                }
            }
            // print_r($v);echo "</br>";
            if (count($v) == 1) {
                $kode_karakteristik = $b[0]->kode_karakteristik;
                var_dump($kode_karakteristik);
                
                $get_tot_indikator = $this->db->get_where('relasi', ['kode_karakteristik' => $kode_karakteristik])->num_rows();
                //$peluang = count($indikator)/$get_tot_indikator * 100;
                $peluang = count($indikator);
                $data['karakteristik'] = $v;
                $data['peluang'] = $peluang;
            } else {
               if ($k == count($indikator) - 1) {
                    $peluang= array();
                    for ($z = 0; $z < count($v); $z++) {
                        $this->db->select('kode_indikator');
                        $this->db->from('relasi');
                        $this->db->where('kode_karakteristik', $v[$z]->kode_karakteristik);
                        $d = $this->db->get()->result_array();
                        $data1 = array();
                        for ($s = 0; $s < count($d); $s++) {
                            $data1[] = $d[$s]['kode_indikator'];
                        }
                        $data3 = [];
                        $q     = 0;
                        for ($l = 0; $l < count($indikator); $l++) {
                            $data2  = in_array($indikator[$l], $data1);
                            if ($data2) {
                                $data3[$q] = $indikator[$l];
                                $q++;
                            }
                        }
                        //$peluang[$z] = count($data3) / count($data1) * 100;
                        $peluang[$z] = count($data3);
                
                    }
                    $data['karakteristik']   = $v;
                    $data['peluang']    = $peluang;
                    $data['tertinggi']  = max($peluang);
                } else {
                    $i++;    
                } 
            }
        }

        $karakteristik_terpilih = array();
        $peluang_terpilih = array();
        for ($i=0; $i < count($data['karakteristik']); $i++) {
            if (is_array($data['peluang'])) {
                 $peluang = $data['peluang'][$i];
                 
             } else {
                 $peluang = $data['peluang'];
                 
             }
             $peluang_terpilih[] = $peluang;
            $karakteristik_terpilih[] = $data['karakteristik'][$i]->kode_karakteristik; 
        }     

        $max_peluang = max($peluang_terpilih);
        $index = array_search($max_peluang, $peluang_terpilih);
        $id_periksa = $this->session->userdata('id_periksa');
        $kode_karakteristik = $karakteristik_terpilih[$index];
        $cek_id = $this->db->get_where('hasil', ['id_periksa' => $id_periksa])->num_rows();
        if($cek_id == 0){
            $this->db->insert('hasil', [
                'id_periksa'    => $id_periksa,
                'kode_karakteristik' => $kode_karakteristik,
            ]); 
        }
        $data['karakteristik'] = $this->db->get_where('karakteristik', ['kode_karakteristik' => $kode_karakteristik])->row_array(); 

        $this->load->view('depan/cetak_diagnosa', $data);
        
    }

    public function riwayat_diagnosa()
	{
		$data['title'] = 'Riwayat Diagnosa';
        $id_user = $this->session->userdata('id_user');
        $data['riwayat']    = $this->db->select('*, pasien.nama as namapasien')
            ->from('hasil')
            ->join('pasien', 'pasien.id_periksa=hasil.id_periksa')
            ->join('karakteristik', 'karakteristik.kode_karakteristik=hasil.kode_karakteristik')
            ->where('pasien.id_user', $id_user)
            ->get()->result();
		$this->load->view('depan/riwayat_diagnosa', $data);
	}
}
