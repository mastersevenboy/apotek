<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
<?php foreach ($profil as $row): ?>
	<title><?php echo $row->nama_tk ?> |   <?php $this->layout->get_title(); ?></title>


	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url('assets/admin/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
		type="text/css">
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url('assets/admin/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

	<!-- Datatables -->
	<link href="<?php echo base_url('assets/admin/');?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link rel="shortcut icon" href="<?php echo base_url('assets/img/') . $row->logo; ?>" type="image/x-icon">
<?php endforeach ?>
	<?php $this->layout->get_css(); ?>
</head>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	
