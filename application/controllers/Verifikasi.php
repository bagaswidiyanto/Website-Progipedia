<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Verifikasi extends MY_Controller
{
	public function index()
	{
		$this->web = 'content/v_verifikasi'; // untuk loading page homenya. rubah pada bagian ini untuk halaman lainnya.
		$this->layout();
	}
}