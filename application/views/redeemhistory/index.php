<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class=" text-gray-800" style="text-align:center">Riwayat Request Redeem</h1>


    <div class="col text-center">
        <?= $this->session->flashdata('message') ?>
    </div>


    <div class="d-flex justify-content-center">
        <div class="col-10">

            <div style="text-align: right">
                <a href="<?= base_url('/redeemhistory/all') ?>" style="color: #cc0000">Daftar Request Lengkap <i class="fas fa-angle-right"></i></a>
            </div>
            <?php
            $i = 0;
            foreach ($list_request as $ls) :
                if ($i == 5) {
                    break;
                }
                ?>

                <?php if ($ls['status_redeem'] == 'approved') { ?>
                    <div class="card border-left-success shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-3" style="height:120px">
                                    <img src="<?= base_url('upload/fotohadiah/') . $ls['gambar_reward'] ?>" style="height:100%">
                                </div>
                                <div class="col-4">
                                    <div class="h5 font-weight-bold mb-1"><?php echo $ls['nama_reward']; ?></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><i class="fas fa-coins"></i><?php echo $ls['point_reward']; ?></div>
                                </div>
                                <div class="col">
                                    <div class="h6 font-weight-bold text-gray-800" style="font-size:90%">Tanggal Pengajuan :</div>
                                    <div class="h7 text-gray-600 mb-1" style="font-size:80%"> <?php echo date("d-m-Y", strtotime($ls['tanggal_choose'])); ?></div>

                                    <div class="h6 font-weight-bold text-gray-800" style="font-size:90%">Status :</div>
                                    <div class="h7 font-weight-bold text-success mb-1" style="font-size:80%"> <?php echo "Disetujui"; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }; ?>

                <?php if ($ls['status_redeem'] == 'disapproved') { ?>
                    <div class="card border-left-danger shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-3" style="height:120px">
                                    <img src="<?= base_url('upload/fotohadiah/') . $ls['gambar_reward'] ?>" style="height:100%">
                                </div>
                                <div class="col-4">
                                    <div class="h5 font-weight-bold mb-1"><?php echo $ls['nama_reward']; ?></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><i class="fas fa-coins"></i><?php echo $ls['point_reward']; ?></div>
                                </div>
                                <div class="col">
                                    <div class="h6 font-weight-bold text-gray-800" style="font-size:90%">Tanggal Pengajuan :</div>
                                    <div class="h7 text-gray-600 mb-1" style="font-size:80%"> <?php echo $ls['tanggal_choose']; ?></div>

                                    <div class="h6 font-weight-bold text-gray-800" style="font-size:90%">Status :</div>
                                    <div class="h7 font-weight-bold text-danger mb-1" style="font-size:80%"> <?php echo "Ditolak"; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }; ?>

                <?php if ($ls['status_redeem'] == 'waiting') { ?>
                    <div class="card border-left-secondary shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-3" style="height:120px">
                                    <img src="<?= base_url('upload/fotohadiah/') . $ls['gambar_reward'] ?>" style="height:100%">
                                </div>
                                <div class="col-4">
                                    <div class="h5 font-weight-bold  mb-1"><?php echo $ls['nama_reward']; ?></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><i class="fas fa-coins"></i><?php echo $ls['point_reward']; ?></div>
                                </div>
                                <div class="col">
                                    <div class="h6 font-weight-bold text-gray-800" style="font-size:90%">Tanggal Pengajuan :</div>
                                    <div class="h7 text-gray-600 mb-1" style="font-size:80%"> <?php echo $ls['tanggal_choose']; ?></div>

                                    <div class="h6 font-weight-bold text-gray-800" style="font-size:90%">Status :</div>
                                    <div class="h7 font-weight-bold text-secondary mb-1" style="font-size:80%"> <?php echo "Menunggu Konfirmasi"; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }; ?>


                <br>

                <?php
                $i++;
            endforeach; ?>


        </div>
    </div>


</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->