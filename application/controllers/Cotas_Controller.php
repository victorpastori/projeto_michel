<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cotas_Controller extends My_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Conta_model');		
		$this->load->model('Cota_model');
		$this->load->library('Cota');
	}

	public function index(){
		$this->load->view('welcome_message', $dados);
	}

	public function cadastrarCota(){
		$this->isAdmin();
		$idcliente = $this->input->post('cliente');
		$idconta = $this->Conta_model->getIdContaByCliente($idcliente);
		$cota = new Cota();
		$cota->valor = $this->input->post('valor');
		$cota->dataCompra = date("Y-m-d");
		$cota->dataFechamento = $this->input->post('dataFechamento');
		$cota->rendimento = $this->input->post('rendimento');
		$cota->conta_idconta = $idconta['idconta'];
		$this->Cota_model->cadastrarCota($cota);
		redirect('Admin_Controller/cotas');
	}

	public function isAdmin()
	{
		# code...
		if ($this->session->userdata('usuario_logado')['tipo'] == 2) {
			# code...
			redirect('Clientes_Controller/index');
		}
	}

}
