<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function get_all_count()       
    {
        $obat = $this->db->get('obat')->num_rows();
        $admin = $this->db->get('admin')->num_rows();
        $supplier = $this->db->get('supplier')->num_rows();
        $count = [
            'obat' => $obat,
            'admin' => $admin,
            'supplier' => $supplier,
        ];
        return $count;
    }

    public function get_profil()
    {
        $queri = $this->db->query("SELECT * FROM profil");
        return $queri->result();
    }

    public function update($data,$kondisi)
    {
        $this->db->update('profil',$data,$kondisi);
        return true;
    }

    function notifupdate(){
        $this->session->set_flashdata('message', 
            '<div class="alert bg-green alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Sukses!</strong> Data berhasil diupdate.
            </div>');
    }
    
    function notifgagalupdate(){
        $this->session->set_flashdata('message', 
            '<div class="alert bg-red alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Sukses!</strong> Data tidak berhasil diupdate.
            </div>');
    }

    function droptabel()
    {
        $this->load->dbforge();
        $cek=$this->db->query("SHOW TABLES");

        if ($cek->num_rows()>0) {

            // $query = $this->db->query('DROP TABLE admin, detail_transaksi, detail_pembelian, obat,  pembelian, profil, supplier,transaksi');
            // return $query;

            // catatan hapuslah tabel yang memiliki forgienkey pertama dulu baru sisanya yg tidak
            $query = $this->dbforge->drop_table('detail_transaksi','detail_pembelian','obat','pembelian','transaksi','profil','admin','supplier', TRUE);
            return $query;
        }else{
            return true;
        }    
    }
}
