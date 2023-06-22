<?php
class M_booking extends CI_Model
{
     function showData($user,$status)
     {
          $this->db->where('CreatedUserId', $user);
          if ($status == "2") {
               $this->db->where("flagBayar","2");
          } else if ($status == "1") {
               $this->db->where("flagBayar","1");
          } else if ($status == "") {
             $where = "";
        } else {
          $this->db->where("statusBooking",$status);
          $this->db->where("flagBayar","0");
     }
     $this->db->order_by("Tgl_Konos DESC, Konid DESC");
     return $this->db->get("log_booking");
}

function upBooking($id)
{
     $up=$this->db->query("UPDATE log_booking SET flagBayar=IF(feeCOD!=0,1,2) where ID in(".$id.")");
          if ($up=true) {
               return true;
          }else{
               return false;
          }
     }

     function generateBook($format)
     {
          $last=$this->db->query("SELECT Konid from log_booking where Konid LIKE '".$format."%' order by ID DESC,Konid DESC");
          if ($last->num_rows()>0) {
               $isiLast=$last->row();
               $param=str_replace($format,'',$isiLast->Konid);

               $MaksID = $param;

               $MaksID++;

               if($MaksID < 10) $ID = $format."0000".$MaksID;

               else if($MaksID < 100) $ID = $format."000".$MaksID;

               else if($MaksID < 1000) $ID = $format."00".$MaksID;

               else if($MaksID < 10000) $ID = $format."0".$MaksID;

               else $ID = $format.$MaksID;
          }else{
               $ID=$format."00001";
          }

          return $ID;
     }

     function showBooking($id)
     {
          $this->db->where('ID', $id);
     $this->db->order_by("Tgl_Konos DESC, Konid DESC");
     return $this->db->get("log_booking");
}



     function showBookingKonid($id)
     {
          $this->db->where('Konid', $id);
     $this->db->order_by("Tgl_Konos DESC, Konid DESC");
     return $this->db->get("log_booking");
}

}