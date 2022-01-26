<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Obat_model');
        $this->load->model('Laporan_model');
        $this->load->model('Dashboard_model');
    }

    public function pembelian()
	{
         $arrbulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
        $data['arrbulan']=$arrbulan;
        $data['tahun']=date('Y');
        $data['profil'] = $this->Dashboard_model->get_profil();
        $this->layout->set_title('Data Laporan');
        return $this->layout->load('template', 'laporan/laporan_pembelian',$data);
    }

    public function lap_pembelian_perbulan()
    {
        $bulan=$this->input->post('bulan');
        $tahun=$this->input->post('tahun');
        $arrbulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember',''=>'');
        //ambil data dari database
        $this->db->select('pembelian.id_pembelian,nama,tgl,admin_id,total,jumlah,nama_obat,harga_beli,produsen,id_supplier,nama_sp,detail_pembelian.id_detail,MONTH(tgl),YEAR(tgl) AS kode');
        $this->db->from('pembelian');
        $this->db->join('detail_pembelian','detail_pembelian.id_pem=pembelian.id_pembelian');
        $this->db->join('admin','admin.id_admin=pembelian.admin_id');
         $this->db->join('supplier','supplier.id_sp=detail_pembelian.id_supplier');
        // $this->db->where('kd_matkul_byr',$jenis);
       
        if ($bulan) {
            $this->db->where('MONTH(tgl)',$bulan);
        }
        if ($tahun) {
            $this->db->where('YEAR(tgl)',$tahun);
        }
       
        $this->db->order_by('pembelian.tgl','ASC');
        $query=$this->db->get();
        $databayar=$query->result();
        $data['data']=$databayar;
        $data['periode']=strtoupper($arrbulan[$bulan]).' '.$tahun;
        $data['jml']=$this->Laporan_model->jumlah_pb($bulan);
        $data['profil'] = $this->Dashboard_model->get_profil();
        $this->load->view('laporan/v_lap_pembelian_bulan',$data);
    }

     public function lap_pembelian_pertahun()
    {
        // $bulan=$this->input->post('bulan');
        $tahun=$this->input->post('tahun');
        $arrbulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember',''=>'');
        //ambil data dari database
        $this->db->select('pembelian.id_pembelian,nama,tgl,admin_id,total,jumlah,nama_obat,harga_beli,produsen,id_supplier,nama_sp,detail_pembelian.id_detail,MONTH(tgl),YEAR(tgl) AS kode');
        $this->db->from('pembelian');
        $this->db->join('detail_pembelian','detail_pembelian.id_pem=pembelian.id_pembelian');
        $this->db->join('admin','admin.id_admin=pembelian.admin_id');
         $this->db->join('supplier','supplier.id_sp=detail_pembelian.id_supplier');
        // $this->db->where('kd_matkul_byr',$jenis);
       
        // if ($bulan) {
        //     $this->db->where('MONTH(tgl)',$bulan);
        // }
        if ($tahun) {
            $this->db->where('YEAR(tgl)',$tahun);
        }
       
        $this->db->order_by('pembelian.tgl','ASC');
        $query=$this->db->get();
        $databayar=$query->result();
        $data['data']=$databayar;
        $data['periode']=$tahun;
        $data['jml']=$this->Laporan_model->jumlah_pt($tahun);
        $data['profil'] = $this->Dashboard_model->get_profil();
        $this->load->view('laporan/v_lap_pembelian_tahun',$data);
    }

    public function penjualan()
	{
        $arrbulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
        $data['arrbulan']=$arrbulan;
        $data['tahun']=date('Y');
        $data['jual_minggu']=$this->Laporan_model->get_minggu_jual();
        $this->layout->set_title('Data Laporan');
        $data['profil'] = $this->Dashboard_model->get_profil();
        return $this->layout->load('template', 'laporan/laporan_penjualan',$data);
    }

    public function lap_data_barang()
    {
        $data['profil'] = $this->Dashboard_model->get_profil();
        $data['data']=$this->Obat_model->get_all();
        $this->load->view('laporan/v_lap_barang',$data);
    }

    public function lap_penjualan_pertanggal()
    {
        $tanggal=$this->input->post('tgl');
        $data['profil'] = $this->Dashboard_model->get_profil();
        $data['data']=$this->Laporan_model->get_dt_pen_hari($tanggal);
        $data['obat']=$this->Laporan_model->detail($tanggal);
        $data['jml']=$this->Laporan_model->jumlah_h($tanggal);
        $this->load->view('laporan/v_lap_pertanggal',$data);
    }

    function lap_penjualan_perminggu(){
        $minggu=$this->input->post('mgg');
        $data['profil'] = $this->Dashboard_model->get_profil();
        $data['jml']=$this->Laporan_model->jumlah_total($minggu);
        $data['obat']=$this->Laporan_model->detail1($minggu);
        $data['data']=$this->Laporan_model->get_minggu_jual2($minggu);
        $this->load->view('laporan/v_lap_mingguan',$data);
    }

    public function lap_penjualan_perbulan()
    {
        $bulan=$this->input->post('bulan');
        $tahun=$this->input->post('tahun');
        $arrbulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember',''=>'');
        //ambil data dari database
        $this->db->select('transaksi.id,nama,nama_pembeli,tgl,admin_id,jumlah_uang,kode_obat,jumlah,harga,detail_transaksi.id_dtl,MONTH(tgl),YEAR(tgl) AS kode');
        $this->db->from('transaksi');
        $this->db->join('detail_transaksi','detail_transaksi.transaksi_id=transaksi.id');
        $this->db->join('admin','admin.id_admin=transaksi.admin_id');
         $this->db->join('obat','obat.kode=detail_transaksi.kode_obat');
        // $this->db->where('kd_matkul_byr',$jenis);
       
        if ($bulan) {
            $this->db->where('MONTH(tgl)',$bulan);
        }
        if ($tahun) {
            $this->db->where('YEAR(tgl)',$tahun);
        }
       
        $this->db->order_by('transaksi.tgl','ASC');
        $query=$this->db->get();
        $databayar=$query->result();
        $data['data']=$databayar;
        $data['periode']=strtoupper($arrbulan[$bulan]).' '.$tahun;
        $data['jml']=$this->Laporan_model->jumlah_b($bulan);
        $data['profil'] = $this->Dashboard_model->get_profil();
        $this->load->view('laporan/v_lap_bulan',$data);
    }

    public function lap_penjualan_pertahun()
    {
        // $bulan=$this->input->post('bulan');
        $tahun=$this->input->post('tahun');
        // $arrbulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember',''=>'');
        //ambil data dari database
        $this->db->select('transaksi.id,nama,nama_pembeli,tgl,admin_id,jumlah_uang,kode_obat,jumlah,harga,detail_transaksi.id_dtl,MONTH(tgl),YEAR(tgl) AS kode');
        $this->db->from('transaksi');
        $this->db->join('detail_transaksi','detail_transaksi.transaksi_id=transaksi.id');
        $this->db->join('admin','admin.id_admin=transaksi.admin_id');
         $this->db->join('obat','obat.kode=detail_transaksi.kode_obat');
        // $this->db->where('kd_matkul_byr',$jenis);
       
        // if ($bulan) {
        //     $this->db->where('MONTH(tgl)',$bulan);
        // }
        if ($tahun) {
            $this->db->where('YEAR(tgl)',$tahun);
        }
       
        $this->db->order_by('transaksi.tgl','ASC');
        $query=$this->db->get();
        $databayar=$query->result();
        $data['data']=$databayar;
        $data['periode']=$tahun;
        $data['jml']=$this->Laporan_model->jumlah_t($tahun);
        $data['profil'] = $this->Dashboard_model->get_profil();
        $this->load->view('laporan/v_lap_tahun',$data);
    }


}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */