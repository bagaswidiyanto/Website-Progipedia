<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ongkir extends MY_Controller
{
    public function index()
    {
        $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 6))->row();
        $this->data['os'] = $this->db->get('tbl_other_slider')->result();
        $this->web = 'content/v_cek_ongkir';
        $this->layout();
    }
}