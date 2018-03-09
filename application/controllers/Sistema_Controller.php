<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_Controller extends My_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('Sistema');
		$this->load->model('Sistema_model');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
}
