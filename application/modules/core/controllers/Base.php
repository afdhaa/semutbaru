<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

  public function view($view,$data=array())
  {
    $this->load->view('core/header');
    $this->load->view($view,$data);
    $this->load->view('core/footer');
  }
}
