<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cotas_Controller extends My_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('Cota');
	}

	public function index(){
		$this->load->view('welcome_message', $dados);
	}

	public function cadastrarCota(){
		$conta = $this->Conta_model->getIdConta($idusuario);
		$cota = new Cota();
		$cota->valor = $this->input->post('valor');
		$cota->dataCompra = $this->input->post('dataCompra');
		$cota->dataFechamento = $this->input->post('dataFechamento');
		$cota->rendimento = $this->input->post('rendimento');
		$cota->conta_idconta = $idconta;
		$this->Cota_model->cadastrarCota($cota);
		redirect('');
	}

}
