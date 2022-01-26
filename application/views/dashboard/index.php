<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah obat  
							</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($count['obat']); ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-dark shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Jumlah admin  
							</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($count['admin']); ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah supplier  
							</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($count['supplier']); ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Transaksi  
							</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><a href="Transaksi">Transaksi</a></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="row">
	<div class="col-xl-6 col-md-6 mb-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Backup Database</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="card-body card-block">
                            <form action="<?php echo base_url(); ?>cadangkan/backupdb" method="POST" class="form-horizontal" enctype='multipart/form-data'>
                                <div class="form-group">
                                        <div class="input-group">
                                           <label><font color="red">*Silakan tekan tombol backup untuk membackup database anda*</font></label>
                                        </div>
                                </div>
                                <div class="">
                                   <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        <i class="fa fa-cloud-download"></i> BACKUP
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Restore Database</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="card-body card-block">
                            <form action="<?php echo base_url(); ?>cadangkan/restoredb" method="POST" class="form-horizontal" enctype='multipart/form-data'>
                                <div class="form-group">
                                        <div class="input-group">
                                           <label><font color="red">*Silakan tekan choose dan pilih database anda dengan format .sql yang mau direstore setelah itu tekan tombol restore*</font></label>
                                            <div class="input-group">
                                            <div class="col-12 col-md-12"><input type="file" id="file-input" name="datafile" class="form-control" placeholder="database.sql"></div>
                                            </div>
                                        </div>
                                </div>
                                <div class="">
                                   <button type="submit" class="btn btn-warning btn-lg btn-block">
                                        <i class="fa fa-refresh"></i> RESTORE
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
</div>
<!-- /.container-fluid -->
