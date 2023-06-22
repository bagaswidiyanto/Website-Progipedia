<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
    public function index()
    {
        $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 1))->row();

        $this->web = 'content/progi/v_home';
        $this->dashboard();
    }
}