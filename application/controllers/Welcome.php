<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_data');
		$this->load->model('m_login');
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->library('session');
	}

	public function index()
	{
		if ($this->session->userdata('userID')) {
			redirect(base_url('dashboard'));

		}else{
			$this->data['slider_hero'] = $this->db->get('tbl_slider_hero')->result();
			$this->data['client'] = $this->db->get('tbl_client')->result();
			$this->data['os'] = $this->db->get('tbl_other_slider')->result();
			$this->data['service'] = $this->db->get('tbl_services')->result();
			$this->data['fitur'] = $this->db->get('tbl_fitur')->row();
			$this->data['sosmed'] = $this->db->get('tbl_sosmed')->result();
			$this->data['content_layanan'] = $this->db->get_where('tbl_text_content', array('id' => 1))->row();
			$this->data['content_paket'] = $this->db->get_where('tbl_text_content', array('id' => 2))->row();



			$this->web = 'content/v_home';
		// $this->data['navigation']=$this->db->get_where('tbl_navigation');
			$this->layout();
		}

		
	}

	public function input_data_register()
	{

		$this->load->library('email');

		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telp = $this->input->post('telp');
		$nama_toko = $this->input->post('nama_toko');
		$referal = $this->input->post('referal');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = array(
			'nama' => $nama,
			'telp' => $telp,
			'email' => $email,
			'nama_toko' => $nama_toko,
			'referal' => $referal,
			'username' => $username,
			'password' => md5($password),
			'aktif' => 'Y'
		);
		$this->M_data->input_data($data, 'tbl_register');


		$this->email->from('noreply@progipedia.com');
		$this->email->to($email);

		$this->email->subject($nama);
		$this->email->message('
			Anda telah berhasil membuat akun login Progipedia
			<br>
			<br>
			<br>
			Silahkan klik link di bawah ini untuk verifikasi:<br>
			http://progipedia.com/verifikasi
			');

		$this->email->send();
		echo $this->email->print_debugger();
		$this->load->helper('url');
		echo "good";
	}


	function check_username_avalibility()
	{

		$this->load->model("daftar_username");
		if ($this->daftar_username->is_username_available($_POST["username"])) {
			echo 'Fail|<div class="alert alert-danger"><i class="fa fa-times-circle" ></i> Username sudah terpakai</div>';
		} else {
			echo 'Good|<div class="alert alert-success"><i class="fa fa-check-circle"></i> Username tersedia</div>';
		}
	}

	function aksi_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		$cek = $this->m_login->cek_login("tbl_register", $where)->num_rows();
		if ($cek > 0) {
			$data = $this->db->query("SELECT * FROM  tbl_register WHERE username = '" . $username . "'")->row();
			$data_session = array(
				'username' => $username,
				'nama' => $data->nama,
				"userID"=>$data->id,
				'status' => "login"
			);

			$this->session->set_userdata($data_session);

			redirect(base_url('dashboard'));
		} else {
			echo "Username dan password salah !";
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}