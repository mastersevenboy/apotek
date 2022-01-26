<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->library('upload');
		$this->load->library('image_lib');
    }

	public function index()
	{
		$data['profil'] = $this->Dashboard_model->get_profil();
		$this->layout->set_title('Profil Toko');
		return $this->layout->load('template','profil/profil_toko',$data);
	}

	public function ubah($id)
	{
		$nama_tk = $this->input->post('nm_tk');	
		$alamat_tk = $this->input->post('alamat_tk');	
		$no_hp = $this->input->post('no_hp');
		$foto_lama = $this->input->post('filelama');
		$created_at = date('Ymd_His');

		if (!empty($_FILES['input_gambar']['name'])) {
			@unlink('./assets/img/'.$foto_lama);
		}

		$kondisi = array('id_profil' => $id );

		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']	= '2048';
		$config['file_name'] = $created_at.'.png';

		$logo = array(
			'logo'  => $config['file_name']
		);

		$this->upload->initialize($config);

		if (!empty($_FILES['input_gambar']['name'])) {
			@unlink('./assets/img/'.$foto_lama);
	            
			$this->upload->do_upload('input_gambar');

			$data = array(
				'nama_tk' => $nama_tk,
				'no_hp' => $no_hp,
				'alamat_tk' => $alamat_tk,
				'logo'  => $config['file_name'],
			);

			$path = './assets/img/'.$created_at.'.png';

						
			$upload_data = $this->upload->data();
			$upload_img_data = getimagesize($upload_data['full_path']);
	        $water_mark = "";
	        $configrez['image_library'] = 'gd2';
	        $configrez['source_image'] = $path;
	        $configrez['create_thumb'] = FALSE;
	        $configrez['maintain_ratio'] = FALSE;
	        
	        if ($upload_img_data[0] > $upload_img_data[1]) {
	            
	            $configrez['width'] = $upload_img_data[1];
	            $configrez['height'] = $upload_img_data[1];
	            $configrez['x_axis'] = ($upload_img_data[0] - $upload_img_data[1]) / 2;
	            $configrez['y_axis'] = 0;
	            $water_mark = $upload_img_data[1];
	            
	        } else {
	            
	            $configrez['width'] = $upload_img_data[0];
	            $configrez['height'] = $upload_img_data[0];
	            $configrez['x_axis'] = 0;
	            $configrez['y_axis'] = ($upload_img_data[1] - $upload_img_data[0]) / 2;
	            $water_mark = $upload_img_data[0];
	            
	        }

	        $this->image_lib->initialize($configrez);
	        // $this->image_lib->crop();

	        $configrez2['image_library'] = 'gd2';
	        $configrez2['source_image'] = $path;
	        $configrez2['create_thumb'] = FALSE;
	        $configrez2['maintain_ratio'] = FALSE;
	        $configrez2['width'] = "520";
	        $configrez2['height'] = "640";
	        $this->image_lib->initialize($configrez2);
	        $this->image_lib->resize();


			$sukses = $this->Dashboard_model->update($data,$kondisi);
			if ($sukses) {
				$this->Dashboard_model->notifupdate();
				redirect('Profil','refresh');
			}else{
				$this->Dashboard_model->notifgagalupdate();
				redirect('Profil','refresh');
			}

		}else {
			$data = array(
				'nama_tk' => $nama_tk,
				'no_hp' => $no_hp,
				'alamat_tk' => $alamat_tk,
			);
			$this->Dashboard_model->update($data,$kondisi);
			$this->Dashboard_model->notifupdate();
			redirect('Profil','refresh');
		}
	}

}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */