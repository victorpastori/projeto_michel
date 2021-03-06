<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contas_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->isUsuarioLogado();
		$this->load->model('Conta_model');
		$this->load->model('Investimento_model');
		$this->load->model('Rendimento_model');
		$this->load->model('Movimento_model');
		$this->load->model('Sistema_model');
		$this->load->library('Movimento');
		$this->load->library('Investimento');
		$this->load->library('Rendimento');
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

	public function solicitarSaque(){
		$idusuario = $this->session->userdata('usuario_logado')['idusuario'];
		$conta = $this->Conta_model->getConta($idusuario);
		$valorSaque = $this->input->post('valor');
		if ($valorSaque<=0) {
			# code...
			$this->session->set_flashdata('erroSaque', 'Não é possível solicitar um valor de saque menor do que zero(0)');
			redirect('Clientes_Controller/saque');

		}
		if($valorSaque > $conta['saldoSaque']){
			$this->session->set_flashdata('erroSaque', 'Valor solicitado superior ao limite disponível! Valor disponível para saque: U$ '.number_format($conta['saldoSaque'], 2, ',', ','));
			redirect('Clientes_Controller/saque');
		}else {
			$movimento = new Movimento();
			$movimento->valor =	$valorSaque;
			$movimento->data = date("Y-m-d");
			// 0 - Pendente 
			//1 - Efetuado
			$movimento->status = 0; 
			$movimento->conta_idconta = $conta['idconta'];
			$movimento->tipo_movimento_idtipo_movimento = 2;
			$this->Movimento_model->cadastrarMovimento($movimento);
			$this->Conta_model->updateSaldoSaque($movimento->valor, $conta['idconta']);
			$this->session->set_flashdata('saqueOk', 'Saque solicitado com sucesso');
			redirect('Clientes_Controller/saque');
		}
		
	}

	public function aprovarSaque()
	{
		$idmovimento = $this->input->get('idmovimento');
		$this->Movimento_model->attStatusSaque(2, $idmovimento);
		$this->session->set_flashdata('success', 'Saque aprovado!');
		redirect('Admin_Controller');
	}

	public function cancelarSaque()
	{
		$idmovimento = $this->input->get('idmovimento');
		$this->Movimento_model->attStatusSaque(3, $idmovimento);
		$this->session->set_flashdata('success', 'Saque cancelado com sucesso!');
		redirect('Admin_Controller');
	}

	public function lancarScalpins()
	{
		$movimento = new Movimento();
		$movimento->valor =	$this->input->post('valor');
		$movimento->data = date("Y-m-d");
		$movimento->status = 1;
		$movimento->conta_idconta = 1;
		$movimento->tipo_movimento_idtipo_movimento = 4;
		$this->Movimento_model->cadastrarMovimento($movimento);
		$this->session->set_flashdata('success', 'Lançamento Scalpin e Operções Normais realizado!');
		redirect('Admin_Controller');
	}

	public function realizarDeposito(){
		$this->isAdmin();
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
		//$this->Conta_model->updateSaldoDeposito($movimento->valor, $idconta); // UPDATE NO SALDO BLOQUEADO (NÃO SE FAZ NECESSÁRIO)
		$carencia = $this->input->post('carencia');
		$this->cadastrarInvestimento($movimento->valor, $carencia, $movimento->data, $idconta);
	}

	public function cadastrarInvestimento($valor, $carencia, $data, $idconta){
		$this->isAdmin();
		$investimento = new Investimento();
		$investimento->valor = $valor;
		$investimento->data = $data;
		$investimento->status = 0;
		$investimento->carencia = $carencia;
		$investimento->carenciaRestante = $carencia;
		$investimento->conta_idconta = $idconta;
		$this->Investimento_model->cadastrarInvestimento($investimento);
		$this->session->set_flashdata('success', 'Depósito de Investimento realizado com sucesso!');
		redirect('Admin_Controller/deposito');
	}

	// criar funcao exclusiva para admin que nao desconte 25% da tx adm
	public function cadastrarRendimentos(){
		$this->isAdmin();
		$txAdm = $this->Sistema_model->getTxAdmRend();
		$txAdm = $txAdm['valorAdmRend'];
		$rendimentos = array();
		$ren = $this->input->post('rendimento');
		$contas = $this->Conta_model->getContas();
		foreach ($contas as $conta) {
			$rendimento = new Rendimento();
			$rendimento->percentual = $ren;
			$rendimento->capital = $conta['saldoSaque'];
			$rendimento->valorBruto = $conta['saldoSaque']*$rendimento->percentual/100;
			$rendimento->rentabilidadeLiquida = $rendimento->percentual*(1-$txAdm/100);
			$rendimento->valor = $conta['saldoSaque']*$rendimento->percentual/100*(1-$txAdm/100);
			$rendimento->data = $this->input->post('data');
			$rendimento->conta_idconta = $conta['idconta'];
			$rendimento->tipo_rendimento_idtipo_rendimento = 2;
			array_push($rendimentos, $rendimento);
		}

		$investimentos = $this->Investimento_model->getInvestimentosAtivos();
		foreach ($investimentos as $investimento) {
			$rendimento = new Rendimento();
			$rendimento->percentual = $ren;
			$rendimento->capital = $investimento['valor'];
			$rendimento->valorBruto = $investimento['valor']*$rendimento->percentual/100;
			$rendimento->rentabilidadeLiquida = $rendimento->percentual*(1-$txAdm/100);
			$rendimento->valor = $investimento['valor']*$rendimento->percentual/100*(1-$txAdm/100);
			$rendimento->data = date("Y-m-d");
			$rendimento->conta_idconta = $investimento['conta_idconta'];
			$rendimento->tipo_rendimento_idtipo_rendimento = 2;
			array_push($rendimentos, $rendimento);
		}

		$investimentosParciais = $this->Investimento_model->getInvestimentosParciais();
		var_dump($investimentosParciais);
		$invs = array(); // array para investimentos com rendimento parcial, inserir 1 a 1 num foreach
		foreach ($investimentosParciais as $investimento) {
			$data1 = new DateTime($investimento['data']);
			$data2 = new DateTime(date("Y-m-d"));
			$intervalo = $data2->diff($data1);
			$rendimento = new Rendimento();
			$rendP = $this->calcularRendimentoParcial($investimento, $ren);
			var_dump($rendP);
			$rendimento->percentual = $rendP;
			$rendimento->capital = $investimento['valor'];
			$rendimento->valorBruto = $investimento['valor']*$rendimento->percentual/100;
			$rendimento->rentabilidadeLiquida = $rendimento->percentual*(1-$txAdm/100);
			$rendimento->valor = $investimento['valor']*$rendimento->percentual/100*(1-$txAdm/100);
			$rendimento->data = date("Y-m-d");
			$rendimento->conta_idconta = $investimento['conta_idconta'];
			$rendimento->tipo_rendimento_idtipo_rendimento = 2;
			$investimento['valor'] += $rendimento->valor;
			$investimento['status'] = 1;
			array_push($invs, $investimento);
			array_push($rendimentos, $rendimento);
		}
		$renFinal = $ren/100*(1-$txAdm/100);
		$this->Conta_model->aplicarRendimentoAdmin($renFinal);
		$this->Rendimento_model->cadastrarRendimento($rendimentos);
		$this->aplicarRendimentos($renFinal, $invs);
		$this->isRendimentoTrue();
		$this->session->set_flashdata('success', 'Rendimentos lançados com sucesso!');
		redirect('Admin_Controller');
	}

	public function calcularRendimentoParcial($investimento, $rendimento)
	{
		# code...
		$data1 = new DateTime($investimento['data']);
		$data2 = new DateTime(date("Y-m-d"));

		$intervalo = $data2->diff( $data1 );
		var_dump($intervalo->days);
		$fracaoRend = pow(1+1, $intervalo->days/30) - 1;
		var_dump($fracaoRend);
		return $rendimento*$fracaoRend;
	}

	public function aplicarRendimentos($rendimento, $investimentos){
		$this->isAdmin();
		// aplicar primerio rendimento na conta do admin
		$this->Conta_model->aplicarRendimento($rendimento);
		$this->Investimento_model->aplicarRendimento($rendimento);
		foreach ($investimentos as $investimento) {
			$this->Investimento_model->aplicarRendimentoParciais($investimento['valor'], $investimento['status'], $investimento['idinvestimento']);
		}
		

	}

	public function isRendimentoTrue(){
		$this->load->model('IsRendimentoTrue_model');
		$this->IsRendimentoTrue_model->novo();
	}

	public function atualizarSaldoSaque($valor){

	}

	public function getTotalCapitalAdmin()// INCLUE SALDO, INVESTIMENTOS E COTAS SEM RENDIMENTO
	{
		# code...
		$this->isAdmin();
		$this->Conta_model->getTotalCapitalAdmin();
	}

	public function getTotalCapital()// INCLUE SALDO, INVESTIMENTOS E COTAS SEM RENDIMENTO
	{
		# code...
		$this->isAdmin();
		$this->Conta_model->getTotalCapital();
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
