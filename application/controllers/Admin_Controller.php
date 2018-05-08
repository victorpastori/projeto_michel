<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->isUsuarioLogado();
		$this->isAdmin();
		$this->load->model('Cliente_model');
		$this->load->model('Cota_model');
		$this->load->model('Conta_model');
		$this->load->model('Movimento_model');
		$this->load->model('Investimento_model');
		$this->load->model('Rendimento_model');
		$this->load->model('Sistema_model');
		$this->load->model('Comissao_model');
		$this->load->model('Banco_model');
		$this->load->model('ContaSaque_model');
	}
	public function isUsuarioLogado(){
		if(!$this->session->userdata('usuario_logado')){
			$this->session->set_flashdata('danger', 'Sua sessão expirou ou você não está logado! Por favor efetue o login!');
			redirect('/');
		}
	}

	public function da(){
		
	}

	public function index(){
		$idusuario = $this->session->userdata('usuario_logado')['idusuario'];
		// SAQUES SOLICITADOS PELOS CLIENTES AINDA PENDENTES
		$saquesPendentes = $this->Movimento_model->getSaquesPendentes();
		// PEGANDO SALDO ADMIN E GERAL(SALDO SAQUE + INVESTIMENTOS + COTAS ATIVAS)
		$capitalTotal = $this->Conta_model->getTotalCapital();
		$capitalTotalAdmin = $this->Conta_model->getSaldoSaqueAdmin($idusuario);
		$totalInvestimento = $this->Investimento_model->getTotalInvestimentos();
		$totalInvestimentoAdmin = $this->Investimento_model->getTotalInvestimentosAdmin($idusuario);
		$totalCotas = $this->Cota_model->getTotalCotas();
		$totalCotasAdmin = $this->Cota_model->getTotalCotasAdmin($idusuario);
		// SOMANDO EM UMA ÚNICA VARIÁVEL PARA EXIBIR (SALDO SAQUE + INVESTIMENTOS + COTAS ATIVAS)
		$capitalTotal = $capitalTotal['total']+$totalInvestimento['total']+$totalCotas['total'];
		$saldoSaqueAdmin = $capitalTotalAdmin['saldoSaque'];
		$capitalTotalAdmin = $capitalTotalAdmin['saldoSaque']+$totalInvestimentoAdmin['total']+$totalCotasAdmin['total'];
		
		$movimentos = $this->Movimento_model->getMovimentosCliente($idusuario);

		$cotas = $this->Cota_model->getMyCotas($idusuario);

		$rendimentos = $this->Rendimento_model->getRendimentosCliente($idusuario);
		$rendimentosClientes = $this->Rendimento_model->getRendimentosNoAdmin($idusuario);
		$rendimentosBrutos = $this->Rendimento_model->getSumAllRendimentos();
		$rendimentosAdminMensais = $this->Rendimento_model->getSumAllRendimentosAdmin($idusuario);
		$comissoes = $this->Comissao_model->getComissoes();
		//$rendimentosAdminMensais = array_merge($rendimentosAdminMensais, $comissoes);

		$txAdm = $this->Sistema_model->getTxAdmCota();
		
		$dados = array('capitalTotal' =>$capitalTotal, 'capitalTotalAdmin' => $capitalTotalAdmin, 'saldoSaqueAdmin' => $saldoSaqueAdmin, 'movimentos' => $movimentos, 'cotas' => $cotas, 'rendimentos' => $rendimentos, 'rendimentosClientes' => $rendimentosClientes, 'comissoes' => $comissoes, 'rendimentosBrutos' => $rendimentosBrutos, 'rendimentosAdminMensais' => $rendimentosAdminMensais, 'saquesPendentes' => $saquesPendentes, 'txAdm' => $txAdm);
		$this->load->view('admin/index.php', $dados);
	}

	public function deposito(){
		$clientes = $this->Cliente_model->getClientes();
		$dados = array('clientes' => $clientes);
		$this->load->view('admin/deposito', $dados);
	}

	public function clientes(){
		$clientes = $this->Cliente_model->getClientes();
		$saldoCotas = $this->Cota_model->getSaldoCotasAllClientes();
		$saldoCotasFechadas = $this->Cota_model->getSaldoCotasFechadasAllClientes();
		$saldoInvestimentos = $this->Investimento_model->getSaldoInvestimentosAllClientes();
		$saldoInvestimentosEncerrados = $this->Investimento_model->getSaldoInvestimentosEncerradosAllClientes();
		$dados = array('clientes' => $clientes, 'saldoCotas' => $saldoCotas, 'saldoCotasFechadas' => $saldoCotasFechadas, 'saldoInvestimentos' => $saldoInvestimentos, 'saldoInvestimentosEncerrados' => $saldoInvestimentosEncerrados);
		$this->load->view('admin/clientes', $dados);
	}

	public function novoCliente(){
		$bancos = $this->Banco_model->getBancos();
		$dados = array('bancos' => $bancos );
		$this->load->view('admin/novo_cliente', $dados);
	}

	public function buscarCliente(){
		$clientes = $this->Cliente_model->getClientes();
		$dados = array('clientes' => $clientes);
		$this->load->view('admin/buscar_cliente', $dados);
	}

	public function mostrarCliente(){
		$idcliente = $this->input->get('cliente');
		$cliente = $this->Cliente_model->getCliente($idcliente);
		$idusuario = $cliente['usuario_idusuario'];
		$saldos = $this->Conta_model->getConta($idusuario);
		$saldoCotas = $this->Cota_model->getSaldoMyCotas($idusuario);
		$saldoInvestimentos = $this->Investimento_model->getSaldoInvestimentosCliente($idusuario);
		$movimentos = $this->Movimento_model->getMovimentosCliente($idusuario);
		$cotas = $this->Cota_model->getMyCotas($idusuario);
		$rendimentos = $this->Rendimento_model->getRendimentosCliente($idusuario);
		$investimentos = $this->Investimento_model->getInvestimentosCliente($idusuario);
		$txAdm = $this->Sistema_model->getTxAdmCota();
		$dados = array('cliente' => $cliente, 'saldos' => $saldos , 'movimentos' => $movimentos, 'cotas' => $cotas, 'rendimentos' => $rendimentos, 'saldoCotas' => $saldoCotas, 'saldoInvestimentos' => $saldoInvestimentos, 'investimentos' => $investimentos, 'txAdm' => $txAdm);
		$this->load->view('admin/perfil_cliente', $dados);
	}

	public function mostrarDadosCliente()
	{
		# code...
		$idcliente = $this->input->get('cliente');
		$cliente = $this->Cliente_model->getCliente($idcliente);
		$contaSaque = $this->ContaSaque_model->getContaSaque($cliente['idcliente']);
		$bancos = $this->Banco_model->getBancos();
		$dados = array('cliente' => $cliente, 'contaSaque' => $contaSaque, 'bancos' => $bancos);
		$this->load->view('admin/dados_cliente', $dados);
	}

	public function updateDadosCliente()
	{
		# code...
		$idcliente = $this->input->post('idCliente');
		$email = $this->input->post('email');
		$nome = $this->input->post('nome');
		$this->Cliente_model->updateDadosCliente($idcliente, $email, $nome);
		redirect('Admin_Controller/mostrarDadosCliente?cliente='.$idcliente);
	}

	public function updateContaSaqueCliente()
	{
		# code...
		$contaSaque = new ContaSaque();
		$contaSaque->banco_idbanco = $this->input->post('banco');
		$contaSaque->agencia = $this->input->post('agencia');
		$contaSaque->conta = $this->input->post('conta');
		$contaSaque->tipo = $this->input->post('tipo');
		$contaSaque->cliente_idcliente = $this->input->post('idClienteContaSaque');
		$this->ContaSaque_model->updateContaSaque($contaSaque);
	}

	public function novaCota(){
		$clientes = $this->Cliente_model->getClientes();
		$dados = array('clientes' => $clientes);
		$this->load->view('admin/nova_cota', $dados);
	}

	public function cotas(){
		$cotas = $this->Cota_model->getCotas();
		$txAdm = $this->Sistema_model->getTxAdmCota();
		$dados = array('cotas' => $cotas, 'txAdm' => $txAdm);
		$this->load->view('admin/cotas', $dados);
	}

	public function minhasCotas(){
		$cotas = $this->Cota_model->getMyCotas($this->session->userdata('usuario_logado')['idusuario']);
		$txAdm = $this->Sistema_model->getTxAdmCota();
		$dados = array('cotas' => $cotas, 'txAdm' => $txAdm);
		$this->load->view('cliente/cotas', $dados);
	}

	public function novoRendimento(){
		$this->load->view('admin/novo_rendimento');
	}

	public function sistema()
	{
		# code...
		$sistema = $this->Sistema_model->getDadosSistema();
		$this->load->view('admin/sistema', $sistema);
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
