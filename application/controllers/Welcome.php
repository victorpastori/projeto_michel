<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{	
		$this->isUsuarioLogado();
		//$this->load->view('public/index');
	}

	public function isUsuarioLogado(){
		if($this->session->userdata('usuario_logado')){
			if ($this->session->userdata('usuario_logado')['tipo'] == 1) {
				redirect('Admin_Controller/index');
		}else {
				redirect('Clientes_Controller/index');
		}
		}else{
			$this->load->view('public/index');
		}
	}
}
