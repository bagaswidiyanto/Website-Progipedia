<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Integration extends MY_Controller
{
    public function index()
    {

        $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 3))->row();
        $this->data['fitur'] = $this->db->get('tbl_fitur_api')->result();

        $this->data['client'] = $this->db->get('tbl_client')->result();
        $this->web = 'content/v_integration';
        $this->layout();
    }
}