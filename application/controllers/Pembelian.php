<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        $this->load->model('Pembelian_model');
        $this->load->model('Dashboard_model');
    }

	public function index()
	{		// $this->load->model('Pembelian_model');
        $data['profil'] = $this->Dashboard_model->get_profil();
		$data['pembelian'] = $this->Pembelian_model->getall();
		$this->layout->set_title('Data Pembelian');
		return $this->layout->load('template','pembelian/index',$data);
	}

	public function tambah()
	{
		$this->load->model('Supplier_model');
            $supplier = $this->Supplier_model->get_all();
            foreach ($supplier->result() as $sup) 
            {
                $option_supplier[$sup->id_sp] = $sup->nama_sp;
            }
            $data['supplier'] = $option_supplier;

        // $this->load->model('Admin_model');            
        // $data['Admin'] =  $this->Admin_model->get_all();
        $data['profil'] = $this->Dashboard_model->get_profil();
        $data['pembelian'] = $this->Pembelian_model->getall();
		$data['Admin'] = $this->Pembelian_model->admin();
		$this->layout->set_title('Data Pembelian');
		return $this->layout->load('template' ,'pembelian/tambah' , $data);
	}

	public function add()
	{
	
        $data_transaksi = [
            'tgl' => date('Y-m-d h:i:s'),
            'total' => $this->input->post('total'),
            'admin_id' => $this->input->post('id_admin'),
        ];

        $tambah = $this->Pembelian_model->create($data_transaksi);
        $transaksi_id = $this->db->insert_id();

        
        $detail_transaksi = [
                'id_pem' => $transaksi_id,
                'nama_obat' => $this->input->post('nama_obat'),
                'jumlah' => $this->input->post('jumlah'),
                'id_supplier' => $this->input->post('supplier'),
                'produsen' => $this->input->post('produsen'),
                'harga_beli' => $this->input->post('harga'),
        ];
        
        $this->Pembelian_model->create_detail($detail_transaksi);
        $msg = $tambah ? 'Berhasil ditambah' : 'Gagal ditambah';
        $this->session->set_flashdata('info', $msg);
        redirect('pembelian');
	}

	public function hapus($id_pembelian = null)
    {
        if (! $id_pembelian) return show_404();
        $this->db->delete('pembelian', ['id_pembelian' => $id_pembelian]);
        $this->session->set_flashdata('info', 'Berhasil dihapus');
        redirect('pembelian');
    }

}

/* End of file Pembelian.php */
/* Location: ./application/controllers/Pembelian.php */