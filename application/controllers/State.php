<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('truewallet');
		$this->load->library('encryption');
		$this->encryption->initialize(array('driver' => 'mcrypt'));

	}

	public function index()
	{
		$token = $this->session->userdata('_token');

		$token = $this->encryption->decrypt($token);
		$token = explode(' ', $token);

		$username = $token[0];
		$password = $token[1];

		/**
		ฟังก์ชั้นนี้ จะดึงข้อมูลทางการเงินทั้งหมดออกมา ไม่เกิน 50 รายการ
		**/

		

		$transaction = $this->truewallet->get_transactions($username, $password);

		if ($transaction) {
		
		//$report = $this->truewallet->get_report($transaction[0]->reportID);
		//echo "<pre>";
		//var_dump($report);
		//echo "</pre>";
			$data['transaction'] = $transaction;

			$this->load->view('state/index', $data);
		} else {
			echo 'Please check email, password truewallet';
		}
	}

	public function search()
	{
		$data['report'] = $this->truewallet->get_report($this->input->post('q'));
		$this->load->view('state/search', $data);
	}
}
