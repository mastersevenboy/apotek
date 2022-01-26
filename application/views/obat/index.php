<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="col-lg-12">
        <h1 class="h3 mb-4 text-gray-800">Data obat</h1>
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">List obat</h6>
			</div>
			<div class="card-body">
				<?php if ($this->session->flashdata('info')) : ?>
					<div class="alert alert-danger">
						<?php echo $this->session->flashdata('info'); ?>
					</div>
				<?php endif; ?>
				<table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Kode Obat</th>
							<th>Nama Obat</th>
							<th>Harga</th>
							<!-- <th>Produsen</th>
							<th>Supplier</th> -->
							<th>Stok</th>
							<th>Keterangan</th>
							<th>Gambar</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<?php $no = 1; ?>
					<?php foreach($obat->result() as $o) : ?>
					<tbody>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $o->kode; ?></td>
							<td><?php echo $o->nama_obat; ?></td>
							<td><?php echo $o->harga; ?></td>
							<!-- <td><?php echo $o->produsen; ?></td>
							<td><?php echo $o->nama; ?></td> -->
							<td><?php echo $o->stok; ?></td>
							<td><?php echo $o->keterangan; ?></td>
							<td><img src="<?php echo base_url('assets/img/') . $o->foto; ?>" width="100" class=""></td>
							<td>
								| <a href="<?php echo site_url('obat/hapus/') . $o->kode; ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a> |
								| <a href="<?php echo site_url('obat/ubah/') . $o->kode; ?>" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-edit"></i></a> |
								| <a href="#" data-toggle="modal" data-target="#tambahModal<?php echo $o->kode;?>"
								class="btn btn-warning btn-circle btn-sm"><i class="fa fa-eye"></i></a> |
							</td>
						</tr>
					</tbody>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
<?php foreach($obat->result() as $o) : ?>
<div class="modal fade" id="tambahModal<?php echo $o->kode;?>" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="largeModalLabel">View data obat</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="row">
		        <div class="col-lg-10">
		            <div class="card shadow mb-4">
		                <div class="card-header py-3">
		                    <h6 class="m-0 font-weight-bold text-primary">View data obat</h6>
		                </div>
		                <div class="card-body">
		                    <form action="" method="post" enctype="multipart/form-data">
		                        <input type="hidden" name="foto_lama" value="<?php echo $o->foto ?>">
		                        <?php if ($this->session->flashdata('info')) : ?>
		                        <div class="alert alert-danger">
		                            <?php echo $this->session->flashdata('info'); ?>
		                        </div>
		                        <?php endif; ?>
		                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
		                        <div class="form-group">
		                            <label for="kode-obat">Kode Obat</label>
		                            <input type="text" disabled name="kode_obat" value="<?php echo set_value('kode_obat', $o->kode) ?>" id="kode-obat" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label for="supplier">Supplier</label>
		                            <input type="text" disabled value="<?php echo set_value('nama', $o->nama_sp) ?>" name="nama" id="nama-obat" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label for="nama-obat">Nama Obat</label>
		                            <input type="text" disabled value="<?php echo set_value('nama', $o->nama_obat) ?>" name="nama" id="nama-obat" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label for="produsen">Prodsen</label>
		                            <input type="text" disabled value="<?php echo set_value('produsen', $o->produsen) ?>" name="produsen" id="produsen" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label for="harga">Harga</label>
		                            <input type="number" disabled value="<?php echo set_value('harga', $o->harga) ?>" name="harga" id="harga" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label for="stok">Jumlah stok</label>
		                            <input type="number" disabled value="<?php echo set_value('stok', $o->stok) ?>" name="stok" id="stok" class="form-control">
		                        </div>
		                        <!-- <div class="form-group">
		                            <label for="foto">Foto obat</label>
		                            <input type="file" name="foto" id="foto" class="form-control">
		                        </div> -->
		                        <div class="form-group">
		                            <label for="keterangan">Keterangan</label>
		                            <textarea class="form-control" disabled rows="10" name="keterangan"  value="<?php echo set_value('keterangan', $o->keterangan) ?>" id="keterangan"><?php echo set_value('keterangan', $o->keterangan) ?></textarea>
		                        </div>
		                        <!-- <button type="submit" name="submit" class="btn btn-success">Ubah</button> -->
		                    </form>
		                </div>
		            </div>
		        </div>
		        <div class="col-lg-2">
		        	<div class="card shadow mb-4">
		                <div class="card-header py-3">
		                    <h6 class="m-0 font-weight-bold text-primary">Foto</h6>
		                </div>
		                <div class="card-body">
		                <img src="<?php echo base_url('assets/img/') . $o->foto; ?>" width="100%" class="img-thumbnail">
		                </div>
		            </div>
		        </div>
	    	</div>
		</div>
	</div>
</div>
<?php endforeach ?>