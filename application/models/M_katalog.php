<?php
class M_katalog extends CI_Model
{
     function showData($user)
     {
          $this->db->where('userID', $user);
          $this->db->where("status","Y");
          return $this->db->get("log_katalog_barang");
     }

     function addKatalog($data)
     {
          $ins=$this->db->insert("log_katalog_barang",$data);
          if ($ins=true) {
               return true;
          }else{
               return false;
          }

     }

     function showDetail($id)
     {
          $this->db->where('ID', $id);
          return $this->db->get("log_katalog_barang");
     }

     function upKatalog($data,$id)
     {
          $this->db->where("ID",$id);
          $up=$this->db->update("log_katalog_barang",$data);
          if ($up=true) {
               return true;
          }else{
               return false;
          }

     }
}