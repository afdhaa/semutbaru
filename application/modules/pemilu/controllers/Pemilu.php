<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemilu extends MY_Controller {

	function __construct() {
			parent::__construct();
			$this->load->model('M_pemilu');
	}

	public function index()
	{
		$data['pemilu']=$this->M_pemilu->list();
		parent::view('pemilu',$data);
	}

	public function list()
	{
		$data['pemilu']=$this->M_pemilu->list();
		$no=1;

		foreach ($data['pemilu'] as $row => $value) {
			//$id=$value['id'];
			$delete='<input class="filled-in" type="checkbox"  class="deleteRow" value="'.$row['id'].'"/>';
			$action= '
			<div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu">
				<li><a type="button" data-toggle="modal" onclick="editPemilu('.$value['id'].')"> <span class="glyphicon glyphicon-edit"></span> Edit</a></li>
			 <li><a type="button" data-toggle="modal"  onclick="getdelete('.$value['id'].')"> <span class="glyphicon glyphicon-trash"></span> Remove</a></li>
				</ul>
			</div>
			';
			$output['data'][] = array(
				//$delete,
				$no++,
				$value['pemilu'],
				$value['tanggal'],
				$value['follower_min_twitter'],
				$value['create_account_min'],
				$action
			);
		}

		$balik = json_encode($output);
		echo $balik;

	}

	public function input(){
		$validator = array('success' => false, 'messages' => array());

		$pemilu=$this->input->post('pemilu');
		$tanggal=	$this->input->post('aktif');
		$follower_min_twitter=$this->input->post('folower_min');
		$create_account_min=$this->input->post('akun_min');
		$data = array(
			'pemilu' => $pemilu,
		 	'tanggal' => $tanggal,
			'follower_min_twitter' => $follower_min_twitter,
			'create_account_min' => $create_account_min);
		if ($pemilu&&$tanggal&&$create_account_min) {
			$this->db->insert('pemilu',$data);
			$validator['success'] = true;
			$validator['messages'] = "Sukses ditambahkan";
		}
		else {
			$validator['success'] = false;
			$validator['messages'] = "Mohon dilengkapi";
		}

		echo json_encode($validator);
	}

	public function edit($id)
	{
		//print_r($this->db->where("id",715)->get("pemilu")->row());
		echo json_encode($this->db->where("id",$id)->get("pemilu")->row());
	}

	public function update()
	{
		$id=$this->input->post('id');
		$pemilu=$this->input->post('pemilu');
		$tanggal=	$this->input->post('aktif');
		$follower_min_twitter=$this->input->post('folower_min');
		$create_account_min=$this->input->post('akun_min');
		$data = array(
			'pemilu' => $pemilu,
		 	'tanggal' => $tanggal,
			'follower_min_twitter' => $follower_min_twitter,
			'create_account_min' => $create_account_min);
		if ($pemilu&&$tanggal&&$create_account_min) {
			$this->db->update('pemilu',$data);
			$validator['success'] = true;
			$validator['messages'] = "Sukses edit";
		}
		else {
			$validator['success'] = false;
			$validator['messages'] = "Mohon dilengkapi";
		}

		echo json_encode($validator);
	}

	public function delete(){
		$id=$this->input->post('id');
		$validator = array('success' => false, 'messages' => array());
		$this->db->delete('pemilu', array('id' => $id));
		$validator['success'] = true;
		$validator['messages'] = "Sukses Hapus data";

		echo json_encode($validator);

	}
}
