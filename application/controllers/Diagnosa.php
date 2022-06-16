<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnosa extends CI_Controller {
	function __construct()
	{
	    parent::__construct();
	    if ($this->session->userdata('login') != true)
	    {
	      $url=base_url().'login';
	      redirect($url);
	    }
	    $this->load->library('session');
	    $this->load->model('indikator_m');
        $this->load->model('karakteristik_m');
	    $this->load->model('admin_m');
        $this->load->model('relasi_m');
	}
	public function index()
	{
        $this->db->query("DELETE from rule_temp");

        $this->session->unset_userdata('id_periksa');  
        $this->session->unset_userdata('nama_pasien'); 
        $this->session->unset_userdata('no_telp'); 
        $this->session->unset_userdata('alamat'); 
        $this->session->unset_userdata('umur'); 
        $this->session->unset_userdata('jenis_kelamin'); 
        $this->session->unset_userdata('kode_karakteristik'); 
        //die();
		$data['title'] = 'Uji Coba Diagnosa';
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/sidebar', $data);
	    $this->load->view('templates/topbar', $data);
	    $this->load->view('diagnosa/index', $data);
	    $this->load->view('templates/footer');
	}

	public function simpan_pasien(){

        $id_periksa = uniqid('periksa');
        $data['title'] = 'Uji Coba Diagnosa';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        
        $sesi_uji_coba = array(
            'id_periksa'    => $id_periksa,
            'nama_pasien'          => $this->input->post('nama'),
            'no_telp'       => $this->input->post('no_telp'),
            'alamat'        => $this->input->post('alamat'),
            'umur'          => $this->input->post('umur'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        );

        $this->session->set_userdata($sesi_uji_coba);  
		redirect('Diagnosa/cek');
	}

    public function cek($jawaban = null, $id= null, $index = 0, $kelompok = 1){
        $data['title'] = 'Uji Coba Diagnosa';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

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
                    redirect('Diagnosa/hasil');
                    
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
                    redirect('Diagnosa/hasil');
                }else{
                    $index = $index;
                    $data['indikator'] = $this->db->select('*, CAST(kode_indikator as SIGNED) AS casted_column')->where('kelompok', $kelompok)->order_by('length(kode_indikator)')->order_by('kode_indikator')->get('indikator')->result_array();
                }
            }
            
            $data['index'] = $index;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diagnosa/pertanyaan', $data);
        $this->load->view('templates/footer');
    }

    public function hasil(){
        $data['title'] = 'Hasil Diagnosa';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['pertanyaan'] = $this->db->get('rule_temp')->result_array(); 
        
        if(empty($data['pertanyaan'])){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" >Belum ada diagnosa! Silahkan input data baru.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Diagnosa');
        }

        $id_periksa = $this->session->userdata('id_periksa');
        $rule = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'jawaban' => 'y'])->result_array();
        $karakteristik = $this->db->select('*')->get('karakteristik')->result_array();
        $indikator = $this->db->select('*')->get('indikator')->result_array();

        $hasil = [];
        $hasil_num = [];
        $rule = 1;
        foreach ($karakteristik as $k) {
            $relasi = $this->db->query("SELECT * FROM `relasi` WHERE kode_karakteristik='".$k['kode_karakteristik']."' ORDER BY `id_relasi` ASC")->result_array();
            $num = 0;
            $hitung = [];
            foreach ($relasi as $r) {
                $cek = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'pilihan' => $r['kode_indikator'],  'jawaban' => 'y'])->num_rows();
                if ($cek > 0) {
                    $num++;
                    $a = '<b>'.$r['kode_indikator'].'</b>';
                }else{
                    $a = $r['kode_indikator'];
                }
                
                array_push($hitung, $a);
            }
            $data = [
                'rule' => 'R'.$rule++,
                'kode_karakteristik' => $k['kode_karakteristik'],
                'nama_karakteristik' => $k['nama'],
                'hitung' => $hitung,
                'presentase' => $num,
            ];
            array_push($hasil_num, $num);
            array_push($hasil, $data);
        }
        //var_dump($hasil);
        $data['title'] = 'Hasil Diagnosa';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['pertanyaan'] = $this->db->get('rule_temp')->result_array(); 
        $data['hasil'] = $hasil;
        $data['hasil_terpilih'] = max($hasil_num);
        $data['index_terpilih'] = array_search(max($hasil_num), $hasil_num);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diagnosa/hasil', $data);
        $this->load->view('templates/footer');
    }

    public function cetak($id_periksa = null){
        if($id_periksa == null){
            $id_periksa = $this->session->userdata('id_periksa');
        }

        $data['title'] = 'Hasil Diagnosa';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['pertanyaan'] = $this->db->get('rule_temp')->result_array(); 
        
        if(empty($data['pertanyaan'])){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" >Belum ada diagnosa! Silahkan input data baru.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Diagnosa');
        }

        $id_periksa = $this->session->userdata('id_periksa');
        $rule = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'jawaban' => 'y'])->result_array();
        $karakteristik = $this->db->select('*')->get('karakteristik')->result_array();
        $indikator = $this->db->select('*')->get('indikator')->result_array();
        //var_dump($karakteristik);
        echo '<br>';
        echo '<br>';
        $hasil = [];
        $hasil_num = [];
        $rule = 1;
        foreach ($karakteristik as $k) {
            $relasi = $this->db->query("SELECT * FROM `relasi` WHERE kode_karakteristik='".$k['kode_karakteristik']."' ORDER BY `id_relasi` ASC")->result_array();
            $num = 0;
            $hitung = [];
            foreach ($relasi as $r) {
                $cek = $this->db->get_where('rule_temp',[ 'id_periksa' => $id_periksa, 'pilihan' => $r['kode_indikator'],  'jawaban' => 'y'])->num_rows();
                if ($cek > 0) {
                    $num++;
                    $a = '<b>'.$r['kode_indikator'].'</b>';
                }else{
                    $a = $r['kode_indikator'];
                }
                
                array_push($hitung, $a);
            }
            $data = [
                'rule' => 'R'.$rule++,
                'kode_karakteristik' => $k['kode_karakteristik'],
                'nama_karakteristik' => $k['nama'],
                'hitung' => $hitung,
                'presentase' => $num,
            ];
            array_push($hasil_num, $num);
            array_push($hasil, $data);
        }
        //var_dump($hasil);
        $data['title'] = 'Hasil Diagnosa';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['pertanyaan'] = $this->db->get('rule_temp')->result_array(); 
        $data['hasil'] = $hasil;
        $data['hasil_terpilih'] = max($hasil_num);
        $data['index_terpilih'] = array_search(max($hasil_num), $hasil_num);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diagnosa/cetak', $data);
        
    }
	
}
