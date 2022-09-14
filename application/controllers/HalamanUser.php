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

	public function simpan_riwayat(){

        $id_periksa = uniqid('periksa');
        $data['title'] = 'Cek Diagnosa';
        $id_user = $this->session->userdata('id_user');
   
        $this->db->insert('riwayat', [
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

	public function cek_diagnosa($jawaban = null, $id= null, $index = 0, $kelompok = 1){
        $data['title'] = 'Cek Diagnosa';

        if(is_null($jawaban) && is_null($id)){
            
            $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
            
            $data['index'] = 0;
        } else {
            $cek = $this->db->get_where('rule_temp', ['pilihan' => $id])->num_rows();
            if($cek == 0){
                $this->db->insert('rule_temp', [
                    'id_periksa'    => $this->session->userdata('id_periksa'),
                    'pilihan'          => $id,
                    'jawaban'       => $jawaban,
                    'kelompok'  => $kelompok
                ]); 
            }
            $cek_kelompok = $this->db->get_where('rule_temp', ['kelompok' => $kelompok])->num_rows();
            $cek_kelompok_y = $this->db->get_where('rule_temp', ['jawaban' => 'y', 'kelompok' => $kelompok])->num_rows();
            $index = $index;
            if($kelompok == 1){
                $index = $index;
                if($cek_kelompok == 3){
                    if($cek_kelompok_y >= 2){
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 2)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }else{
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 3)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }
                    $index = 0;
                }else{
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    $index = $index;
                }
                
                $index = $index;
            }else if($kelompok == 2){
                $index = $index;
                if($cek_kelompok == 3){
                    if($cek_kelompok_y >= 2){
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 5)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }else{
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 4)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }
                    $index = 0;
                    
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            }elseif($kelompok == 3){
                $index = $index;
                if($cek_kelompok == 3){
                    if($cek_kelompok_y >= 2){
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 4)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }else{
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 2)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }
                    $index = 0;
                }else{
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    $index = $index;
                }
                
                $index = $index;
            }else if($kelompok == 4){
                $index = $index;
                if($cek_kelompok == 3){
                    $index = 0;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 5)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            }elseif($kelompok == 5){
                $index = $index;
                if($cek_kelompok == 3){
                    $index = 0;
                    if($cek_kelompok_y >= 2){
                        //die();
                        $index = 0;
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 6)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                        
                    }else{
                        $index = 0;
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 7)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                        
                    }
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            } else if($kelompok == 6){
                $index = $index;
                if($cek_kelompok == 3){
                    if($cek_kelompok_y >= 2){
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 8)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }else{
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 9)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }
                    $index = 0;
                    
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            
            }elseif($kelompok == 7){
                $index = $index;
                if($cek_kelompok == 3){
                    if($cek_kelompok_y >= 2){
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 8)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }else{
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 6)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }
                    $index = 0;
                }else{
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    $index = $index;
                }
                
                $index = $index;
            }else if($kelompok == 8){
                $index = $index;
                if($cek_kelompok == 3){
                    $index = 0;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 9)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            }elseif($kelompok == 9){
                $index = $index;
                if($cek_kelompok == 3){
                    $index = 0;
                    if($cek_kelompok_y >= 2){
                        //die();
                        $index = 0;
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 10)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                        
                    }else{
                        $index = 0;
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 11)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                        
                    }
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            }else if($kelompok == 10){
                $index = $index;
                if($cek_kelompok == 3){
                    if($cek_kelompok_y >= 2){
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 12)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }else{
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 13)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }
                    $index = 0;
                    
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            
            }elseif($kelompok == 11){
                $index = $index;
                if($cek_kelompok == 3){
                    if($cek_kelompok_y >= 2){
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 12)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }else{
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 10)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }
                    $index = 0;
                }else{
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    $index = $index;
                }
                
                $index = $index;
            }else if($kelompok == 12){
                $index = $index;
                if($cek_kelompok == 3){
                    $index = 0;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 13)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            }elseif($kelompok == 13){
                $index = $index;
                if($cek_kelompok == 3){
                    $index = 0;
                    if($cek_kelompok_y >= 2){
                        //die();
                        $index = 0;
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 14)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                        
                    }else{
                        $index = 0;
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 15)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                        
                    }
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            }else if($kelompok == 14){
                $index = $index;
                if($cek_kelompok == 3){
                    redirect('HalamanUser/hasil_diagnosa');
                    
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            
            }elseif($kelompok == 15){
                $index = $index;
                if($cek_kelompok == 3){
                    if($cek_kelompok_y >= 2){
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 16)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }else{
                        $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', 14)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    }
                    $index = 0;
                }else{
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                    $index = $index;
                }
                
                $index = $index;
            }else if($kelompok == 16){
                $index = $index;
                if($cek_kelompok == 3){
                    redirect('HalamanUser/hasil_diagnosa');
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            }
            
            $data['index'] = $index;
        }

        $this->load->view('depan/pertanyaan', $data);
    }

    public function hasil_diagnosa(){
        $data['title'] = 'Hasil Diagnosa';
        $data['pertanyaan'] = $this->db->get('rule_temp')->result_array(); 

        if(empty($data['pertanyaan'])){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" >Belum ada diagnosa! Silahkan input data baru.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('HalamanUser/diagnosa');
        }

        $id_periksa = $this->session->userdata('id_periksa');

        // begin
        // Pengelompokan jawaban user berdasarkan kelompok pertanyaan
        $k = array('x');
        for ($i=1; $i <= 16; $i++) { 
            // cek jawaban berdasarkan kelompok
            $cek_jawaban = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'jawaban' => 'y', 'kelompok' => $i])->num_rows();
            // jika jawaban yg 'ya' ada lebih dari samadengan 2, maka kelompok tersebut 'y'
            if($cek_jawaban >= 2){
                array_push($k, 'y');
            } else {
                array_push($k, 'n');
            }
        }
        
        $hasil = '';
        if($k[1] == 'y' && $k[2] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ESTJ';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ESTP';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ESFJ';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ESFP';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ENFJ';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ENFP';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ENTP';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ENTJ';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ISTP';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ISTJ';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ISFJ';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ISFP';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'INFJ';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'INFP';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'INTP';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'INTJ';
        }else{
            $hasil = 'Data Tidak Ditemukan';
        }
        // END

        // $rule = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'jawaban' => 'y'])->result_array();
        // $karakteristik = $this->db->select('*')->get('karakteristik')->result_array();
        // $indikator = $this->db->select('*')->get('indikator')->result_array();

        // $hasil = [];
        // $hasil_num = [];
        // $rule = 1;
        // foreach ($karakteristik as $k) {
        //     $relasi = $this->db->query("SELECT * FROM `relasi` WHERE kode_karakteristik='".$k['kode_karakteristik']."' ORDER BY `id_relasi` ASC")->result_array();
        //     $num = 0;
        //     $hitung = [];
        //     foreach ($relasi as $r) {
        //         $cek = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'pilihan' => $r['kode_indikator'],  'jawaban' => 'y'])->num_rows();
        //         if ($cek > 0) {
        //             $num++;
        //             $a = '<b>'.$r['kode_indikator'].'</b>';
        //         }else{
        //             $a = $r['kode_indikator'];
        //         }
                
        //         array_push($hitung, $a);
        //     }
        //     $data = [
        //         'rule' => 'R'.$rule++,
        //         'kode_karakteristik' => $k['kode_karakteristik'],
        //         'nama_karakteristik' => $k['nama'],
        //         'hitung' => $hitung,
        //         'presentase' => $num,
        //     ];
        //     array_push($hasil_num, $num);
        //     array_push($hasil, $data);
        // }

        $data['title'] = 'Hasil Diagnosa';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['pertanyaan'] = $this->db->get('rule_temp')->result_array(); 
        $data['hasil'] = $hasil;
        $cek_id = $this->db->get_where('hasil', ['id_periksa' => $id_periksa])->num_rows();
        $data['karakteristik'] = $this->db->get_where('karakteristik', ['deskripsi' => $hasil])->row_array(); 
        if($cek_id == 0){
            if(count($data['karakteristik']) != 0){
                $this->db->insert('hasil', [
                    'id_periksa'    => $id_periksa,
                    'kode_karakteristik' => $data['karakteristik']['kode_karakteristik'],
                ]); 
            }
        }
        
        $this->load->view('depan/hasil_diagnosa', $data);
    }

    public function cetak_diagnosa($id_periksa = null){
        if($id_periksa == null){
            $id_periksa = $this->session->userdata('id_periksa');
        }
        $data['riwayat'] = $this->db->get_where('riwayat', ['id_periksa' => $id_periksa])->row_array();
        $data['title'] = 'Hasil Diagnosa';
        $data['pertanyaan'] = $this->db->get('rule_temp')->result_array(); 

        if(empty($data['pertanyaan'])){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" >Belum ada diagnosa! Silahkan input data baru.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('HalamanUser/diagnosa');
        }

        $id_periksa = $this->session->userdata('id_periksa');

        // begin
        // Pengelompokan jawaban user berdasarkan kelompok pertanyaan
        $k = array('x');
        for ($i=1; $i <= 16; $i++) { 
            // cek jawaban berdasarkan kelompok
            $cek_jawaban = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'jawaban' => 'y', 'kelompok' => $i])->num_rows();
            // jika jawaban yg 'ya' ada lebih dari samadengan 2, maka kelompok tersebut 'y'
            if($cek_jawaban >= 2){
                array_push($k, 'y');
            } else {
                array_push($k, 'n');
            }
        }
        
        $hasil = '';
        if($k[1] == 'y' && $k[2] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ESTJ';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ESTP';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ESFJ';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ESFP';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ENFJ';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ENFP';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ENTP';
        }else if($k[1] == 'y' && $k[2] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ENTJ';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ISTP';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ISTJ';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'ISFJ';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[5] == 'y' && $k[6] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'ISFP';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'INFJ';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[11] == 'y' && $k[12] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'INFP';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[15] == 'y' && $k[16] == 'y'){
            $hasil = 'INTP';
        }else if($k[3] == 'y' && $k[4] == 'y' && $k[7] == 'y' && $k[8] == 'y' && $k[9] == 'y' && $k[10] == 'y' && $k[13] == 'y' && $k[14] == 'y'){
            $hasil = 'INTJ';
        }else{
            $hasil = 'Data Tidak Ditemukan';
        }
        // END

        // $rule = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'jawaban' => 'y'])->result_array();
        // $karakteristik = $this->db->select('*')->get('karakteristik')->result_array();
        // $indikator = $this->db->select('*')->get('indikator')->result_array();

        // $hasil = [];
        // $hasil_num = [];
        // $rule = 1;
        // foreach ($karakteristik as $k) {
        //     $relasi = $this->db->query("SELECT * FROM `relasi` WHERE kode_karakteristik='".$k['kode_karakteristik']."' ORDER BY `id_relasi` ASC")->result_array();
        //     $num = 0;
        //     $hitung = [];
        //     foreach ($relasi as $r) {
        //         $cek = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'pilihan' => $r['kode_indikator'],  'jawaban' => 'y'])->num_rows();
        //         if ($cek > 0) {
        //             $num++;
        //             $a = '<b>'.$r['kode_indikator'].'</b>';
        //         }else{
        //             $a = $r['kode_indikator'];
        //         }
                
        //         array_push($hitung, $a);
        //     }
        //     $data = [
        //         'rule' => 'R'.$rule++,
        //         'kode_karakteristik' => $k['kode_karakteristik'],
        //         'nama_karakteristik' => $k['nama'],
        //         'hitung' => $hitung,
        //         'presentase' => $num,
        //     ];
        //     array_push($hasil_num, $num);
        //     array_push($hasil, $data);
        // }
        //var_dump($hasil);
        $data['title'] = 'Hasil Diagnosa';
        $data['riwayat'] = $this->db->get_where('riwayat', ['id_periksa' => $id_periksa])->row_array();
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['pertanyaan'] = $this->db->get('rule_temp')->result_array(); 
        $data['hasil'] = $hasil;
        
        $data['karakteristik'] = $this->db->get_where('karakteristik', ['deskripsi' => $hasil])->row_array(); 
        

        $this->load->view('depan/cetak_diagnosa', $data);
        
    }

    public function riwayat_diagnosa()
	{
		$data['title'] = 'Riwayat Diagnosa';
        $id_user = $this->session->userdata('id_user');
        $data['riwayat']    = $this->db->select('*, riwayat.nama as namariwayat')
            ->from('hasil')
            ->join('riwayat', 'riwayat.id_periksa=hasil.id_periksa')
            ->join('karakteristik', 'karakteristik.kode_karakteristik=hasil.kode_karakteristik')
            ->where('riwayat.id_user', $id_user)
            ->get()->result();
		$this->load->view('depan/riwayat_diagnosa', $data);
	}
}
