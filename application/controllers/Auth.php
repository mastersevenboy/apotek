<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }

    public function login()
	{
        if ($this->session->userdata('logged_in')) return redirect('dashboard');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required');
        if ($this->form_validation->run() == TRUE) 
        {
            $this->check_login();
        }
        $data['profil'] = $this->Dashboard_model->get_profil();
        $this->load->view('auth/login',$data);
    }
    
    private function check_login()
    {
        $this->load->model('auth_model');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $check_login = $this->auth_model->check_login($username, $password);
        if (! $check_login) {
            $this->session->set_flashdata('info', 'Username atau kata sandi salah');
            redirect('auth/login');
        }
        $dataLogin = [
            'logged_in' => true,
            'user_id' => $check_login->id,
            'username' => $check_login->username,
            'nama' => $check_login->nama,
        ];
        $this->session->set_userdata($dataLogin);
        redirect('dashboard');
    }

    public function logout()
    {
        $dataLogin = ['logged_in', 'user_id', 'username', 'nama'];
        $this->session->unset_userdata($dataLogin);
        redirect('auth/login');
    }
}
