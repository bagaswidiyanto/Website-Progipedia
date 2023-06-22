<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends MY_Controller
{
    public function index()
    {

        $this->data['about'] = $this->db->get('tbl_about_us')->row();
        $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 7))->row();

        $this->web = 'content/v_about_us';
        $this->layout();
    }
}