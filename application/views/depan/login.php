<?php $this->load->view('depan/temp/header') ?>

<body>


  <section id="selamatdatang" class="selamatdatang">
    <br>
    <div class="container mt-4">
      <div class="row">
        <div class="col">
          <img src="<?php echo base_url("assets/img/karakteristik.jpg") ?>" width="100%" style="border-radius: 10%;" alt="">
        </div>
        <div class="col">
          <div class="container" style="background-color: slateblue;border-radius: 10%;">
            <br/>
            <h3 class="text-center">Silahkan Login untuk Melanjutkan.</h3>
            <br>
            <?= $this->session->flashdata('login_required') ? $this->session->flashdata('login_required') : '' ?>
            <?= $this->session->flashdata('logout_success') ? $this->session->flashdata('logout_success') : '' ?>
            <?= $this->session->flashdata('akun') ? $this->session->flashdata('akun') : '' ?>
            <form action="<?= base_url('HalamanUser/proses_login') ?>" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Username" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
              </div>
              <button type="submit" class="btn btn-light">Login</button>
            </form>
            <br/>
            <p class="text-center text-white">Belum punya Akun? <a href="<?php echo base_url("HalamanUser/register") ?>">Buat disini</a></p>
            <br/>
          </div>
        </div>
      </div>
    </div>
      
  </section>
  <br />
  <?php $this->load->view('depan/temp/footer') ?>