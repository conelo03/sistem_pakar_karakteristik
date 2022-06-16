<?php $this->load->view('depan/temp/header') ?>
<div class="container">
  <div class="jumbotron jumbotron-fluid" style="background: slateblue;">
    <div class="container">
      <h1 class="display-10">Hasil Diagnosa Tingkat Kecemasan Orang Tua Terhadap Proses PJJ Di Masa Pandemi COVID-19</h1>
      <p class="lead">Perhatikan hasil diagnosa dibawah!</p>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="h4 text-gray-900">Hasil Diagnosa</h3>
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
                    Dengan demikian hasil terbesar terdapat pada <?= $hasil[$index_terpilih]['rule'] ?> dengan nilai <?= $hasil[$index_terpilih]['presentase']/24*100 ?>%, maka hasil diagnosa menyatakan user mempunyai tipe kepribadian
                    <?= $hasil[$index_terpilih]['nama_karakteristik'] ?>
                  </div>
                        
                   
              </div>

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