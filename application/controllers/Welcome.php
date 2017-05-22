<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->library('truewallet');
		$username = 'sankhumpha84@gmail.com';
		$password = 'u0954027399U';

		/**
		ฟังก์ชั้นนี้ จะดึงข้อมูลทางการเงินทั้งหมดออกมา ไม่เกิน 50 รายการ
		**/

		

		$transaction = $this->truewallet->get_transactions($username, $password);
		echo "<pre>";
		print_r($transaction);
		echo "</pre>";

		/**
			ฟังก์ชั้นนี้จะดึง ข้อมูลการโอนอย่างละเอียด ของแต่ละรายการ ที่ได้จาก get_transections()
			ซึ่ง จำเป็นจะต้องใช้ reportID 

			ข้อมูลที่ได้ออกมาจะรวมถึง 'หมายเลขอ้างอิง' และวันที่เวลาในการโอนด้วย 
		**/
		// 
		$report = $this->truewallet->get_report($transaction[0]->reportID);
		echo "<pre>";
		var_dump($report);
		echo "</pre>";

	}
}
