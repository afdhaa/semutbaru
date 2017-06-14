<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core extends MY_Controller {

	public function index()
	{
		parent::view('welcome_message');
	}
}
