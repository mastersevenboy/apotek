<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Supplier_model');
        $this->load->model('Dashboard_model');
    }

    public function index()
	{
	    //set rulues form
        $this->form_validation->set_rules('nama_sp', 'Nama Supplier', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim');
        if ($this->form_validation->run() == FALSE)
        {
            $data['profil'] = $this->Dashboard_model->get_profil();
            $data['supplier'] = $this->Supplier_model->get_all();
            $this->layout->set_title('Data Supplier');
		    $this->layout->load('template', 'supplier/index', $data);
        }
        else
        {
            $data_supplier = [
                'nama' => $this->input->post('nama_sp'),
                'alamat' => $this->input->post('alamat'),
                'kota' => $this->input->post('kota'),
                'telp' => $this->input->post('telp'),
            ];
            $tambah = $this->Supplier_model->create($data_supplier);
            $msg = $tambah ? 'Berhasil ditambah' : 'Gagal ditambah';
            $this->session->set_flashdata('info', $msg);
            redirect('supplier');
        }
    }
    
    public function hapus($id = null)
    {
        if (! $id) return show_404();
        $this->db->delete('supplier', ['id_sp' => $id]);
        $this->session->set_flashdata('info', 'Berhasil dihapus');
        redirect('supplier');
    }

    public function getAjax($id_sp = null)
    {
        $supplier = $this->db->get_where('supplier', ['id_sp' => $id_sp]);
        $supplier = json_encode($supplier->row());
        echo $supplier;
    }

    public function ubah()
    {
        $this->form_validation->set_rules('nama_sp', 'Nama Supplier', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim');
        if ($this->form_validation->run() == FALSE) 
        {
            redirect('supplier');
        } 
        else
        {
            $data_supplier = [
                'nama_sp' => $this->input->post('nama_sp'),
                'alamat' => $this->input->post('alamat'),
                'kota' => $this->input->post('kota'),
                'telp' => $this->input->post('telp'),
            ];
            $id_sp= $this->input->post('id_sp');
            $ubah = $this->Supplier_model->update($data_supplier, $id_sp);
            $msg = $ubah ? 'Berhasil diubah' : 'Gagal diubah';
            $this->session->set_flashdata('info', $msg);
            redirect('supplier');
        }
    }
}
