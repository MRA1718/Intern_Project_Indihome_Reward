    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="text-gray-800" style="text-align:center">Data Akun</h1>
      <div class="d-flex">
        <div class=" mr-auto pl-2">
          <?= $this->session->flashdata('message') ?>
        </div>
        <div class=" ml-auto pr-2 pb-3">
          <button type="button pull-right" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah </button>
        </div>
      </div>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="text-align: center;" width="10%">NIK</th>
                  <th style="text-align: center;" width="10%">Kode Sales</th>
                  <th style="text-align: center;" width="8%">Foto</th>
                  <th style="text-align: center;">Nama</th>
                  <th style="text-align: center;">Email</th>
                  <th style="text-align: center;" width="10%">Role</th>
                  <th style="text-align: center;" width="10%">Status Akun</th>
                  <th style="text-align: center;" width="10%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($user2 as $row) : ?>
                  <tr class="odd gradeX">
                    <td class="align-middle text-center"><?php echo $row['nik']; ?></td>
                    <td class="align-middle text-center"><?php echo $row['kode_sales']; ?></td>
                    <td class="align-middle text-center"><?php echo "<img src='upload/fotoprofil/" . $row['foto_user']  . "' height='70'> "; ?></td>
                    <td class="align-middle"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                    <td class="align-middle"><?php echo $row['email_user']; ?></td>
                    <td class="align-middle text-center"><?php echo $row['role']; ?></td>
                    <td class="align-middle text-center">
                      <?php if ($row['user_is_active'] == 'inactive') { ?>
                        <div class="h6 font-weight-bold text-danger mb-1"><?php echo $row['user_is_active']; ?></div>
                      <?php } else { ?>
                        <div class="h6 font-weight-bold text-success mb-1"><?php echo $row['user_is_active']; ?></div>
                      <?php }; ?>
                    </td>

                    <td class="align-middle text-center">
                      <button class=" btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#modal-edit<?= $row['nik'] ?>">
                        <span class="icon text-white-50 " style="width:40px">
                          <i class="fas fa-pen"></i>
                        </span>
                        <span class="text" style="width:100px">Sunting</span>
                      </button>
                      <button class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#modal-delete<?= $row['nik'] ?>">
                        <span class="icon text-white-50 " style="width:40px">
                          <i class="fas fa-trash"></i>
                        </span>
                        <span class="text" style="width:100px">Hapus</span>
                      </button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    </div>

    <!-- modal tambah -->
    <div id="modal-tambah" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Dafarkan Akun Baru</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <?php echo form_open_multipart('KelolaAkun/add') ?>
            <div class="form-group">
              <label class='col'>NIK</label>
              <div class='col'><input type="text" name="nik" autocomplete="off" required class="form-control"></div>
            </div>
            <div class="form-group">
              <label class='col'>Kode Sales</label>
              <div class='col'><input type="text" name="kode_sales" autocomplete="off" required class="form-control" value="NONE"></div>
            </div>
            <div class="form-group">
              <label class='col'>Nama Depan</label>
              <div class='col'><input type="text" name="first_name" autocomplete="off" required class="form-control"></div>
            </div>
            <div class="form-group">
              <label class='col'>Nama Belakang</label>
              <div class='col'><input type="text" name="last_name" autocomplete="off" class="form-control"></div>
            </div>
            <div class="form-group">
              <label class='col'>Email</label>
              <div class='col'><input type="text" name="email_user" autocomplete="off" required class="form-control text-lowercase"></div>
            </div>
            <div class="form-group">
              <label class='col'>Role</label>
              <div class='col'>
                <select class="form-control" name="role" autocomplete="off" required>
                  <option value="">Jenis Akun</option>
                  <option>Administrator</option>
                  <option>Manager</option>
                  <option>Sales</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class='col'>Gambar</label>
              <div class='col'>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="foto_user" name="foto_user">
                  <label class="custom-file-label" for="foto_user">Pilih File</label>
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
    <?php foreach ($user2 as $row) : ?>
      <div class="modal fade" id="modal-edit<?= $row['nik'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Edit Detail Akun</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo site_url('KelolaAkun/edit/' . $row['nik']); ?>" method="POST" enctype="multipart/form-data">
              <input type='hidden' name='id' id="id" />

              <div class="modal-body">

                <div class="form-group">
                  <label class='col'>NIK</label>
                  <div class='col'><input type="text" name="nik" autocomplete="off" required value="<?= $row['nik'] ?>" class="form-control" readonly></div>
                </div>
                <div class="form-group">
                  <label class='col'>Kode Sales</label>
                  <div class='col'><input type="text" name="kode_sales" autocomplete="off" required value="<?= $row['kode_sales'] ?>" class="form-control"></div>
                </div>
                <div class="form-group">
                  <label class='col'>Nama Depan</label>
                  <div class='col'><input type="text" name="first_name" autocomplete="off" required value="<?= $row['first_name'] ?>" class="form-control"></div>
                </div>
                <div class="form-group">
                  <label class='col'>Nama Belakang</label>
                  <div class='col'><input type="text" name="last_name" autocomplete="off" value="<?= $row['last_name'] ?>" class="form-control"></div>
                </div>
                <div class="form-group">
                  <label class='col'>Email</label>
                  <div class='col'><input type="text" name="email_user" autocomplete="off" required value="<?= $row['email_user'] ?>" class="form-control text-lowercase"></div>
                </div>
                <div class="form-group">
                  <label class='col'>Role</label>
                  <div class='col'>
                    <select class="form-control" name="role" autocomplete="off" required value="<?= $row['role'] ?>">
                      <option value="<?= $row['role'] ?>" selected hidden> <?= $row['role'] ?></option>
                      <option>Administrator</option>
                      <option>Manager</option>
                      <option>Sales</option>
                    </select>
                  </div>
                </div>

                <div class=" form-group">
                  <label class="col">Gambar</label>
                  <div class="col">
                    <div class="col">
                      <img src="<?= base_url('upload/fotoprofil/') . $row['foto_user'] ?>" class="img-thumbnail" height="150" width="150">
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="foto_user" name="foto_user">
                      <label class="custom-file-label" for="foto_user">Pilih File</label>
                    </div>
                  </div>
                </div>

                <h6 data-toggle="modal" data-target="#modalResetPass<?= $row['nik'] ?>" data-dismiss="modal" style="text-align:center">
                  <a href="#">Reset Password Akun</a>
                </h6>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <input type="submit" class="btn btn-success" value='Simpan' />
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>


    <!-- modal reset password -->
    <?php foreach ($user2 as $row) : ?>

      <div class="modal fade" id="modalResetPass<?= $row['nik'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel"> Reset Password</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
            </div>
            <form action="<?php echo site_url('KelolaAkun/reset/' . $row['nik']); ?>" method="POST">
              <input type='hidden' name='id' id="id" />
              <div class="modal-body">
                Apakah anda ingin mengubah password akun ini kembali ke default (sama dengan NIK)?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary" value='Reset' />
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- modal delete -->
    <?php foreach ($user2 as $row) : ?>

      <div class="modal fade" id="modal-delete<?= $row['nik'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel"> Hapus Akun</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
            </div>
            <form action="<?php echo site_url('KelolaAkun/hapus/' . $row['nik']); ?>" method="POST">
              <input type='hidden' name='id' id="id" />
              <div class="modal-body">
                Hapus akun <?php echo "<strong>" . $row['nik'] . "</strong>"; ?>- <?php echo "<strong>" . $row['first_name'] . ' ' . $row['last_name'] . "</strong>"; ?>?
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

    <!-- <script type="text/javascript">
    $(document).ready( function() {
        $('#datatables').dataTable( {
            "columnDefs": [
            { "orderable": false, "targets": [ 0 ] }
        ] } );
    } );
</script> -->
    <!-- End of Main Content -->