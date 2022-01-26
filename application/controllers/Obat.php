<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obat_model');
        $this->load->model('Dashboard_model');
    }

    public function index()
	{
        $data['profil'] = $this->Dashboard_model->get_profil();
        $data['obat'] = $this->Obat_model->get_obat();
        $this->layout->set_title('Data obat');
        return $this->layout->load('template', 'obat/index', $data);
    }
    
    public function tambah()
    {
        $this->form_validation->set_rules('kode_obat', 'Kode Obat', 'required|trim|is_unique[obat.kode]');
        $this->form_validation->set_rules('supplier', 'Supplier', 'required|trim');
        $this->form_validation->set_rules('produsen', 'Produsen', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim|numeric');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model('Supplier_model');
            $supplier = $this->Supplier_model->get_all();
            foreach ($supplier->result() as $sup) 
            {
                $option_supplier[$sup->id_sp] = $sup->nama_sp;
            }
            $data['supplier'] = $option_supplier;
            $data['profil'] = $this->Dashboard_model->get_profil();
            $this->layout->set_title('Tambah data obat');
            return $this->layout->load('template', 'obat/tambah', $data);
        }
        $config = [
            'upload_path' => FCPATH . '/assets/img/',
            'allowed_types' => 'gif|jpg|png',
            'max_size'  => 2000,
            'file_name' => uniqid(date('Y-m-d-h-i-s_')),
        ];
        $this->load->library('upload', $config);
        if (! $this->upload->do_upload('foto')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('info', $error);
            return redirect('obat/tambah');
        }

        $kode     = $this->input->post('kode_obat');
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $image_resource = Zend_Barcode::factory('code128', 'image', array('text'=>$kode), array())->draw();
        $image_name     = $kode.'.jpg';
        $image_dir      = './assets/images/'; // penyimpanan file barcode
        imagejpeg($image_resource, $image_dir.$image_name);

        $data_obat = [
            'kode' => $this->input->post('kode_obat'),
            'supplier_id' => $this->input->post('supplier'),
            'nama_obat' => $this->input->post('nama'),
            'produsen' => $this->input->post('produsen'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'keterangan' => $this->input->post('keterangan'),
            'foto' => $this->upload->data('file_name'),
            'bar_code'      => $image_name
        ];
        $tambah = $this->Obat_model->create($data_obat);
        $msg = $tambah ? 'Berhasil ditambah' : 'Gagal ditambah';
        $this->session->set_flashdata('info', $msg);
        redirect('obat');
    }

    public function hapus($kode = null)
    {
        if (! $kode) return show_404();
        $obat = $this->Obat_model->getByKode($kode);
        $path = FCPATH . 'assets/img/' . $obat->foto;
        if(file_exists($path)) {
            unlink($path);
        }
        $this->db->delete('obat', ['kode' => $kode]);
        $this->session->set_flashdata('info', 'Berhasil dihapus');
        redirect('obat');
    }

    public function ubah($kode = null)
    {
        if (! $kode) return show_404();
        // $this->form_validation->set_rules('kode_obat', 'Kode Obat', 'required|trim|is_unique[obat.kode]');
        $this->form_validation->set_rules('supplier', 'Supplier', 'required|trim');
        $this->form_validation->set_rules('produsen', 'Produsen', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim|numeric');
        if ($this->form_validation->run() == FALSE) 
        {
            $data['obat'] = $this->Obat_model->getByKode($kode);
            $this->load->model('Supplier_model');
            $supplier = $this->Supplier_model->get_all();
            foreach ($supplier->result() as $sup) 
            {
                $option_supplier[$sup->id_sp] = $sup->nama_sp;
            }
            $data['supplier'] = $option_supplier;
            $this->layout->set_title('Ubah data obat');
            return $this->layout->load('template', 'obat/ubah', $data);
        } 
        else
        {
            $data_obat = [
                // 'kode' => $this->input->post('kode_obat'),
                'supplier_id' => $this->input->post('supplier'),
                'nama_obat' => $this->input->post('nama'),
                'produsen' => $this->input->post('produsen'),
                'harga' => $this->input->post('harga'),
                'keterangan' => $this->input->post('keterangan'),
                'stok' => $this->input->post('stok'),
            ];
            if ($_FILES['foto']['error'] !== 4) {
                $config = [
                    'upload_path' => FCPATH . '/assets/img/',
                    'allowed_types' => 'gif|jpg|png',
                    'max_size'  => 2000,
                    'file_name' => uniqid(date('Y-m-d-h-i-s_')),
                ];
                $this->load->library('upload', $config);
                if (! $this->upload->do_upload('foto')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('info', $error);
                    return redirect("obat/ubah/{$kode}");
                }
                $data_obat['foto'] = $this->upload->data('file_name');
                $foto_lama = $this->input->post('foto_lama');
                $path_foto_lama = FCPATH . "/assets/img/{$foto_lama}";
                if (file_exists($path_foto_lama)) unlink($path_foto_lama);
            }
            $ubah = $this->Obat_model->update($data_obat, $kode);
            $msg = $ubah ? 'Berhasil diubah' : 'Gagal diubah';
            $this->session->set_flashdata('info', $msg);
            redirect('obat');
        }
    }

    public function getAjax($kode = null)
    {
        $obat = $this->db->get_where('obat', ['kode' => $kode])->row();
        $obat->foto = base_url('assets/img/') . $obat->foto;
        $obat = json_encode($obat);
        echo $obat;
    }
}
