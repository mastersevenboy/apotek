<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    public function get_all()       
    {
        $this->db->select('a.*, b.nama AS admin')
        ->from('transaksi a')
        ->join('admin b', 'a.admin_id = b.id_admin');
        $this->db->order_by('tgl', 'desc');
        $this->db->limit(5);
        return $this->db->get();

    }

    public function get_obat($transaksi_id)
    {
        $this->db->select('b.kode, b.nama_obat, a.jumlah')
        ->from('detail_transaksi a')
        ->join('obat b', 'a.kode_obat = b.kode')
        ->where('transaksi_id', $transaksi_id);
        return $this->db->get();
    }

    public function create($data)
    {
        $this->db->insert('transaksi', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function create_detail($data)
    {
        $this->db->insert_batch('detail_transaksi', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function getByKode($kode)
    {
        return $this->db->get_where('transaksi', ['kode' => $kode])->row();
    }

    public function update($data, $kode)
    {
        $this->db->update('transaksi', $data, ['kode' => $kode]);
        return $this->db->affected_rows() > 0 ? true : false;
    }
    
    // public function all($id)
    // {
    //     $queri = $this->db->query("SELECT id,tgl,nama_pembeli,admin_id,transaksi_total,jumlah_uang,transaksi_kembalian,kode_obat,jumlah,harga,transaksi_id FROM detail_transaksi join transaksi on id=transaksi_id join obat on kode_obat=kode where transaksi_id='$id'");
    //     return $queri->result();
    // }

    public function all2($id)
    {
        $queri = $this->db->query("SELECT * FROM detail_transaksi d join transaksi t on t.id=d.transaksi_id join obat o on d.kode_obat=o.kode where id='$id'");
        return $queri->result();
    }

    public function trans($id)
    {
        $queri = $this->db->query("SELECT * FROM transaksi t join detail_transaksi d on t.id=d.transaksi_id where id='$id' limit 1");
        return $queri->result();
    }

    public function detail($id)
    {
        $queri = $this->db->query("SELECT * FROM detail_transaksi d join obat o on d.kode_obat=o.kode where transaksi_id='$id'");
        return $queri->result();
    }

}
