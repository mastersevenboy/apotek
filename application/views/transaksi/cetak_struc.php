<!DOCTYPE html>
<html>
<head>
	<title>Struck Pembayaran</title>
	<link href="<?php echo base_url('assets/admin/') ?>css/sb-admin-2.min.css" rel="stylesheet">
	<script src="<?php echo base_url('assets/admin/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
    	.invoice-title h2, .invoice-title h3 {
		    display: inline-block;
		}

		.table > tbody > tr > .no-line {
		    border-top: none;
		}

		.table > thead > tr > .no-line {
		    border-bottom: none;
		}

		.table > tbody > tr > .thick-line {
		    border-top: 2px solid;
		}
    </style>
</head>
<body>

<?php foreach ($trans as $tr):
?>
<div class="container">
	<div class="row">
        <div class="col-xs-7">
    		<div class="invoice-title">
    			<br>
                ==================================================
                <?php foreach ($profil as $row): ?>
                   <center><h1 class="panel-title"><?php echo $row->nama_tk ?></h1>
                    <p>Alamat : <?php echo $row->alamat_tk ?></p>
                    <p>No_hp : <?php echo $row->no_hp ?></p>
                </center> 
                <?php endforeach ?>
                ==================================================
    		</div>

            <center><p>Nofaktur :<?php echo $tr->id ?></p></center>
    		<div class="row">
    			<div class="col-md-6">
    				<address>
    				<strong>Telah Diterima Dari</strong><br>
    					Nama : <?php echo $tr->nama_pembeli ?><br>
    				</address>
    			</div>
    			<div class="col-md-6 text-right">
    				<address>
    					<strong>Tanggal Bayar</strong><br>
    					<?php echo $tr->tgl ?><br><br> 
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-7">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h4 class="panel-title"><strong>Rincian Pembayaran</strong></h4>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
						<thead>
						<tr>
							<td class="text-right">No</td>
							<th class="text-right">Kd_Ob</th>
							<th class="text-right">QTY</th>
                            <th class="text-right">Harga</th>
							<th class="text-right">Total</th>
						</tr>
						</thead>
                        <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($detail as $row):
                            $total = $row->jumlah*$row->harga;
                        ?>
						<tr>
                            <td class="text-right"><?php echo $no++; ?></td>
							<td class="text-right"><?php echo $row->kode_obat ?></td>
							<td class="text-right"><?php echo $row->jumlah ?></td>
                            <td class="text-right"><?php echo 'Rp '.number_format($row->harga,0,',','.') ?></td>
                            <td class="text-right"><?php echo 'Rp '.number_format($total,0,',','.') ?></td>
						</tr>
                        <?php endforeach ?>
						</tbody>
						<tfoot>
                            <tr>
                                <th colspan="4">Total Bayar</th>
                                <th style="text-align: right;"><?php echo 'Rp '.number_format($tr->transaksi_total,0,',','.') ?></th>
                            </tr>
                            <tr>
                                <th colspan="4">Jumlah Uang</th>
                                <th style="text-align: right;"><?php echo 'Rp '.number_format($tr->jumlah_uang,0,',','.') ?></th>
                            </tr>
                            <tr>
                                <th colspan="4">Uang Kembalian</th>
                                <th style="text-align: right;"><?php echo 'Rp '.number_format($tr->transaksi_kembalian,0,',','.') ?></th>
                            </tr>
						</tfoot>
                        
    					</table>
    					
    				</div>
    			</div>
    		</div>
            <br>
            <p class="text-right"><center>Pembayaran Berhasil</center></p>
            <p class="text-right"><center>*TERIMA KASIH*</center></p>
            <p class="text-right"><center><?php echo $this->session->userdata('nama') ?></center></p>
    	</div>
    </div>
</div>
<?php endforeach ?>

<script>
    window.print();
</script>
</body>
</html>


