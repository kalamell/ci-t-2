<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('_token')) redirect('auth');
	}


}