<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data Laporan Pembelian</h1>
    </div>
    <div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">List Laporan</h6>
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
                            <th>No.</th>
							<th>Laporan Penjualan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
                        <tr>
                            <td>1</td>
                            <td>Laporan Data Barang</td>
                            <td>
                                <a href="<?php echo base_url().'laporan/lap_data_barang'?>" class="btn btn-primary btn-sm"><i class="fa fa-print"> Print</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Laporan Penjualan Harian</td>
                            <td>
                                <a href="#lap_jual_pertanggal" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-print"> Print</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Laporan Penjualan Mingguan</td>
                            <td>
                                <a href="#lap_jual_minggu" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-print"> Print</i></a>
                            </td>
                        </tr>
						<tr>
                            <td>4</td>
							<td>Laporan Penjualan Bulanan</td>
							<td>
								<a href="#lap_jual_perbulan"  data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-print"> Print</i></a>
							</td>
						</tr>
                        <tr>
                            <td>5</td>
                            <td>Laporan Penjualan Tahunan</td>
                            <td>
                                <a href="#lap_jual_pertahun" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-print"> Print</i></a>
                            </td>
                        </tr>
					</tbody>
				</table>
			</div>
		</div>
    </div>
    </div>
</div>

<!-- Modal Laporan -->

<div class="modal fade" id="lap_jual_pertanggal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'laporan/lap_penjualan_pertanggal'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal</label>
                        <div class="col-xs-9">
                            <div class='input-group'>
                                <input type='date' name="tgl" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
        
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="lap_jual_perbulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'laporan/lap_penjualan_perbulan'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                                <label></label>
                                <select class="form-control" name="bulan" id="bulan">
                                    <option value="">Pilih Bulan</option>
                                    <?php
                                    foreach ($arrbulan as $key => $value) {
                                        ?>
                                        <option value="<?php echo $key ?>" <?php if ($key==date('m')) ?>><?php echo $value ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label></label>
                                <select class="form-control" name="tahun" id="tahun">
                                    <option value="">Pilih Tahun</option>
                                    <?php
                                    for ($i=2017; $i<=@$tahun+5 ; $i++) { 
                                        ?>
                                        <option value="<?php echo $i ?>" <?php if ($i==@$tahun) ?>><?php echo $i ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
        
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="lap_jual_pertahun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel">Pilih Tahun</h3><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'laporan/lap_penjualan_pertahun'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Tahun</label>
                        <select class="form-control" name="tahun" id="tahun">
                            <option value="">Pilih Tahun</option>
                            <?php
                                for ($i=2017; $i<=@$tahun+5 ; $i++) { 
                                ?>
                            <option value="<?php echo $i ?>" <?php if ($i==@$tahun) ?>><?php echo $i ?>
                            </option>
                                <?php
                                }
                                ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="lap_jual_minggu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Minggu</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'laporan/lap_penjualan_perminggu'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Minggu</label>
                        <div class="col-xs-10">
                                <select name="mgg" id="mgg" class="form-control" data-live-search="true" title="Pilih Minggu" required/>
                                <?php foreach ($jual_minggu->result_array() as $k) {
                                    $mgg=$k['minggu'];
                                ?>
                                    <option><?php echo $mgg;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
        </div>
</div>


<!-- End Modal Laporan -->

