<?php $this->load->view('depan/temp/header') ?>
<div class="container">
  <div class="jumbotron jumbotron-fluid" style="background: slateblue;">
    <div class="container">
      <h3 class="display-10">Riwayat Tes MBTI</h3>
      <p class="lead"></p>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h1 class="h4 text-gray-900">Riwayat</h1>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Tanggal Cek</th>
              <th>Nama</th>
              <th>Umur</th>
              <th>No. Telp</th>
              <th>Karakter</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // print_r($riwayat);die(); 
            if ($riwayat != NULL) {
              $no = 1;
              for ($i = 0; $i < count($riwayat); $i++) {
                if ($i == 0) {
                  $n = 1;
                } else {
                  if ($riwayat[$i]->id_periksa == $riwayat[$i - 1]->id_periksa) {
                    // $i++;
                    $n = 0;
                  } else if ($riwayat[$i]->id_periksa !== $riwayat[$i - 1]->id_periksa) {
                    $n = 1;
                  }
                }
                if ($n == 1) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $riwayat[$i]->created_date ?></td>
                    <td><?= $riwayat[$i]->namariwayat ?></td>
                    <td><?= $riwayat[$i]->umur ?></td>
                    <td><?= $riwayat[$i]->no_telp ?></td>
                    <td><?= $riwayat[$i]->nama ?></td>
                  </tr>
              <?php }
              }
              // foreach($riwayat as $g) { 
              //   $m = $this->db->get_where('hasil', [
              //     'id_periksa'  => $g->id_periksa
              //   ])->row();  
              // }
            } else { ?>
              <tr>
                <td>Tidak ada data</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<br />

<?php $this->load->view('depan/temp/footer') ?>