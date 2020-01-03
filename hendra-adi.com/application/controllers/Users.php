<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
	}
	public function index(){
		if($this->session->userdata('login_status')==1){
			$this->load->view('formUsers');
		}
		else{
			$this->load->view('formLogin');
		}
	}

	function Login(){
		if(isset($_POST['login'])){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($this->Users_model->Login($username,$password)){
				$data = array(
          'login_status'=>'1',
          'username'=> $username,
          'user_id'=> $this->Users_model->getId($username,$password)
        );
        $this->session->set_userdata($data);
				$this->session->set_flashdata(array('class'=>'success','alert'=>'Berhasil','value'=>'Selamat datang '.$username));
				Redirect('/Welcome');
			}
			else{
				$this->session->set_flashdata(array('class'=>'warning','alert'=>'Gagal','value'=>'Username / Password salah !'));
				Redirect('/Users');
			}
		}
		else{
			$this->session->set_flashdata(array('class'=>'warning','alert'=>'Gagal','value'=>'Username / Password tidak boleh kosong'));
			Redirect('/Users');
		}
	}

	function Ubahnama(){
		if(isset($_POST['ubahnama'])){
			$id = $this->session->userdata('user_id');
			$username = $this->input->post('username');
			if($username == NULL){
				$this->session->set_flashdata(array('class'=>'warning','alert'=>'Gagal','value'=>'Form Nama tidak boleh kosong !'));
				Redirect('/Users');
			}
			$rename = $this->Users_model->ubahNama($id,$username);
			if($rename){
				$this->session->set_flashdata(array('class'=>'success','alert'=>'Berhasil','value'=>'Rubah nama berhasil'));
				Redirect('/Users');
			}
			else{
				$this->session->set_flashdata(array('class'=>'warning','alert'=>'Gagal','value'=>'Ubah nama gagal !'));
				Redirect('/Users');
			}
		}
		else{
			Redirect('/Users');
		}
	}

	function Ubahpassword(){
		if(isset($_POST['ubahpassword'])){
			$id = $this->session->userdata('user_id');
			$newpassword = $this->input->post('newpassword');
			$verpassword = $this->input->post('verpassword');
			$oldpassword = $this->input->post('oldpassword');
			if($newpassword != $verpassword){
  			$this->session->set_flashdata(array('class'=>'warning','alert'=>'Gagal','value'=>'Password Tidak Cocok !'));
				Redirect('/Users');
			}
			if($this->Users_model->Login($this->session->userdata('username'),$oldpassword)){
				$repassword = $this->Users_model->ubahPassword($id,$verpassword);
				if($repassword){
					$this->session->set_flashdata(array('class'=>'success','alert'=>'Berhasil','value'=>'Rubah Password berhasil'));
					Redirect('/Users');
				}
				else{
					$this->session->set_flashdata(array('class'=>'warning','alert'=>'Gagal','value'=>'Ubah Password gagal !'));
					Redirect('/Users');
				}
			}
			else{
				$this->session->set_flashdata(array('class'=>'warning','alert'=>'Gagal','value'=>'Password Lama Salah !'));
				Redirect('/Users');
			}
		}
		else{
			Redirect('/Users');
		}
	}
	function Logout(){
    $this->session->sess_destroy();
    Redirect('/Users');
  }
}
