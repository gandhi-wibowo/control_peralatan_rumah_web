<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    function getId($username,$password){
      $data = array('username'=>$username,'password'=> sha1($password));
      $this->db->where($data);
      if($this->db->get('users')->num_rows()==1){
        $get = $this->db->get('users')->result_array();
        return $get[0]['id_user'];
      }
      else{
        return FALSE;
      }
    }
    function ubahNama($id, $value){
      $data = array('username'=>$value);
      $this->db->where('id_user',$id);
      $exe = $this->db->update('users',$data);
      if($exe){
        return TRUE;
      }
      else{
        return FALSE;
      }
    }
    function ubahPassword($id, $value){
      $data = array('password'=>sha1($value));
      $this->db->where('id_user',$id);
      $exe = $this->db->update('users',$data);
      if($exe){
        return TRUE;
      }
      else{
        return FALSE;
      }
    }
    function Login($username,$password){
      $data = array('username'=>$username, 'password'=> sha1($password));
      $this->db->where($data);
      $exe = $this->db->get('users')->num_rows();
      if($exe == 1){
        return TRUE;
      }
      else{
        return FALSE;
      }
    }
}
