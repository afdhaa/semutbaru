<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemilu extends CI_Model {

	public function list()
	{
		return $this->db->get('pemilu')->result_array();
	}



}
