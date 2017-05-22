<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
		$this->encryption->initialize(array('driver' => 'mcrypt'));
	}

	public function index()
	{
		$this->load->view('auth/login');
	}

	public function do_login()
	{
		$text = $this->input->post('email').' '.$this->input->post('password');
		$ciphertext = $this->encryption->encrypt($text);

		

		$this->session->set_userdata('_token', $ciphertext);
		redirect('');
	}
}
