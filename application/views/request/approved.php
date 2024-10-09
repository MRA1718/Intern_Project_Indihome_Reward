<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class=" text-gray-800" style="text-align:center">Daftar Permintaan Redeem Reward</h1>
    <br>
    <div class="d-flex">
        <div class=" ml-auto pr-2 pb-3">

            <a href="<?= base_url("Request"); ?>" class="btn btn-secondary" role="button">Daftar Request</a>
            <a class="btn btn-light">Request Disetujui</a>
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
                            <th class="align-center text-center" width="8%">NIK</th>
                            <th class="align-center text-center" width="12%">Kode Sales</th>
                            <th class="align-center text-center">Nama</th>
                            <!-- <th style="text-align: center;"width="10%">Point yang Dimiliki</th> -->
                            <th class="align-center text-center">Reward Pilihan</th>
                            <th class="align-center text-center">Tanggal Request</th>
                            <th class="align-center text-center">Tanggal Konfirmasi</th>
                            <th class="align-center text-center" width="15%">Status Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($list_request as $row) : ?>
                            <tr class="odd gradeX">
                                <td class="align-center text-center"><?php echo $row['nik']; ?></td>
                                <td class="align-center text-center"><?php echo $row['kode_sales']; ?></td>
                                <td class="align-center"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                <td class="align-center"><?php echo $row['nama_reward']; ?></td>
                                <td class="align-center text-center"><?php echo date("d-m-Y", strtotime($row['tanggal_choose'])); ?></td>
                                <td class="align-center text-center"><?php echo date("d-m-Y", strtotime($row['tanggal_approval'])); ?></td>
                                <td class="h6 font-weight-bold text-success text-center align-middle"><?php echo "Disetujui"; ?> </td>
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