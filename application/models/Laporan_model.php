<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

	public function get_dt_pen_hari($tanggal)
	{
		$hsl=$this->db->query("SELECT id,DATE_FORMAT(tgl,'%d %M %Y') AS tgl, nama_pembeli, admin_id, transaksi_total, jumlah_uang, transaksi_kembalian,kode_obat,nama,jumlah,harga FROM transaksi JOIN detail_transaksi ON id=transaksi_id join admin on id_admin=admin_id join obat on kode_obat=kode WHERE DATE(tgl)='$tanggal' ORDER BY id ASC");
		return $hsl;
	}

	public function detail($tanggal)
	{
		$hsl=$this->db->query("SELECT id,DATE_FORMAT(tgl,'%d %M %Y') AS tgl FROM transaksi JOIN detail_transaksi ON id=transaksi_id WHERE DATE(tgl)='$tanggal' ORDER BY id ASC limit 1");
		return $hsl;
	}

	public function jumlah_h($tanggal)
	{
		$hsl=$this->db->query("SELECT DATE_FORMAT(tgl,'%d %M %Y') AS tgl,sum(transaksi_total) AS total FROM transaksi WHERE DATE(tgl)='$tanggal' ORDER by id ASC");
		return $hsl;
	}

	public function get_minggu_jual(){
		$hsl=$this->db->query("SELECT DISTINCT YEARWEEK(tgl) AS minggu FROM transaksi ");
		return $hsl;
	}

	public function get_minggu_jual2($minggu){
		$hsl=$this->db->query("SELECT id,YEARWEEK(tgl) AS minggu,nama_pembeli, admin_id, transaksi_total, jumlah_uang, transaksi_kembalian,kode_obat,nama,jumlah,harga FROM transaksi JOIN detail_transaksi ON id=transaksi_id join admin on id_admin=admin_id join obat on kode_obat=kode WHERE YEARWEEK(tgl)='$minggu' ORDER BY id");
		return $hsl->result();
	}

	public function detail1($minggu)
	{
		$hsl=$this->db->query("SELECT id,YEARWEEK(tgl) AS minggu FROM transaksi JOIN detail_transaksi ON id=transaksi_id WHERE YEARWEEK(tgl)='$minggu' ORDER BY id limit 1");
		return $hsl;
	}

	public function jumlah_total($minggu)
	{
		$hsl=$this->db->query("SELECT YEARWEEK(tgl) AS tgl,sum(transaksi_total) AS subtotal FROM transaksi WHERE YEARWEEK(tgl)='$minggu' ORDER by id ASC");
		return $hsl;
	}

	public function get_dt_pen_bln($bulan)
	{
		$hsl=$this->db->query("SELECT id,DATE_FORMAT
			(tgl, '%m %y') AS tgl, nama_pembeli, admin_id, transaksi_total, jumlah_uang, transaksi_kembalian,kode_obat,nama,jumlah,harga FROM transaksi JOIN detail_transaksi ON id=transaksi_id join admin on id_admin=admin_id join obat on kode_obat=kode WHERE Month(tgl)='$bulan' ORDER BY id ASC");
		return $hsl;
	}

	public function detail_m($bulan)
	{
		$hsl=$this->db->query("SELECT id,MONTH(tgl, '%m %y') AS tgl FROM transaksi JOIN detail_transaksi ON id=transaksi_id WHERE Month(tgl,'%M %Y')='$bulan' ORDER BY id ASC limit 1");
		return $hsl;
	}

	public function jumlah_b($bulan)
	{
		$hsl=$this->db->query("SELECT DATE_FORMAT(tgl,'%d %M %Y') AS tgl,sum(transaksi_total) AS subtotal FROM transaksi WHERE MONTH(tgl)='$bulan' ORDER by id ASC");
		return $hsl;
	}

	public function jumlah_pb($bulan)
	{
		$hsl=$this->db->query("SELECT DATE_FORMAT(tgl,'%d %M %Y') AS tgl,sum(total) AS subtotal FROM pembelian WHERE MONTH(tgl)='$bulan' ORDER by id_pembelian ASC");
		return $hsl;
	}

	public function jumlah_pt($tahun)
	{
		$hsl=$this->db->query("SELECT DATE_FORMAT(tgl,'%d %M %Y') AS tgl,sum(total) AS subtotal FROM pembelian WHERE YEAR(tgl)='$tahun' ORDER by id_pembelian ASC");
		return $hsl;
	}

	public function jumlah_t($tahun)
	{
		$hsl=$this->db->query("SELECT DATE_FORMAT(tgl,'%d %M %Y') AS tgl,sum(transaksi_total) AS subtotal FROM transaksi WHERE YEAR(tgl)='$tahun' ORDER by id ASC");
		return $hsl;
	}
}

/* End of file Laporan_model.php */
/* Location: ./application/models/Laporan_model.php */