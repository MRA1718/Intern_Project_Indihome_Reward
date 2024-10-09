<div class="container-fluid">
    <div class="row-mt-3">
        <div class="col">
            <h1 class=" mb-2 text-gray-800 text-center">Pencapaian Reward Sales</h1>
            <br>


            <div class="card-columns d-flex justify-content-center align-items-baseline">

                <div class="order-2" style="width: 300px;">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url('assets/img/number/one.png'); ?>" alt="" style="position: absolute; z-index: 2; width: 23%">
                        <?php if (empty($leaderboard[0]) OR $leaderboard[0]['total_pt'] == 0) : ?>
                            <img class="card-img-top1" src="<?= base_url('assets/img/profile/'); ?>default.jpg" alt="">
                        <?php else : ?>
                            <img class="card-img-top1" src="<?= base_url('upload/fotoprofil/') . $leaderboard[0]['foto_user']; ?>" alt="">
                        <?php endif; ?>
                        <div class="card-body text-center">
                            <?php if (empty($leaderboard[0]) OR $leaderboard[0]['total_pt'] == 0) : ?>
                                <h5 class="card-title"> - </h5>
                            <?php else : ?>
                                <h5 class="card-title">
                                    <?= $leaderboard[0]['first_name']; ?>
                                </h5>
                            <?php endif; ?>
                            <?php if (empty($leaderboard[0]) OR $leaderboard[0]['total_pt'] == 0) : ?>
                                <h6> - <i class="fas fa-coins"></i></h6>
                            <?php else : ?>
                                <h6><?= $leaderboard[0]['total_pt']; ?><i class="fas fa-coins"></i></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                <div class="order-1" style="width: 250px; ">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url('assets/img/number/two.png'); ?>" alt="" style="position: absolute; z-index: 2; width: 23%">
                        <?php if (empty($leaderboard[1]) OR $leaderboard[1]['total_pt'] == 0) : ?>
                            <img class="card-img-top23" src="<?= base_url('assets/img/profile/'); ?>default.jpg" alt="">
                        <?php else : ?>
                            <img class="card-img-top23" src="<?= base_url('upload/fotoprofil/') . $leaderboard[1]['foto_user']; ?>" alt="">
                        <?php endif; ?>
                        <div class="card-body text-center">
                            <?php if (empty($leaderboard[1]) OR $leaderboard[1]['total_pt'] == 0) : ?>
                                <h5 class="card-title"> - </h5>
                            <?php else : ?>
                                <h5 class="card-title">
                                    <?= $leaderboard[1]['first_name']; ?>
                                </h5>
                            <?php endif; ?>
                            <?php if (empty($leaderboard[1]) OR $leaderboard[1]['total_pt'] == 0) : ?>
                                <h6> - <i class="fas fa-coins"></i></h6>
                            <?php else : ?>
                                <h6><?= $leaderboard[1]['total_pt']; ?><i class="fas fa-coins"></i></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="order-3" style="width: 250px; ">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url('assets/img/number/three.png'); ?>" alt="" style="position: absolute; z-index: 2; width: 23%">
                        <?php if (empty($leaderboard[2]) OR $leaderboard[2]['total_pt'] == 0) : ?>
                            <img class="card-img-top23" src="<?= base_url('assets/img/profile/'); ?>default.jpg" alt="">
                        <?php else : ?>
                            <img class="card-img-top23" src="<?= base_url('upload/fotoprofil/') . $leaderboard[0]['foto_user']; ?>" alt="">
                        <?php endif; ?>
                        <div class="card-body text-center">
                            <?php if (empty($leaderboard[2]) OR $leaderboard[2]['total_pt'] == 0) : ?>
                                <h5 class="card-title"> - </h5>
                            <?php else : ?>
                                <h5 class="card-title">
                                    <?= $leaderboard[2]['first_name']; ?>
                                </h5>
                            <?php endif; ?>
                            <?php if (empty($leaderboard[2]) OR $leaderboard[2]['total_pt'] == 0) : ?>
                                <h6> - <i class="fas fa-coins"></i></h6>
                            <?php else : ?>
                                <h6><?= $leaderboard[2]['total_pt']; ?><i class="fas fa-coins"></i></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="col-10">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="10%">Peringkat</th>
                                            <th class="text-center" width="12.5%">NIK</th>
                                            <th class="text-center" width="12.5%">Kode Sales</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center" width="20%">Pencapaian Point</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($leaderboard as $row) : ?>
                                            <tr class="odd gradeX">
                                                <td class="text-center"><?php echo $no++; ?></td>
                                                <td class="text-center"><?php echo $row['nik']; ?></td>
                                                <td class="text-center"><?php echo $row['kode_sales']; ?></td>
                                                <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                                <td class="text-center"><?php echo $row['total_pt']; ?></td>
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


    </div>