<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Lacakprogi extends MY_Controller
{
    public function index()
    {
        $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 5))->row();
        $this->data['idCompany'] = $this->input->post('idCompany');
        $this->data['awb'] = $this->input->post('awb');

        $this->web = 'content/progi/v_lacak';
        $this->dashboard();
    }
}