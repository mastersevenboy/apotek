<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
	        <h1 class="h3 mb-4 text-gray-800">Tambah Pembelian</h1>
	        <div class="card shadow col-lg-6">
	            <div class="col-lg-12">
	                <div class="card shadow mb-4">
	                    <div class="card-body">
	                        <table class="table table-borderless">
	                            <tr>
	                                <th>Admin</th>
	                                <td> : <?php echo($this->session->userdata('nama')); ?></td>
	                            </tr>
	                            <tr>
	                                <th>Tanggal pembelian</th>
	                                <td> : <?php echo date('Y-m-d h:i:s'); ?></td>
	                            </tr>
	                        </table>
	                    </div>
	                </div>
	             </div>
	        </div>
	    </div>
       
        <div class="col-xl-12 col-md-12 mb-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="card shadow mb-4">
                    <div class="card-body">
                    <form action="<?php echo base_url() ?>Pembelian/add" method="post" enctype="multipart/form-data">              
                    <?php if ($this->session->flashdata('info')) : ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('info'); ?>
                    </div>
                    <?php endif; ?>
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?php foreach ($Admin as $row): ?>
                        <input type="hidden" name="id_admin" value="<?php echo $row->id_admin ?>"> 
                    <?php endforeach ?>
                    <div class="form-group">
                        <label for="nama-obat">Nama Obat</label>
                        <input type="text" name="nama_obat" id="nama-obat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga1" onkeyup="sum();"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah1" onkeyup="sum();" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <?php echo form_dropdown('supplier', $supplier, set_value('supplier'), ['class' => 'form-control', 'id_sp' => 'supllier']) ?>
                    </div>
                    <div class="form-group">
                        <label for="produsen">Prodsen</label>
                        <input type="text" name="produsen" id="produsen" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="total">Total Uang</label>
                        <input type="number" name="total" id="total1" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Tambah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
    </div>
</div>
<!-- /.container-fluid -->

    <script>
    function sum() {
          var txtFirstNumberValue = document.getElementById('harga1').value;
          var txtSecondNumberValue = document.getElementById('jumlah1').value;
          var result = parseInt(txtFirstNumberValue) *parseInt(txtSecondNumberValue);
          if (!isNaN(result)) {
             document.getElementById('total1').value = result;
          }
    }
    </script>