<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemenorder extends MY_Controller
{
    public function index()
    {
        $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 2))->row();
        $this->data['fitur'] = $this->db->get('tbl_fitur_manajemen')->result();

        $this->data['basic'] = $this->db->get_where('tbl_price', array('id' => 1))->row();
        $this->data['silver'] = $this->db->get_where('tbl_price', array('id' => 2))->row();
        $this->data['gold'] = $this->db->get_where('tbl_price', array('id' => 3))->row();
        $this->data['platinum'] = $this->db->get_where('tbl_price', array('id' => 4))->row();

        $this->web = 'content/v_manajemen_order';
        $this->layout();
    }
}