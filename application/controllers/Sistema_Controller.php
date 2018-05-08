<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->isUsuarioLogado();
		$this->load->library('Sistema');
		$this->load->model('Sistema_model');
	}
	public function isUsuarioLogado(){
		if(!$this->session->userdata('usuario_logado')){
			$this->session->set_flashdata('danger', 'Sua sessão expirou ou você não está logado! Por favor efetue o login!');
			redirect('/');
		}
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function updateDados(){
		$sistema = new Sistema();
		$sistema->valorAdmCota = $this->input->post('taxaCotas');
		$sistema->valorAdmRend = $this->input->post('taxaRendimentos');
		$sistema->diaInicialRendimento = $this->input->post('diaRendimento');
		$this->Sistema_model->updateDados($sistema);
		redirect('Admin_Controller/sistema');
	}
}
