<!-- End of Main Content -->
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="row">
    <div class="col-lg">
      <?= $this->session->flashdata('message'); ?>


      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="" class="btn btn-primary" style="background: slateblue; color: white;" data-toggle="modal" data-target="#tambah"><span class="fa fa-plus"> </span> Tambah Karakteristik</a>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kode</th>
                  <th>Nama Karakter</th>
                  <th>Definisi</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($karakteristik != NULL) {
                  $no = 1;
                  foreach ($karakteristik as $g) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $g['kode_karakteristik'] ?></td>
                      <td><?= $g['nama'] ?></td>
                      <td><?= $g['deskripsi'] ?></td>
                      <td><?= substr($g['solusi'], 0, 20).'...' ?></td>
                      <td><a class="btn btn-primary" style="background: slateblue; color: white;" data-toggle="modal" data-target="#edit<?= $g['kode_karakteristik'] ?>">
                          Edit</a>
                        </a><a onclick="return confirm('Apakah kamu yakin akan menghapus data ini ?')" href="<?= base_url() ?>karakteristik/hapus_karakteristik/<?= $g['kode_karakteristik'] ?>" class="btn btn-danger ">
                          <span class="text">Hapus</span>
                        </a></td>
                    </tr>
                  <?php }
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
  </div>
</div>
<!-- /.container-fluid -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Karakteristik</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="form-horizontal" action="<?php echo base_url() . 'karakteristik/aksi_tambah_karakteristik' ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="kode" class="form-control form-control-user" id="exampleInputEmail" placeholder="Kode" required>
          </div>
          <div class="form-group">
            <input type="text" name="nama" class="form-control form-control-user" id="exampleInputEmail" placeholder="Nama" required>
          </div>
          <div class="form-group">
            <input type="text" name="deskripsi" class="form-control form-control-user" id="exampleInputEmail" placeholder="Definisi" required>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea type="text" name="solusi" class="form-control ckeditor" id="ckeditor" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="simpan">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if ($karakteristik != NULL) {
  foreach ($karakteristik as $g) : ?>
    <div class="modal fade" id="edit<?= $g['kode_karakteristik'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Karakteristik</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'karakteristik/aksi_edit_karakteristik/' . $g['kode_karakteristik'] ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                Kode :
                <input type="text" name="kode" class="form-control form-control-user" id="exampleInputEmail" value="<?= $g['kode_karakteristik'] ?>" required>
              </div>
              <div class="form-group">
                Nama :
                <input type="hidden" name="id" class="form-control" id="inputUserName" value="<?= $g['kode_karakteristik'] ?>" required>
                <input type="text" name="nama" class="form-control form-control-user" id="exampleInputEmail" value="<?= $g['nama'] ?>" required>
              </div>
              <div class="form-group">
                Definisi :
                <input type="text" name="deskripsi" class="form-control form-control-user" id="exampleInputEmail" value="<?= $g['deskripsi'] ?>" required>
              </div>
              <div class="form-group">
            <label>Deskripsi</label>
            <textarea type="text" name="solusi" class="form-control ckeditor" id="ckeditor" required><?= str_replace("<br />", '', $g['solusi']) ?></textarea>
          </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" id="simpan">Edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php endforeach;
} ?>

<!-- End of Main Content -->