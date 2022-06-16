<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/'); ?>vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


  <title>SISTEM PAKAR</title>

  <style>
    .nav-item:hover {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 30px;
    }
  </style>

</head>

<body class="bg-light">

  Navbar
  <nav class="navbar navbar-expand-lg fixed-top navbar-light" style="background-color: ghostwhite">
    <div class="container-fluid">

      <a class="navbar-brand" href="<?php echo base_url() ?>">

        <b>SISTEM PAKAR</b>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if (current_url() == base_url('')) {
                                echo 'active';
                              } ?>">
            <a style="color: slateblue;" class="btn btn-transparant btn-round" href="<?php echo base_url(''); ?>"><b>Beranda</b></a>
          </li>
          <div class="container pr-6"></div>
          <li class="nav-item <?php if (current_url() == base_url('HalamanUser/karakteristik')) {
                                echo 'active';
                              } ?>">
            <a style="color: slateblue;" class="btn  btn-round" href="<?php echo base_url('HalamanUser/karakteristik'); ?>"><b>Jenis Karakteristik</b></a>
          </li>
          <div class="container pr-6"></div>
          <li class="nav-item <?php if (current_url() == base_url('HalamanUser/diagnosa')) {
                                echo 'active';
                              } ?>">
            <a style="color: slateblue;" class="btn  btn-round" href="<?php echo base_url('HalamanUser/diagnosa'); ?>"><b>Cek Karakteristik</b></a>
          </li>
          <div class="container pr-6"></div>
          <?php
          if($this->session->userdata('login_user') != true){?>
            
          <?php }else{ ?>
            <li class="nav-item <?php if (current_url() == base_url('HalamanUser/riwayat_diagnosa')) {
                                echo 'active';
                              } ?>">
            <a style="color: slateblue;" class="btn  btn-round" href="<?php echo base_url('HalamanUser/riwayat_diagnosa'); ?>"><b>Riwayat</b></a>
          </li>
          <?php }
          ?>
          


        </ul>
        <div class=" btn-light form-inline my-2 my-lg-0">
          <?php
          if($this->session->userdata('login_user') != true){?>
            <a style="color: slateblue;" class="btn brn-round " href="<?= base_url('HalamanUser/login') ?>"><i class="fa fa-sign-in"></i> <b>Login</b></a>
          <?php }else{ ?>
            <a style="color: slateblue;" class="btn brn-round "  data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-in"></i> <b>Logout</b></a>
          <?php }
          ?>
          
        </div>
      </div>
    </div>
  </nav>