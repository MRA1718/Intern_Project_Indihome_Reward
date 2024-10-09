<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class=" text-gray-800" style="text-align:center">Riwayat Request Redeem</h1>



    <!-- DataTales  -->
    <div class="d-flex justify-content-center">
        <div class="col-10">
            <div style="text-align: right">
                <a href="<?= base_url('/redeemhistory') ?>" style="color: #cc0000"><i class="fas fa-angle-left"></i> Daftar Request Terakhir</a>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Nama Reward</th>
                                    <th style="text-align: center;" width="15%">Nilai</th>
                                    <th style="text-align: center;" width="15%">Tanggal Pengajuan</th>
                                    <th style="text-align: center;" width="15%">Status</th>
                                    <th style="text-align: center;" width="15%">Tanggal Konfirmasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($list_request as $row) : ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row['nama_reward']; ?></td>
                                        <td class="align-middle text-center">
                                            <?php echo $row['point_reward']; ?></td>
                                        <td class="align-middle text-center">
                                            <?php echo date("d-m-Y", strtotime($row['tanggal_choose'])); ?></td>
                                        <td class="align-middle text-center">
                                            <?php if ($row['status_redeem'] == 'approved') { ?>
                                                <div class="h6 font-weight-bold text-success mb-1"><?php echo "Disetujui"; ?></div>
                                            <?php } elseif ($row['status_redeem'] == 'disapproved') { ?>
                                                <div class="h6 font-weight-bold text-danger mb-1"><?php echo "Ditolak"; ?></div>
                                            <?php } else { ?>
                                                <div class="h6 font-weight-bold text-secondary mb-1"><?php echo "Menunggu Konfirmasi"; ?></div>
                                            <?php }; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?php echo date("d-m-Y", strtotime($row['tanggal_approval'])); ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->