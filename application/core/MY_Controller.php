<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    public function view($view,$data=array())
  	{
  		//print_r($this->session->userdata());die();
      $nama =$this->session->userdata('username');
  		if ($nama!=""||$nama!==null) {
  			$this->load->view('core/core/header');
  			$this->load->view($view,$data);
  			$this->load->view('core/core/footer');
  		}
  		else {
  			redirect ('login');
  		}
  	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
