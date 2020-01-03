<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Welcome_model');
	}
	public function index(){
		if($this->session->userdata('login_status')==1){
			$data['saklar'] = $this->Welcome_model->getAll();
			$this->load->view('welcome',$data);
		}
		else{
			$this->load->view('formLogin');
		}
	}

	function Kontrol($id,$value){
		$kontrol = $this->Welcome_model->kontrol($id,$value);
		if($kontrol){
			Redirect("/Welcome");
		}
		else{
			Redirect("/Welcome");
		}
	}

	function Saklar(){
		if($this->session->userdata('login_status')==1){
			$data['saklar'] = $this->Welcome_model->getAll();
			$this->load->view('formSaklar',$data);
		}
		else{
			$this->load->view('formLogin');
		}
	}

	function Rename(){
		if(isset($_POST['rename'])){
			$id = $this->input->post('id');
			$name = $this->input->post('saklarName');
			if($this->Welcome_model->ubahNama($id,$name)){
				$this->session->set_flashdata(array('class'=>'success','alert'=>'Berhasil','value'=>'Nama Saklar telah dirubah'));
				Redirect("/Welcome/Saklar");
			}
			else{
				$this->session->set_flashdata(array('class'=>'warning','alert'=>'Gagal','value'=>'Gagal Merubah Nama Saklar'));
				Redirect("/Welcome/Saklar");
			}

		}
		else{
			Redirect("/Welcome/Saklar");
		}
	}

	function GetData($id){
		if($id == NULL){

		}else{
			echo $this->Welcome_model->getOne($id);
		}
	}

	function GetLast(){
		echo json_encode(array("result"=>$this->Welcome_model->getLast()));
	}


	function SendData($value){
		$data = array('data_suhu'=>$value);
		$this->db->insert('suhu',$data);
	}
}
