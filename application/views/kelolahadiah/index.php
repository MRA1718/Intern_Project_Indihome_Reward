    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class=" text-gray-800" style="text-align:center">Data Reward</h1>
      <div class="d-flex">
        <div class=" mr-auto pl-2">
          <?= $this->session->flashdata('message') ?>
        </div>
        <div class=" ml-auto pr-2 pb-3">
          <button type="button pull-right" class="btn btn-success " data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah </button>
        </div>
      </div>


      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;" width="15%">Nama</th>
                  <th style="text-align: center;" width="8%">Poin</th>
                  <th style="text-align: center;">Gambar</th>
                  <th style="text-align: center;" width="30%">Deskripsi</th>
                  <th style="text-align: center;" width="12%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($list_reward as $row) : ?>
                  <tr class="odd gradeX">
                    <td class="text-center align-middle"><?php echo $no++; ?></td>
                    <td class="text-center align-middle"><?php echo $row['nama_reward']; ?></td>
                    <td class="text-center align-middle"><?php echo $row['point_reward']; ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo "<img src='upload/fotohadiah/" . $row['gambar_reward']  . "' height='140'> "; ?></td>
                    <td class="align-middle" style="white-space: pre-line"><?php echo $row['deskripsi_reward']; ?></td>
                    <td class="text-center align-middle">
                      <button class="btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#modal-edit<?= $row['id_reward'] ?>">
                        <span class="icon text-white-50 " style="width:40px">
                          <i class="fas fa-pen"></i>
                        </span>
                        <span class="text" style="width:100px">Sunting</span>
                      </button>
                      <button class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#modal-delete<?= $row['id_reward'] ?>">
                        <span class="icon text-white-50 " style="width:40px">
                          <i class="fas fa-trash"></i>
                        </span>
                        <span class="text" style="width:100px">Hapus</span>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->
    </div>
    </div>

    <!-- modal tambah -->
    <div id="modal-tambah" class="modal fade">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Tambah Data Reward</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <?php echo form_open_multipart('KelolaHadiah/add') ?>
            <div class="form-group">
              <label class='col'>Nama</label>
              <div class='col'><input type="text" name="nama_reward" autocomplete="off" required class="form-control"></div>
            </div>
            <div class="form-group">
              <label class='col'>Point</label>
              <div class='col'><input type="text" name="point_reward" autocomplete="off" required class="form-control"></div>
            </div>
            <div class="form-group">
              <label class='col'>Dekripsi</label>
              <div class='col'>
                <textarea name="deskripsi_reward" autocomplete="off" required class="form-control"></textarea></div>
            </div>

            <div class="form-group">
              <label class='col'>Gambar</label>
              <div class='col'>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="gambar_reward" name="gambar_reward">
                  <label class="custom-file-label" for="gambar_reward">Choose file</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-success"><i class="icon-checkmark-circle2"></i> Simpan</button>
            </div>
            <?php form_close() ?>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- modal edit -->
    <?php foreach ($list_reward as $row) : ?>

      <div class="modal fade" id="modal-edit<?= $row['id_reward'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel"> Edit Data Reward</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
            </div>
            <form action="<?php echo site_url('KelolaHadiah/edit/' . $row['id_reward']); ?>" method="POST" enctype="multipart/form-data">
              <input type='hidden' name='id_reward' id="id_reward" />
              <div class="modal-body">
                <div class="form-group">
                  <label class='col'>Nama</label>
                  <div class='col'><input type="text" name="nama_reward" autocomplete="off" required value="<?= $row['nama_reward'] ?>" class=" form-control"></div>
                </div>
                <div class="form-group">
                  <label class='col'>Point</label>
                  <div class='col'><input type="text" name="point_reward" autocomplete="off" required value="<?= $row['point_reward'] ?>" class="form-control"></div>
                </div>
                <div class="form-group">
                  <label class='col'>Dekripsi</label>
                  <div class='col'>
                    <textarea name="deskripsi_reward" autocomplete="off" required class="form-control"><?= $row['deskripsi_reward'] ?></textarea></div>

                </div>

                <div class="form-group">
                  <label class='col'>Gambar</label>
                  <div class='col'>
                    <div class="col">
                      <img src="<?= base_url('upload/fotohadiah/') . $row['gambar_reward'] ?>" class="img-thumbnail" width="150" height="150">
                    </div>

                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="gambar_reward" name="gambar_reward">
                      <label class="custom-file-label" for="gambar_reward">Pilih File</label>
                    </div>
                  </div>
                </div>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-success" value='Simpan' />
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- modal delete -->
    <?php foreach ($list_reward as $row) : ?>

      <div class="modal fade" id="modal-delete<?= $row['id_reward'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel"> Hapus Data Reward</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
            </div>
            <form action="<?php echo site_url('KelolaHadiah/hapus/' . $row['id_reward']); ?>" method="POST">
              <input type='hidden' name='id_reward' id="id_reward" />
              <div class="modal-body">
                Hapus data reward <?php echo "<strong>" . $row['nama_reward'] . "</strong>"; ?>?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-danger" value='Delete' />
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- End of Main Content -->