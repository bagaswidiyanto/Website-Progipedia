<?php
class M_data extends CI_Model
{
	function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	function getCompany($id)
	{
		$this->db->where('id', $id);
          return $this->db->get("em_company");
	}
}