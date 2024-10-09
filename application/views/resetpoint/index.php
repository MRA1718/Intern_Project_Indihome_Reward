    <!-- Begin Page Content -->
    <div class="container-fluid">

    	<!-- Page Heading -->
    	<h1 class=" text-gray-800" style="text-align:center">Reset Point</h1>
    	<div class="d-flex">
    		<div class=" mr-auto pl-2">
    			<?= $this->session->flashdata('message') ?>
    		</div>
    		<div class=" ml-auto pr-2 pb-3">
    			<button type="button pull-right" class="btn btn-danger" data-toggle="modal" data-target="#modal-reset"> Reset Point </button>
    			</button>
    		</div>
    	</div>

    	<!-- DataTales Example -->
    	<div class="card shadow mb-4">
    		<div class="card-body">
    			<div class="table-responsive">
    				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    					<thead>
    						<tr>
    							<th class="text-center" width="5%">No</th>
    							<th class="text-center" width="12%">NIK</th>
    							<th class="text-center" width="13%">Kode Sales</th>
    							<th class="text-center">Nama</th>
    							<th class="text-center" width="13%">Total Poin</th>
    							<th class="text-center" width="13%">Poin Belanja</th>
    						</tr>
    					</thead>
    					<tbody>
    						<?php $no = 1;
							foreach ($point_sales as $res) : ?>
    							<tr class="odd gradeX">
    								<td class="text-center"><?php echo $no++; ?></td>
    								<td class="text-center"><?php echo $res['nik']; ?></td>
    								<td class="text-center"><?php echo $res['kode_sales']; ?></td>
    								<td><?php echo $res['first_name'] . ' ' . $res['last_name']; ?></td>
    								<td class="text-center"><?php echo $res['total_pt']; ?></td>
    								<td class="text-center"><?php echo $res['pt_belanja']; ?></td>
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
    </div>


    <!-- modal delete -->
    <?php foreach ($res as $row) : ?>

    	<div class="modal fade" id="modal-reset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    		<div class="modal-dialog">

    			<div class="modal-content">
    				<div class="modal-header">
    					<h4 class="modal-title" id="myModalLabel"> Reset Point</h4>
    					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
    				</div>
    				<form action="<?php echo site_url('ResetPoint/reset') ?>" method="POST">
    					<input type='hidden' name='id' id="id" />
    					<div class="modal-body">
    						Reset seluruh point sales? </div>
    					<div class="modal-footer">
    						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
    						<input type="submit" class="btn btn-danger" value='Reset' />
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    <?php endforeach; ?>



    <!-- End of Main Content -->