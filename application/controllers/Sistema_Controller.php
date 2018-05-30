<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->isUsuarioLogado();
		$this->load->library('Sistema');
		$this->load->library('Banco');
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
		$this->session->set_flashdata('success', 'Dados de sistema atualizados com sucesso!');
		redirect('Admin_Controller/sistema');
	}

	public function calcularRendimento()
	{
		# code...
		$this->load->view('admin/calcular_rendimento.php');
	}

	public function exibirValorRendimento()
	{
		# code...
		$this->load->model('Investimento_model');
		$this->load->model('Conta_model');
		$cotasAberto = $this->getCotasAberto();
		$capitalAtual = $this->input->post('capitalAtual');
		$capital = $this->capital();
		$investimentos = $this->getInvestimentosInativos();
		$sumRendParciaisInv = $this->sumRendParciaisInv($investimentos);
		// Calculo capital no sistema
		$totalInvestimentosInativos = $this->Investimento_model->getTotalInvestimentosInativos();
		$lucro = $this->lucro($capitalAtual, $capital+$totalInvestimentosInativos['total']+$cotasAberto['total']);
		$x = $lucro/($capital + $sumRendParciaisInv);
		$dados = array('rendimento' => $x*100);
		var_dump($cotasAberto);
		var_dump($capitalAtual);
		var_dump($capital);
		var_dump($sumRendParciaisInv);
		var_dump($totalInvestimentosInativos);
		var_dump($lucro);
		var_dump($dados);
		$this->load->view('admin/novo_rendimento.php', $dados);
	}

	public function capital()
	{
		# code...
		$this->load->model('Investimento_model');
		$this->load->model('Conta_model');
		$totalSaldoSaque = $this->Conta_model->getCapital();
		$totalInvestimentosAtivos = $this->Investimento_model->getTotalInvestimentosAtivos();
		// Pegar total de investimentos inativos também. A diferença(lucro) envolve eles na conta pq são aportes
		// entre os tempos
		return $totalInvestimentosAtivos['total'] + $totalSaldoSaque['total'];
	}

	public function getInvestimentosInativos()
	{
		# code...
		$this->load->model('Investimento_model');
		return $this->Investimento_model->getInvestimentosParciais();
	}

	public function getCotasAberto(){
		$this->load->model('Cota_model');
		return $this->Cota_model->getTotalCotas();
	}

	public function saques()
	{
		# code...
	}

	public function lucro($capitalAtual, $capital)
	{
		# code...
		return $capitalAtual - $capital;

	}

	public function sumRendParciaisInv($investimentos)
	{
		$sumRendParciaisInv = 0;
		foreach ($investimentos as $investimento) {
			$rend = $this->rendimentoProporcional($investimento);
			var_dump($rend);
			$sumRendParciaisInv += $investimento['valor']*$rend;

		}
		return $sumRendParciaisInv;
	}

	public function rendimentoProporcional($investimento)
	{
		# code...
		$data1 = new DateTime($investimento['data']);
		$data2 = new DateTime(date("Y-m-d"));
		$intervalo = $data2->diff( $data1 );
		var_dump($intervalo->days);
		return pow(1+1, ($intervalo->days)/30)-1;
	}

	public function calcularRendimentoParcial($rendimento)
	{
		# code...
		$data1 = new DateTime( '2013-12-11' );
		$data2 = new DateTime( '1994-04-17' );

		$intervalo = $data1->diff( $data2 );
		return pow(1+$rendimento, ($intervalo->days)/30) - 1;
	}

	public function novoBanco()
	{
		# code...
		$this->load->view('admin/novo_banco');
	}

	public function insereBanco()
	{
		# code...
		$banco = new Banco();
		$banco->nome = $this->input->post('nome');
		$banco->codigo = $this->input->post('codigo');
		$this->Sistema_model->insereBanco($banco);
		redirect('Admin_Controller');
	}
}
