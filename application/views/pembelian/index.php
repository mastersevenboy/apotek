<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="col-lg-12">
        <h1 class="h3 mb-4 text-gray-800">Pembelian</h1>
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">List Pembelian</h6>
			</div>
			<div class="card-body">
				<?php if ($this->session->flashdata('info')) : ?>
					<div class="alert alert-danger">
						<?php echo $this->session->flashdata('info'); ?>
					</div>
				<?php endif; ?>
				<div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
							<th>No</th>
							<th>#id_beli</th>
							<th>Tanggal Pembelian</th>
							<th>Admin</th>
							<th>Supplier</th>
							<th>Total</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<?php $no = 1; ?>
					<?php foreach($pembelian as $tr) : ?>
					<tbody>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $tr->id_pembelian; ?></td>
							<td><span class="badge badge-dark"><?php echo $tr->tgl; ?></span></td>
							<td><?php echo $tr->nama; ?></td>
							<td><?php echo $tr->nama_sp; ?></td>
							<td><?php echo $tr->total; ?></td>
							<td>
								<a href="<?php echo site_url('pembelian/hapus/') . $tr->id_pembelian; ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a> |
								<a href="#" data-toggle="modal" data-target="#viewModal<?php echo $tr->id_pembelian;?>"
								class="btn btn-warning btn-circle btn-sm"><i class="fa fa-eye"></i></a>
							</td>
						</tr>
					</tbody>
					<?php endforeach ?>
				</table>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

<!-- Modal View -->
<?php foreach($pembelian as $tr) : ?>
<div class="modal fade" id="viewModal<?php echo $tr->id_pembelian;?>" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="largeModalLabel">View Pembelian</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="row">
			    <div class="col-lg-12">
		            <div class="card border-left-primary shadow h-100 py-2">
		                <div class="card-body">
		                    <div class="card shadow mb-4">
		                    <div class="card-body">
		                    <form action="" method="post" enctype="multipart/form-data">       
		                    <div class="form-group">
		                        <label for="nama-obat">Nama Obat</label>
		                        <input type="text" name="nama_obat" disabled value="<?php echo $tr->nama_obat ?>" id="nama-obat" class="form-control">
		                    </div>
		                    <div class="form-group">
		                        <label for="harga">Harga</label>
		                        <input type="number" name="harga" disabled value="<?php echo $tr->harga_beli ?>" id="harga" class="form-control">
		                    </div>
		                    <div class="form-group">
		                        <label for="jumlah">Jumlah</label>
		                        <input type="number" name="jumlah" disabled value="<?php echo $tr->jumlah ?>" id="jumlah" class="form-control">
		                    </div>
		                    <div class="form-group">
		                        <label for="supplier">Supplier</label>
		                        <input type="text" name="supplier" disabled value="<?php echo $tr->nama_sp ?>" class="form-control">
		                    </div>
		                    <div class="form-group">
		                        <label for="produsen">Prodsen</label>
		                        <input type="text" name="produsen" disabled value="<?php echo $tr->produsen ?>" id="produsen" class="form-control">
		                    </div>
		                    <!-- <div class="form-group">
		                        <label for="foto">Foto obat</label>
		                        <input type="file" name="foto" id="foto" class="form-control">
		                    </div> -->
		                    <div class="form-group">
		                        <label for="total">Total Uang</label>
		                        <input type="number" name="total" disabled value="<?php echo $tr->total ?>" id="total" class="form-control">
		                    </div>
		                    <!-- <button type="submit" name="submit" class="btn btn-success">Tambah</button> -->
		                    <!-- <button type="button" class="close">Close</button> -->
		                    </form>
		                    </div>
		                </div>
		                </div>
		            </div>
	        	</div>
	    	</div>
		</div>
	</div>
</div>
<?php endforeach ?>
