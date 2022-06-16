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
            <h3 class="text-center">Silahkan Daftar untuk Login.</h3>
            <br>
            <form action="<?= base_url('HalamanUser/register') ?>" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jenis Kelamin</label>
                <br>
                <!-- Default inline 1-->
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="defaultInline1" name="jenis_kelamin" value="Laki - Laki">
                  <label class="custom-control-label" for="defaultInline1">Laki - Laki</label>
                </div>

                <!-- Default inline 2-->
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="defaultInline2" name="jenis_kelamin" value="Perempuan">
                  <label class="custom-control-label" for="defaultInline2">Perempuan</label>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">No HP</label>
                <input type="text" name="no_hp" class="form-control" id="exampleInputEmail1" placeholder="No HP">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <input type="text" name="alamat" class="form-control" id="exampleInputEmail1" placeholder="Alamat">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Username">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Konfirmasi Password</label>
                <input type="password" name="konfirmasi_password" class="form-control" id="exampleInputPassword1" placeholder="Konfirmasi Password">
              </div>
              <button type="submit" class="btn btn-light">Buat Akun</button>
            </form>
            <br/>
            <p class="text-center text-white">Sudah punya Akun? <a href="<?php echo base_url("HalamanUser/login") ?>">Login disini</a></p>
            <br/>
          </div>
        </div>
      </div>
    </div>
      
  </section>
  <br />
  <?php $this->load->view('depan/temp/footer') ?>