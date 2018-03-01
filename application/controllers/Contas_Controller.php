<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contas_Controller extends My_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function solicitarSaque(){
		$idconta = $this->Conta_model->getIdConta($idusuario);
		$movimento = new Movimento();
		$movimento->valor =	$this->post->input('valor');
		$movimento->data = date("Y-m-d");
		$movimento->status = 0;
		$moviemnto->conta_idconta = $idconta;
		$movimento->tipo_movimento_idtipo_movimento = 1;
		$this->Conta_model->getCon($movimento->valor);
	}

	public function realizarDeposito(){
		$idconta = $this->Conta_model->getIdConta($idusuario);
		$movimento = new Movimento();
		$movimento->valor =	$this->post->input('valor');
		$movimento->data = date("Y-m-d");
		$movimento->status = 0;
		$moviemnto->conta_idconta = $idconta;
		$movimento->tipo_movimento_idtipo_movimento = 2;
		$this->Conta_model->updateSaldo($movimento->valor);
		$carencia = $this->input->post('carencia');
		$this->cadastrarInvestimento($movimento->valor, $carencia, $movimento->data, $idconta);
	}

	public function cadastrarInvestimento($valor, $carencia, $data, $idconta){
		$investimento = new Investimento();
		$investimento->valor = $valor;
		$investimento->data = $data;
		$investimento->carencia = $carencia;
		$investimento->carenciaRestante = $carencia;
		$investimento->conta_idconta = $idconta;
		$this->Investimento_model->cadastrarInvestimento($investimento);
	}

	public function cadastrarRendimentos(){
		$rendimentos = array();
		$ren = $this->input->post('rendimento');
		$contas = $this->Conta_model->getContas();
		foreach ($contas as $conta) {
			$rendimento = new Rendimento();
			$rendimento->percentual = $ren;
			$rendimento->capital = $conta['saldoSaque'];
			$rendimento->valor = $conta['saldoSaque']*$rendimento->percentual/100*(1-$txAdm/100);
			$rendimento->data = $this->input->post('data');
			$rendimento->conta_idconta = $conta->idconta;
			$rendimento->tipo_rendimento_idtipo_rendimento = 1;
			array_push($rendimentos, $rendimento);
		}

		$investimentos = $this->Investimento_model->getInvestimentosAtivos();
		foreach ($investimentos as $investimento) {
			$rendimento = new Rendimento();
			$rendimento->percentual = $ren;
			$rendimento->capital = $investimento['valor'];
			$rendimento->valor = $investimento['valor']*$rendimento->percentual/100*(1-$txAdm/100);
			$rendimento->data = $this->input->post('data');
			$rendimento->conta_idconta = $investimento->conta_idconta;
			$rendimento->tipo_rendimento_idtipo_rendimento = 1;
			array_push($rendimentos, $rendimento);
		}

		$this->Rendimento_model->cadastrarRendimento($rendimentos);
		$this->aplicarRendimentos($ren);
	}

	public function aplicarRendimentos($rendimento){
		$this->Conta_model->aplicarRendimento($rendimento);
		$this->Investimento_model->aplicarRendimento($rendimento);
	}

}
