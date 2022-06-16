<?php $this->load->view('depan/temp/header') ?>
<div class="container">
  <div class="jumbotron jumbotron-fluid" style="background: slateblue;">
    <div class="container">
      <h1 class="display-10">Jenis Karakteristik</h1>
    </div>
  </div>
  <?php foreach ($karakteristik as $key) { ?>
    <div class="card">
      <div class="card-header" style="background-color: slateblue;">
        <b><?= $key['nama'] ?></b>
      </div>
      <div class="card-body">
        <b>Definisi :</b> <br />
        <?= $key['deskripsi'] ?>
      </div>
      <div class="card-body">
        <b>Deskripsi :</b> <br />
        <?= $key['solusi'] ?>
      </div>
    </div>
    <br/>
  <?php } ?>

</div>
<br />
<?php $this->load->view('depan/temp/footer') ?>