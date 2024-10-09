<!-- Sidebar -->
<div class="navbar-nav bg-gradient-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <ul class="text-center p-0" style="list-style: none; position: sticky; top: 0; left: 0;">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('leaderboard'); ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <!-- <i class="fas fa-coins"></i> -->
                <img src="<?= base_url('assets/') ?>img/telkom_indonesia_white.png" alt="telkom_indonesia" height="30" width="30" class="justify-content-center">
            </div>
            <div class="sidebar-brand-text mx-2 ">IndihomeReward</div>
        </a>
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('leaderboard'); ?>">
                <i class="fas fa-sort-numeric-down"></i>
                <span>Pencapaian Reward Sales</span></a>
        </li>

        <hr class="sidebar-divider">
        <!-- ADMIN -->
        <?php if ($this->session->userdata('role') == 'Administrator') { ?>
            <div class="sidebar-heading"> Admin </div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('kelolaakun'); ?>">
                    <i class="fas fa-user-edit"></i>
                    <span>Kelola Akun</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('kelolahadiah'); ?>">
                    <i class="fas fa-edit"></i>
                    <span>Kelola Hadiah</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('import'); ?>">
                    <i class="fas fa-file-upload"></i>
                    <span>Import PS</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('resetpoint'); ?>">
                    <i class="fas fa-undo"></i>
                    <span>Reset Point</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
        <?php }; ?>
        <!-- MANAGER -->
        <?php if ($this->session->userdata('role') == 'Manager') { ?>
            <div class="sidebar-heading"> Manager </div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('kelolahadiah'); ?>">
                    <i class="fas fa-edit"></i>
                    <span>Kelola Hadiah</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('request'); ?>">
                    <i class="fas fa-th-list"></i>
                    <span>Request Redeem</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('validasiakun'); ?>">
                    <i class="fas fa-user-check"></i>
                    <span>Validasi Akun</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
        <?php }; ?>

        <!-- SALES -->
        <?php if ($this->session->userdata('role') == 'Sales') { ?>
            <div class="sidebar-heading"> Sales </div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('user'); ?>">
                    <i class="fas fa-user"></i>
                    <span>Profil</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('hadiah'); ?>">
                    <i class="fas fa-gift"></i>
                    <span>Redeem Reward</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('redeemhistory'); ?>">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Redeem</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
        <?php }; ?>

        <!-- Divider -->
        <!-- <hr class="sidebar-divider d-none d-md-block"> -->

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
</div>
<!-- End of Sidebar -->