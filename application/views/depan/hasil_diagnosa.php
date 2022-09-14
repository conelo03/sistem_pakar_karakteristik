<?php $this->load->view('depan/temp/header') ?>
<div class="container">
  <div class="jumbotron jumbotron-fluid" style="background: slateblue;">
    <div class="container">
      <h1 class="display-10">Sistem Pakar Tes MBTI Untuk Menentukan Pola Belajar</h1>
      <p class="lead">Perhatikan hasil tes anda dibawah!</p>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="h4 text-gray-900">Hasil Tes</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="p-2">
            <form action="#" method="post" class="user">

              <div class="form-group">
                  <div class="form-user">
                    Hasil : 
                  </div>
                  <div class="form-user">
                    <?= $hasil == 'Data Tidak Ditemukan' ? $hasil : 'Dengan demikian hasil nya adalah '.$hasil ?>
                  </div>
                        
                   
              </div>
              <?php
                if(count($karakteristik) != 0){ ?>
                  <div class="form-group">
                    <div class="form-user">
                      Karakter :
                    </div>
                    <div class="form-user">
                      <?= $karakteristik['nama'] ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-user">
                      Deskripsi :
                    </div>
                    <div class="form-user">
                      <?= $karakteristik['solusi'] ?>
                    </div>

                  </div>
              <?php  }
              ?>
              


            </form>
            <a href="<?php echo base_url() ?>"><button class="btn  btn-user btn-block" style="background: slateblue; color:white">Kembali</button></a><br />
            <a href="<?= base_url('HalamanUser/cetak_diagnosa/' . $this->session->userdata('id_periksa')) ?>" target="_blank"><button class="btn  btn-user btn-block" style="background: slateblue; color:white">Print</button></a>
            <!-- <button class="btn btn-primary btn-user btn-block" onClick="print()">Print</button> -->
            <hr>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<br />
<?php $this->load->view('depan/temp/footer') ?>