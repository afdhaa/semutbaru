<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	function __construct() {
			parent::__construct();
			$this->load->model('login/M_login');
	}

	public function index()
	{
		$this->load->view('core/header');
		$this->load->view('login');
		$this->load->view('core/footer');
	}

	public function proses()
	{
		$username=$this->security->xss_clean($this->input->post('username'));
		$password=$this->security->xss_clean(md5($this->input->post('password')));
		//echo $password;die();
		$cek=$this->M_login->cek($username,$password);
		$newuser = array(
	        'username'  => $cek[0]['username'],
	        'role'     => $cek[0]['role']
		);

		$data=$this->session->set_userdata($newuser);
		if ($cek) {
			redirect('home');
		}
		else {
			$this->session->set_flashdata('error', 'Username atau password salah');
			redirect('login');
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
