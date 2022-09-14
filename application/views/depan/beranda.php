<?php $this->load->view('depan/temp/header') ?>

<body>


  <section id="selamatdatang" class="selamatdatang">
    <div class="row">
      <div class="col">
        <div class="container text-center pt-3">
          <div class="jumbotron jumbotron-fluid" style="background-color: slateblue;">
            <img src="assets/img/karakteristik.jpg" alt="" width="70%" style="border-radius: 50%;">
            <h3 class="pt-3">Selamat Datang di Website Sistem Pakar Tes MBTI Untuk Menentukan Pola Belajar</h3>
            <hr class="my-4">
            <a class="btn btn-outline-dark" href="<?php echo base_url("HalamanUser/diagnosa") ?>" role="button">MULAI DIAGNOSA!</a>
          </div>
        </div>
      </div>
    </div>

  </section>

  <section id="tc" class="tc">
    <div class="container">
      <div class="row pb-5">
        <div class="col">
          <img src="assets/img/karakteristik.jpg" width="100%" style="border-radius: 50%;" alt="">
        </div>
        <div class="col text-center">
          <br><br><br><br><br>
          <h3>Apa itu MBTI dan apa saja jenis karakteristiknya?</h3>
          <hr class="my-4">
          <a class="btn btn-outline-dark" href="<?php echo base_url("HalamanUser/karakteristik") ?>" role="button">CEK DISINI</a>
        </div>
      </div>
    </div>

  </section>
  <br />
  <?php $this->load->view('depan/temp/footer') ?>