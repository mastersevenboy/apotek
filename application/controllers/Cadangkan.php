<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadangkan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
		$this->load->helper('form');
		$this->load->library('session');

		date_default_timezone_set('Asia/Jakarta');
	}

	public function backupdb()
	{
		// Load Clas Utilitas Database
        $this->load->dbutil();
 
        // nyiapin aturan untuk file backup
        $aturan = array(    
                'format'      => 'zip',            
                'filename'    => 'my_db_backup.sql',
                'add_drop' 	  => TRUE,
                'add_insert'  => TRUE,
                'newline' 	  => "\n",
                'foreign_key_checks' => FALSE,
              );
 
 
        $backup =& $this->dbutil->backup($aturan);
 
        $nama_database = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $simpan = 'backupdb'.$nama_database;
 
        // $this->load->helper('file');
        // write_file($simpan, $backup);
 
 
        $this->load->helper('download');
        force_download($nama_database, $backup);

	}

	function restoredb(){
		//hapus dulu database jika proses restore gagal.
		$this->Dashboard_model->droptabel();

		//upload dulu filenya
		$fupload = $_FILES['datafile'];
		$nama = $_FILES['datafile']['name'];

		if(isset($fupload)){
			$lokasi_file = $fupload['tmp_name'];
			$direktori="backupdb/$nama";
			move_uploaded_file($lokasi_file,"$direktori");
		}

		//restore database
		$isi_file=file_get_contents($direktori);
		$string_query=rtrim($isi_file, "\n;" );
		$array_query=explode(";", $string_query);

		foreach($array_query as $query){
		$this->db->query($query);
		}

		unlink($direktori);
		echo "<script>alert('Berhasil Di Restore.');</script>";
		redirect('Dashboard','refresh');
	}

}

/* End of file Cadangkan.php */
/* Location: ./application/controllers/Cadangkan.php */