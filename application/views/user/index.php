<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class=" text-gray-800" style="text-align:center">Profil Pengguna</h1>
    <br>

    <div class="col text-center">
        <?= $this->session->flashdata('message') ?>
    </div>


    <div class="d-flex justify-content-center">


        <div class="col-6 col-sm-6 col-md-4 mb-3">

            <div class="card border-left-danger shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-secondary" style="text-align: center;">Informasi Profil</h6>
                </div>
                <div class="d-flex justify-content-center">
                    <img src="<?= base_url('upload/fotoprofil/') . $user['foto_user']; ?>" style=" max-width: 95%; max-height: 400px;">
                </div>

                <div class="row ">
                    <div class="card-body">
                        <div class="col">
                            <h1 class="h3 mt-1 ml-3 text-gray-800" style="text-align:left"><?= $user['first_name'] . ' ' . $user['last_name'] ?></h1>
                            <h6 class="ml-5 font-weight-bold text-danger" style="text-align:left"><?= $user['email_user'] ?></h6>
                            <h4 class="ml-5 font-weight-bold text-gray" style="text-align:left"><?= $user['role'] ?></h4>
                            <h6 class="ml-5  text-dark" style="text-align:left">Point yang Dimiliki : <?= $point['pt_belanja']; ?> <i class="fas fa-coins"></i></h6>
                        </div>


                    </div>

                </div>

            </div>
            <br>
            <div class="card border-left-danger shadow mb-4">
                <a href="#collapseCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                    <h6 class="m-0 font-weight-bold text-secondary" style="text-align: center;">Sunting Profil</h6>
                </a>
                <div class="collapse" id="collapseCard">
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-column">

                            <button class="btn btn-dark " data-toggle="modal" data-target="#modal-password" style="width:80%">
                                <span class="text" style="width:100px">Ubah Password</span>
                            </button>
                            <br>
                            <button class="btn btn-dark " data-toggle="modal" data-target="#modal-edit" style="width:80%">
                                <span class=" text" style="width:100px">Ubah Foto</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-md-8 mb-3">
            <div class="card border-left-danger shadow">
                <div class="row no-gutters">
                    <table class="table table-hover" width="100%" id="mydata">
                        <thead>
                            <tr style="text-align: center;">
                                <th>Bulan</th>
                                <th>Total PS</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 0;
                            foreach (array_reverse($recap) as $row) :
                                if ($i == 12) {
                                    break;
                                }
                                ?>

                                <tr style="text-align: center;">
                                    <td><?php echo $row['bulan']; ?></td>
                                    <td><?php echo $row['totalps']; ?></td>
                                </tr>
                                <?php $i++;
                            endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
            <br>
            <div class="card border-left-danger shadow ">
                <script type="text/javascript" src="assets/vendor/chart.js/Chart.js"></script>
                <canvas id="myChart" width="400" height="140"></canvas>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {

                            labels: [<?php $i = 0;
                                        foreach (array_reverse($recap) as $row) :
                                            if ($i == 12) {
                                                break;
                                            }
                                            echo "'";
                                            echo $row['bulan'];
                                            echo "'";
                                            echo ", ";
                                            $i++;
                                        endforeach; ?>],
                            datasets: [{
                                label: 'Total PS',
                                data: [<?php $i = 0;
                                        foreach (array_reverse($recap) as $row) :
                                            if ($i == 12) {
                                                break;
                                            }
                                            echo $row['totalps'];
                                            echo ", ";
                                            $i++;
                                        endforeach; ?>],
                                lineTension: 0.3,
                                backgroundColor: "rgba(223, 78, 78, 0.05)",
                                borderColor: "rgba(223, 78, 78, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(223, 78, 78, 1)",
                                pointBorderColor: "rgba(223, 78, 78, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(223, 78, 78, 1)",
                                pointHoverBorderColor: "rgba(223, 78, 78, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
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
                <?php echo form_open_multipart('User/editpassword') ?>
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

<!-- modal edit -->
<div class="modal fade" id="modal-edit" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Ubah Foto Profil</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo site_url('User/editfoto/' . $user['nik']); ?>" method="POST" enctype="multipart/form-data">
                <input type='hidden' name='id' id="id" />

                <div class="modal-body">

                    <div class=" form-group">
                        <div class="col">Gambar</div>
                        <div class="col">
                            <div class="col">
                                <img src="<?= base_url('upload/fotoprofil/') . $user['foto_user'] ?>" class="img-thumbnail" width="280" height="280">
                            </div>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto_user" name="foto_user">
                                <label class="custom-file-label" for="foto_user">Pilih File</label>
                            </div>
                        </div>
                    </div>

                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <input type="submit" class="btn btn-success" value='Simpan' />
                </div>
            </form>
        </div>
    </div>
</div>