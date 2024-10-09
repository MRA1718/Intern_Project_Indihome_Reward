<div class="container-fluid">

  <body>
    <h1 class="text-gray-800" style="text-align:center">Import PS</h1>
    <br>
    <br>
    <div class="d-flex justify-content-center">
      <div class="col-12 col-sm-9 col-md-6 mb-3">
          <div class="pr-2 pb-2 text-right">
            <a class="btn btn-light">PS Harian</a>
            <a href="<?= base_url("import/ps_bulanan"); ?>" class="btn btn-secondary" role="button">PS Bulanan</a>
          </div>
       <div class="card shadow mb-4">

          <div class="card-header pt-3 pb-2">
            <h6 class="m-0 font-weight-bold text-gray">Unggah File PS Harian (.xls)</h6>
          </div>
          <div class="col text-center pt-2 pl-2 pr-2">
            <?= $this->session->flashdata('message') ?>
          </div>
          <form action="<?= base_url() ?>import/import_ps_harian" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <div class="col">
                  <div class="custom-file">
                    <input type="file" id="file" name="file" class="custom-file-input" required accept=".xls">
                    <label class="custom-file-label" for="file"> Pilih File PS Harian </label>
                  </div>
                </div>
                <br>
                <div class="col">
                  <input type="number" name="multip_point" class="form-control" required placeholder="Nilai Pengali Point">
                </div>
                <br>
                <button type="submit" name="btn_submit" class="btn btn-danger float-right mr-2 mb-4" id="btn_submit"><i class="fa fa-upload "></i> Kirim </button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </body>
</div>