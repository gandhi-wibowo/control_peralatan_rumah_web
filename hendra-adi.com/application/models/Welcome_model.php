<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_model extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    function getAll(){
      return $this->db->get('saklar')->result();
    }
    function kontrol($id,$value){
      $data = array('status_saklar'=>$value);
      $this->db->where('id_saklar',$id);
      $exe = $this->db->update('saklar',$data);
      if($exe){
        return TRUE;
      }
      else{
        return FALSE;
      }
    }
    function ubahNama($id, $value){
      $data = array('nama_saklar'=>$value);
      $this->db->where('id_saklar',$id);
      $exe = $this->db->update('saklar',$data);
      if($exe){
        return TRUE;
      }
      else{
        return FALSE;
      }
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

    function getOne($id){
      $data = array('id_saklar'=>$id);
      $this->db->where($data);
      $get = $this->db->get('saklar')->result_array();
      return $get[0]['status_saklar'];
    }

    function getLast(){
      $this->db->from('suhu');
      $this->db->order_by("id_suhu", "DESC");
      $this->db->limit(1);
      $query = $this->db->get();
      return $query->result();
      //      $query = "SELECT * FROM suhu ORDER BY id_suhu DESC";
      //return $this->db_query($query);
    }
}
