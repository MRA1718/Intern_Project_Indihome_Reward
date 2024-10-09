<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class=" text-gray-800" style="text-align:center">Daftar Permintaan Redeem Reward</h1>
    <br>
    <div class="d-flex">
        <div class=" mr-auto pl-2">
            <?= $this->session->flashdata('message') ?>
        </div>

        <div class=" ml-auto pr-2 pb-3">
            <a class="btn btn-light">Daftar Request</a>
            <a href="<?= base_url("Request/approved"); ?>" class="btn btn-secondary" role="button">Request Disetujui</a>
            <a href="<?= base_url("Request/disapproved"); ?>" class="btn btn-secondary" role="button">Request Tertolak</a>
        </div>
    </div>


    <!-- DataTales  -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="align-middle text-center" width="8%">NIK</th>
                            <th class="align-middle text-center" width="8%">Kode Sales</th>
                            <th class="align-middle text-center">Nama</th>
                            <!-- <th style="text-align: center;"width="10%">Point yang Dimiliki</th> -->
                            <th class="align-middle text-center">Reward Pilihan</th>
                            <th class="align-middle text-center">Tanggal Redeem</th>
                            <th class="align-middle text-center" width="8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($list_request as $row) : ?>
                            <tr class="odd gradeX">
                                <td class="align-middle text-center"><?php echo $row['nik']; ?></td>
                                <td class="align-middle text-center"><?php echo $row['kode_sales']; ?></td>
                                <td class="align-middle"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                <!-- <td><?php echo $row['point_ps']; ?></td> -->
                                <td class="align-middle"><?php echo $row['nama_reward']; ?></td>
                                <td class="align-center text-center"><?php echo date("d-m-Y", strtotime($row['tanggal_choose'])); ?></td>
                                <td class="align-middle text-center">

                                    <button class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#modal-confirm<?= $row['id_redeem'] ?>">
                                        <span class="icon text-white-50 " style="width:40px">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text" style="width:100px">Setujui</span>
                                    </button>
                                    <button class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#modal-tolak<?= $row['id_redeem'] ?>">
                                        <span class="icon text-white-50 " style="width:40px">
                                            <i class="fas fa-times"></i>
                                        </span>
                                        <span class="text" style="width:100px">Tolak</span>
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
<!-- End of Main Content -->


<!-- modal setuju -->
<?php foreach ($list_request as $row) : ?>

    <div class="modal fade" id="modal-confirm<?= $row['id_redeem'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> Setujui Request Redeem</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                </div>
                <form action="<?php echo site_url('Request/setujui/' . $row['id_redeem']); ?>" method="POST">
                    <input type='hidden' name='id_redeem' id="id_redeem" />
                    <div class="modal-body">
                        Terima request dari <?php echo "<strong>" . $row['first_name'] . ' ' . $row['last_name'] . "</strong>"; ?> untuk redeem <?php echo "<strong>" . $row['nama_reward'] . "</strong>"; ?> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-success" value='Setujui' />
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($list_request as $row) : ?>

    <div class="modal fade" id="modal-tolak<?= $row['id_redeem'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> Tolak Request Redeem</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                </div>
                <form action="<?php echo site_url('Request/tolak/' . $row['id_redeem']); ?>" method="POST">
                    <input type='hidden' name='id_redeem' id="id_redeem" />
                    <div class="modal-body">
                        Tolak request dari <?php echo "<strong>" . $row['first_name'] . ' ' . $row['last_name'] . "</strong>"; ?> untuk redeem <?php echo "<strong>" . $row['nama_reward'] . "</strong>"; ?> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-danger" value='Tolak' />
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>