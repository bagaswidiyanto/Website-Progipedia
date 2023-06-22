<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tracking extends MY_Controller
{

  public function index()
  {
    $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 5))->row();
    $this->data['idCompany'] = $this->input->post('idCompany');
    $this->data['awb'] = $this->input->post('awb');

    $this->web = 'content/v_tracking';
    $this->layout();
  }
  public function detail()
  {
    $this->data['hero'] = $this->db->get_where('tbl_slider', array('posisi' => 'About Us'))->result();

    $this->web = 'content/v_tracking_detail.php';
    $this->layout();
  }
}