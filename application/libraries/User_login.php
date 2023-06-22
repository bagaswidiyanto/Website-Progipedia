<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_login
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }


    public function cek_login()
    {
        if ($this->ci->session->userdata('username') == "") {
            $this->ci->session->set_flashdata('pesan', 'Anda Belum Login !!!');
            redirect(base_url());
        }
    }
}