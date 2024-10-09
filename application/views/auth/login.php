<div class="container">

    <br>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">

            <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: rgba(255, 255, 255, 1);">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row" style="height:600px">
                        <div class="col-lg-6">
                            <img src="<?= base_url('assets/img/background2.png'); ?>" alt="" style="position: absolute; z-index: 0;">

                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Indihome Reward</h1>
                                </div>


                                <?= $this->session->flashdata('message'); ?>

                                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="nik" name="nik" placeholder="NIK" value="<?= set_value('nik'); ?>">
                                        <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password_user" placeholder="password" name="password_user">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <!-- <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/registration'); ?>">Create an Account!</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>