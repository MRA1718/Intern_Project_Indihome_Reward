<div class="container-fluid">

    <div class="d-flex">
        <div class="mr-auto pl-3">
            <?= $this->session->flashdata('message') ?>
        </div>
        <div class="ml-auto pr-3">
            Points Anda : <?= $point['pt_belanja']; ?> <i class="fas fa-coins"></i>
        </div>
    </div>
    <br>


    <body>
        <div class="container-fluid">
            <div class="col">

                <div class="row">
                    <?php foreach ($list_reward as $ls) : ?>
                        <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 mb-3">
                            <div class="card shadow h-100" data-toggle="modal" data-target="#ModalDetail<?= $ls['id_reward'] ?>">
                                <a href="#"><img class="card-img-top" src="<?= base_url('upload/fotohadiah/') . $ls['gambar_reward']; ?>" alt="" data-toggle="modal" data-target="#ModalDetail<?= $ls['id_reward'] ?>"></a>
                                <div class="card-body d-flex flex-column">
                                    <div class="mt-auto">
                                        <h2 class="card-title" data-toggle="modal" data-target="#ModalDetail<?= $ls['id_reward'] ?>" style="text-align:center">
                                            <a href="#" style="color: #cc0000"><?= $ls['nama_reward']; ?></a>
                                        </h2>
                                        <h6 style="text-align: right;"><i class="fas fa-coins"></i><?= $ls['point_reward']; ?></h6>
                                        <!-- <p class="card-text"><?= $ls['deskripsi_reward']; ?></p> -->
                                        <a href="#" class="stretched-link"></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div>
                <!-- /.row -->

            </div>
        </div>

        <!--MODAL DETAIL-->
        <?php foreach ($list_reward as $ls) : ?>

            <div class="modal fade" id="ModalDetail<?= $ls['id_reward'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"><?php echo $ls['nama_reward']; ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        </div>
                        <div class="modal-body">
                            <input type='hidden' name='id_reward' id="id_reward" />
                            <img src="<?= base_url('upload/fotohadiah/') . $ls['gambar_reward'] ?>" style="width:100%">

                            <br>
                            <br>
                            <h6 style="text-align:right"><i class="fas fa-coins"></i><?php echo $ls['point_reward']; ?></h6>
                            <h6><?php echo nl2br($ls['deskripsi_reward']); ?></h6>

                        </div>

                        <div class="modal-footer ml-5">
                            <?php
                            if ($point['pt_belanja'] >= $ls['point_reward']) {
                                echo '<button class="btn btn-primary" data-toggle="modal" data-target="#modal-rusure';
                                echo $ls['id_reward'];
                                echo '" data-dismiss="modal">
                                <i class="icon-checkmark-circle2"></i>
                                <span class="text" style="width:100px">Redeem</span>
                                </button>';
                            } else {
                                echo "Point tidak mencukupi";
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
            <!--END MODAL DETAIL-->
        <?php endforeach; ?>

        <!-- modal r u sure -->
        <?php foreach ($list_reward as $ls) : ?>

            <div class="modal fade" id="modal-rusure<?= $ls['id_reward'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"> Redeem Reward</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        </div>
                        <form action="<?php echo site_url('Hadiah/redeem/' . $ls['id_reward']); ?>" method="POST">
                            <input type='hidden' name='id_reward' id="id_reward" />
                            <div class="modal-body">
                                Are you sure you want to redeem <?php echo $ls['nama_reward']; ?> for <?php echo $ls['point_reward']; ?> points ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value='Redeem' />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>




    </body>




</div>