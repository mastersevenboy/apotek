<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian_model extends CI_Model {

	public function getall()
	{
		$queri = $this->db->query("SELECT id_pembelian,tgl,admin_id,total,nama_obat,jumlah,produsen,harga_beli,id_supplier,nama,nama_sp,id_admin FROM pembelian join detail_pembelian on id_pembelian=id_pem join admin on id_admin=admin_id join supplier on id_supplier=id_sp");
		return $queri->result();
	}

	public function create($data)
    {
        $this->db->insert('pembelian', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function create_detail($data)
    {
        $this->db->insert('detail_pembelian', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function admin()
    {
        $queri = $this->db->query("SELECT * FROM admin limit 1");
        return $queri->result();
    }

}

/* End of file Pembelian_model.php */
/* Location: ./application/models/Pembelian_model.php */