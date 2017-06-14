<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coba extends MY_Controller {

	public function index()
	{
		parent::view('Greget/welcome_message');
	}
}
