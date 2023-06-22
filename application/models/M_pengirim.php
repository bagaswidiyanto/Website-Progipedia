<?php
class M_pengirim extends CI_Model
{

     function showPengirim($userID)
     {
          return $this->db->query("SELECT a.* FROM log_pengirim a where a.userID='".$userID."'  order by FIELD(a.statusUtama,'Y','N')");
     }

	function addPengirim($data,$status,$userID)
	{
		if ($status=='Y') {
			$dataS = array('statusUtama' =>'N' , );
			$this->db->where("userID",$userID);
			$this->db->update("log_pengirim",$dataS);
		}
		$ins=$this->db->insert("log_pengirim",$data);
		if ($ins=true) {
			return true;
		}else{
			return false;
		}
	}

     function showDetail($id)
     {
          $this->db->where('ID', $id);
          return $this->db->get("log_pengirim");
     }


     function upPengirim($data,$id,$status,$userID)
     {
     	if ($status=='Y') {
			$dataS = array('statusUtama' =>'N' , );
			$this->db->where("userID",$userID);
			$this->db->update("log_pengirim",$dataS);
		}
          $this->db->where("ID",$id);
          $up=$this->db->update("log_pengirim",$data);
          if ($up=true) {
               return true;
          }else{
               return false;
          }

     }
}