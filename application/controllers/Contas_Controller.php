<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contas_Controller extends My_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Conta_model');
		$this->load->model('Investimento_model');
		$this->load->model('Rendimento_model');
		$this->load->model('Movimento_model');
		$this->load->library('Movimento');
		$this->load->library('Investimento');
		$this->load->library('Rendimento');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function solicitarSaque(){
		$idusuario = $this->session->userdata('usuario_logado')['idusuario'];
		$conta = $this->Conta_model->getConta($idusuario);
		$valorSaque = $this->input->post('valor');
		if($valorSaque > $conta['saldoSaque']){
			$this->session->set_flashdata('erroSaque', 'Valor solicitado superior ao limite disponível! Valor disponível para saque: U$ '.$conta['saldoSaque']);
			redirect('Clientes_Controller/saque');
		}else {
			$movimento = new Movimento();
			$movimento->valor =	$valorSaque;
			$movimento->data = date("Y-m-d");
			$movimento->status = 0;
			$movimento->conta_idconta = $conta['idconta'];
			$movimento->tipo_movimento_idtipo_movimento = 2;
			$this->Movimento_model->cadastrarMovimento($movimento);
			$this->Conta_model->updateSaldoSaque($movimento->valor, $conta['idconta']);
		}
		
	}

	public function realizarDeposito(){
		$idcliente = $this->input->post('cliente');
		$idconta = $this->Conta_model->getIdContaByCliente($idcliente);
		var_dump($idconta);
		$movimento = new Movimento();
		$movimento->valor =	$this->input->post('valor');
		$movimento->data = date("Y-m-d");
		$movimento->status = 1;
		$movimento->conta_idconta = $idconta;
		$movimento->tipo_movimento_idtipo_movimento = 1;
		$this->Movimento_model->cadastrarMovimento($movimento);
		$this->Conta_model->updateSaldoDeposito($movimento->valor, $idconta);
		$carencia = $this->input->post('carencia');
		$this->cadastrarInvestimento($movimento->valor, $carencia, $movimento->data, $idconta);
	}

	public function cadastrarInvestimento($valor, $carencia, $data, $idconta){
		$investimento = new Investimento();
		$investimento->valor = $valor;
		$investimento->data = $data;
		$investimento->status = 0;
		$investimento->carencia = $carencia;
		$investimento->carenciaRestante = $carencia;
		$investimento->conta_idconta = $idconta;
		$this->Investimento_model->cadastrarInvestimento($investimento);
	}

	// criar funcao exclusiva para admin que nao desconte 25% da tx adm
	public function cadastrarRendimentos(){
		$txAdm = 25;
		$rendimentos = array();
		$ren = $this->input->post('rendimento');
		$contas = $this->Conta_model->getContas();
		foreach ($contas as $conta) {
			$rendimento = new Rendimento();
			$rendimento->percentual = $ren;
			$rendimento->capital = $conta['saldo'];
			$rendimento->valor = $conta['saldo']*$rendimento->percentual/100*(1-$txAdm/100);
			$rendimento->data = $this->input->post('data');
			$rendimento->conta_idconta = $conta['idconta'];
			$rendimento->tipo_rendimento_idtipo_rendimento = 1;
			array_push($rendimentos, $rendimento);
		}

		$investimentos = $this->Investimento_model->getInvestimentosAtivos();
		foreach ($investimentos as $investimento) {
			$rendimento = new Rendimento();
			$rendimento->percentual = $ren;
			$rendimento->capital = $investimento['valor'];
			$rendimento->valor = $investimento['valor']*$rendimento->percentual/100*(1-$txAdm/100);
			$rendimento->data = date("Y-m-d");
			$rendimento->conta_idconta = $investimento->conta_idconta;
			$rendimento->tipo_rendimento_idtipo_rendimento = 2;
			array_push($rendimentos, $rendimento);
		}

		$this->Rendimento_model->cadastrarRendimento($rendimentos);
		$renFinal = $ren/100*(1-$txAdm/100);
		// criar funcao exclusiva para admin que nao desconte 25% da tx adm
		$this->aplicarRendimentos($renFinal);
	}

	public function aplicarRendimentos($rendimento){
		$this->Conta_model->aplicarRendimento($rendimento);
		$this->Investimento_model->aplicarRendimento($rendimento);
	}

	public function atualizarSaldoSaque($valor){

	}

	public function getTotalCapitalAdmin()// INCLUE SALDO, INVESTIMENTOS E COTAS SEM RENDIMENTO
	{
		# code...
		$this->Conta_model->getTotalCapitalAdmin();
	}

	public function getTotalCapital()// INCLUE SALDO, INVESTIMENTOS E COTAS SEM RENDIMENTO
	{
		# code...
		$this->Conta_model->getTotalCapital();
	}

}
