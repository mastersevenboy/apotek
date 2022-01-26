<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>laporan data barang</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css')?>"/>
    <link rel="icon" href="<?php echo base_url('assets/img/logo.png') ?>" type="image/png">
    <style type="text/css">
        /* Table */
        body {
            font-family: "lucida Sans Unicode", "Lucida Grande", "Segoe UI", vardana
        }
        .demo-table {
            border-collapse: collapse;
            font-size: 13px;
        }
        .demo-table th, 
        .demo-table td {
            padding: 17px 17px;
        }
        .demo-table .title {
            caption-side: bottom;
            margin-top: 12px;
        }
        .demo-table thead th:last-child,
        .demo-table tfoot th:last-child,
        .demo-table tbody td:last-child {
            border: 1;
        }

        /* Table Header */
        .demo-table thead th {
            border-right: 1px solid #c7ecc7;
            text-transform: uppercase;
        }

        /* Table Body */
        .demo-table tbody td {
            color: #353535;
            border-right: 1px solid #c7ecc7;
        }
        .demo-table tbody tr:nth-child(odd) td {
            background-color: #f4fff7;
        }
        .demo-table tbody tr:nth-child(even) td {
            background-color: #dbffe5;
        }
        .demo-table tbody td:nth-child(4),
        .demo-table tbody td:first-child,
        .demo-table tbody td:last-child {
            text-align: right;
        }
        .demo-table tbody tr:hover td {
            background-color: #ffffa2;
            border-color: #ffff0f;
            transition: all .2s;
        }

        /* Table Footer */
        .demo-table tfoot th {
            border-right: 1px solid #c7ecc7;
        }
        .demo-table tfoot th:first-child {
            text-align: right;
        }
    </style>
</head>
<body onload="window.print()">
<div id="laporan">

<table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
<tr>
    <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>LAPORAN DATA BARANG</h4></center></td>
</tr>
                       
</table>
 
<?php foreach ($profil as $row): ?>
<table border="0" align="center" style="width:700px;border:none;"">
    <thead>
        <tr>
            <th><img src="<?php echo base_url('assets/img/') . $row->logo; ?>" alt="" style="width:100px; height:100px;"></th>
         </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">Alamat : <?php echo $row->alamat_tk ?></td>
        </tr>
        <tr>
            <td align="center">No.Tlp : <?php echo $row->no_hp ?></td>
        </tr>
    </tbody>
</table>
<?php endforeach ?>
<table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">
</table>
<br>
</table>

<center><h3>Tabel Laporan Data Barang</h3></center>
<table class="demo-table" align="center" style="width:900px;margin-bottom:20px;" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <?php $no = 1; ?>
        <?php foreach($data->result() as $o) : ?>
        <tbody>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $o->kode; ?></td>
                <td><?php echo $o->nama_obat; ?></td>
                <td><?php echo $o->stok; ?></td>
                <td><?php echo $o->harga; ?></td>
                <td><?php echo $o->keterangan; ?></td>
            </tr>
        </tbody>
        <?php endforeach ?>
    </table>

<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td align="right">Purbalingga, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="right"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td align="right">( <?php echo $this->session->userdata('nama');?> )</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <th><br/><br/></th>
    </tr>
    <tr>
        <th align="left"></th>
    </tr>
</table>
</div>
</body>
</html>