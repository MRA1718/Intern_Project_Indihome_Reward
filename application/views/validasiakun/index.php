    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="text-gray-800" style="text-align:center">Daftar Akun Belum Tervalidasi</h1>
        <br>
        <br>
        <div class="d-flex justify-content-start">
            <?= $this->session->flashdata('message') ?>
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
                                <th style="text-align: center;" width="9%">Foto</th>
                                <th style="text-align: center;">Nama</th>
                                <th style="text-align: center;">Email</th>
                                <th style="text-align: center;" width="10%">Role</th>
                                <th style="text-align: center;" width="10%">Status Akun</th>
                                <th style="text-align: center;" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <!-- <tfoot>
                            <tr>
                                <th>nik</th>
                                <th>Kode Sales</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status Akun</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot> -->
                        <tbody>
                            <?php $no = 1;
                            foreach ($user2 as $row) : ?>
                                <tr class="odd gradeX">
                                    <td class="align-middle text-center"><?php echo $row['nik']; ?></td>
                                    <td class="align-middle text-center"><?php echo $row['kode_sales']; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php echo "<img src='upload/fotoprofil/" . $row['foto_user']  . "' height='80'> "; ?></td>
                                    <td class="align-middle"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                    <td class="align-middle"><?php echo $row['email_user']; ?></td>
                                    <td class="align-middle text-center"><?php echo $row['role']; ?></td>
                                    <td class="align-middle text-center">
                                        <div class="h6 font-weight-bold text-danger mb-1">
                                            <?php echo $row['user_is_active']; ?></td>
                                        </div>
                                    <td class="align-middle text-center">
                                        <button class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#modal-validasi<?= $row['nik'] ?>">
                                            <span class="icon text-white-50 " style="width:40px">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text" style="width:100px">Validasi</span>
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

    <!-- End of Main Content -->


    <!-- modal validate -->
    <?php foreach ($user2 as $row) : ?>

        <div class="modal fade" id="modal-validasi<?= $row['nik'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"> Validasi Akun</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                    </div>
                    <form action="<?php echo site_url('ValidasiAkun/validasi/' . $row['nik']); ?>" method="POST">
                        <input type='hidden' name='id' id="id" />
                        <div class="modal-body">
                            Validasi akun <?php echo "<strong>" . $row['first_name'] . ' ' . $row['last_name'] . "</strong>"; ?> dengan NIK <?php echo "<strong>" . $row['nik'] . "</strong>"; ?> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <input type="submit" class="btn btn-success" value='Validasi' />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- End of Main Content -->