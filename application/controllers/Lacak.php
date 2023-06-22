<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lacak extends MY_Controller
{
    public function index()
    {
        $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 5))->row();
        $this->data['company'] = $this->db->get_where('em_company', array('status' => "Y"))->result();
        $this->web = 'content/v_lacak';
        $this->layout();
    }

    public function detail()
    {

        $this->web = 'content/v_detail_lacak';
        $this->layout();
    }
}
