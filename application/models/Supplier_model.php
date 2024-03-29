<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    public function get_all()       
    {
        $result = $this->db->get('supplier');
        return $result;
    }

    public function create($data)
    {
        $this->db->insert('supplier', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function update($data, $id_sp)
    {
        $this->db->update('supplier', $data, ['id_sp' => $id_sp]);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    
}
