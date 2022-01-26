<div class="container-fluid">
    <!-- Page Heading -->
	<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Profil Toko</h1>
    </div> -->
    <div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Profil Toko</h6>
			</div>
			<div class="card-body">
				<?php echo $this->session->flashdata('message'); ?>
				<table class="table table-bordered">
					<thead>
						<tr>
                            <th>Logo Toko</th>
                            <th>Nama Toko</th>
							<th>Alamat Toko</th>
							<th>No_Hp</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<?php foreach ($profil as $row): ?>
					<tbody>
						<tr>
                            	<td><img src="<?php echo base_url('assets/img/') . $row->logo; ?>" width="100"></td>
                            	<td><?php echo $row->nama_tk?></td>
                            	<td><?php echo $row->alamat_tk?></td>
                            	<td><?php echo $row->no_hp?></td>
                            	<td>
                            		<a href="#data_profil<?php echo $row->id_profil; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
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

<!-- Modal Edit -->
<?php foreach ($profil as $row): ?>
<div class="modal fade" id="data_profil<?php echo $row->id_profil; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel">Edit Data Profil Toko</h3><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url() ?>profil/ubah/<?php echo $row->id_profil; ?>" target="_blank" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Logo</label>
                        <div class="form-group">
                        	<center><img src="<?php echo base_url('assets/img/') . $row->logo; ?>" width="200" alt=""></center>
                        </div>
                        <span><font color="red">*Silakan pilih choose file jika ingin mengganti logo jika tidak silakan dibiarkan*</font></span>
                        <input type="file" name="input_gambar" id="file-input" class="form-control">
                        <input data-toggle="tooltip" data-placement="top" title="" data-original-title="" name="filelama" value="<?=$row->logo ?>" type="hidden" class="form-control date">
                    </div>
                    <div class="form-group">
                     	<label>Nama Toko</label>
                        <input type="text" name="nm_tk" class="form-control" value="<?php echo $row->nama_tk?>">
                    </div>
                    <div class="form-group">
                        <label>No_Hp Toko</label>
                        <input type="text" name="no_hp" class="form-control" value="<?php echo $row->no_hp?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat Toko</label>
                        <textarea class="form-control" rows="10" name="alamat_tk" value="<?php echo $row->alamat_tk?>"><?php echo $row->alamat_tk?></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-save"></span> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach ?>