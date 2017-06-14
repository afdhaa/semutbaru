<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {

	function __construct() {
			parent::__construct();
	}

	public function view($view,$data=array())
	{
		//echo $view;die();
		if (!empty($this->session->userdata())) {
			$this->load->view('core/header');
			$this->load->view($view,$data);
			$this->load->view('core/footer');
		}
		else {
			$this->load->view('login/core/header');
			$this->load->view('login/login');
			$this->load->view('login/core/footer');
		}
	}

}
