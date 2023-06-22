<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prices extends MY_Controller
{

  public function index()
  {
    $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 6))->row();

    $this->data['dari'] = $this->input->post('dari');
    $this->data['kabAsal'] = $this->input->post('kabAsal');
    $this->data['branchNameAsal'] = $this->input->post('branchNameAsal');
    $this->data['kecNameAsal'] = $this->input->post('kecNameAsal');
    $this->data['kabupatenNameAsal'] = $this->input->post('kabupatenNameAsal');

    $this->data['tujuan'] = $this->input->post('tujuan');
    $this->data['kabTujuan'] = $this->input->post('kabTujuan');
    $this->data['branchNameTujuan'] = $this->input->post('branchNameTujuan');
    $this->data['kecNameTujuan'] = $this->input->post('kecNameTujuan');
    $this->data['kabupatenNameTujuan'] = $this->input->post('kabupatenNameTujuan');

    $this->data['berat'] = $this->input->post('berat');


    $this->web = 'content/v_price'; // untuk loading page homenya. rubah pada bagian ini untuk halaman lainnya.
    $this->layout();
  }
}