<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <br>
    <div class="d-flex justify-content-center">
        <div class="col-10 text-center">
            <?= $this->session->flashdata('message') ?>
        </div>
    </div>


    <div class="d-flex justify-content-center">
        <div class="card border-left-danger shadow col-10">

            <div class="m-4 d-flex justify-content-left">
                <div class="col-4 text-right">
                    <img src="<?= base_url('upload/fotoprofil/') . $user['foto_user']; ?>" style=" max-width: 95%; max-height: 250px;" class="ml-4 mt-4 rounded">
                </div>
                <div class="col-8">
                    <h1 class="mt-5 ml-4 text-gray-800" style="text-align:left"><?= $user['first_name'] . ' ' . $user['last_name'] ?></h1>
                    <h6 class="ml-5 font-weight-bold text-danger" style="text-align:left"><?= $user['email_user'] ?></h6>
                    <h4 class="ml-5 font-weight-bold text-gray" style="text-align:left"><?= $user['role'] ?></h4>
                    <br>
                    <div class="text-right mr-5">
                        <button class="btn btn-dark " data-toggle="modal" data-target="#modal-password" style="width:20%">
                            <span class="text" style="width:100px">Ubah Password</span>
                        </button>
                    </div>

                </div>
            </div>


            <form action="<?php echo site_url('Profil/edit/' . $user['nik']); ?>" method="POST" enctype="multipart/form-data">
                <input type='hidden' name='id' id="id" />
                <div class="form-group">
                    <div class="row mb-2">
                        <h5 class="ml-2 mt-2 mr-4 col-4 font-weight-bold align-middle text-right">NIK</h5>
                        <div class="col-7">
                            <input type="text" name="nik" autocomplete="off" required readonly value="<?= $user['nik'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <h5 class="ml-2 mt-2 mr-4 col-4 font-weight-bold align-middle text-right">Nama Depan</h5>
                        <div class="col-7">
                            <input type="text" name="first_name" autocomplete="off" required value="<?= $user['first_name'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <h5 class="ml-2 mt-2 mr-4 col-4 font-weight-bold align-middle text-right">Nama Belakang</h5>
                        <div class="col-7">
                            <input type="text" name="last_name" autocomplete="off" required value="<?= $user['last_name'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <h5 class="ml-2 mt-2 mr-4 col-4 font-weight-bold align-middle text-right">Email</h5>
                        <div class="col-7">
                            <input type="text" name="email_user" autocomplete="off" required value="<?= $user['email_user'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <h5 class="ml-2 mt-2 mr-4 col-4 font-weight-bold align-middle text-right">Foto Profil</h5>
                        <div class="col-7">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto_user" name="foto_user">
                                <label class="custom-file-label" for="foto_user">Pilih File</label>
                            </div>
                        </div>
                    </div>
                    <div class="row- mr-5 mt-5 text-right">
                        <button type="submit" class="btn btn-success"><i class="icon-checkmark-circle2"></i> Simpan</button>
                    </div>


                </div>
                <br>
            </form>

        </div>
    </div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->

<!-- modal password -->
<div id="modal-password" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Ubah Password</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <?php echo form_open_multipart('Profil/editpassword') ?>
                <div class="form-group">
                    <label class='col'>Password Lama</label>
                    <div class='col'><input type="password" name="old_pass" autocomplete="off" required class="form-control"></div>
                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label class='col'>Password Baru</label>
                    <div class='col'><input type="password" name="new_pass" autocomplete="off" required class="form-control"></div>
                    <?= form_error('new_password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label class='col'>Ulangi Password Baru</label>
                    <div class='col'><input type="password" name="confirm_pass" autocomplete="off" required class="form-control"></div>
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