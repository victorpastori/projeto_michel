<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->isUsuarioLogado();
		$this->isAdmin();
		$this->load->library('ContaSaque');
		$this->load->library('Cliente');
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
		$this->load->model('Usuario_model');
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
		$scalpins = $this->Movimento_model->getScalpindONormail();
		//$rendimentosAdminMensais = array_merge($rendimentosAdminMensais, $comissoes);

		$txAdm = $this->Sistema_model->getTxAdmCota();
		
		$dados = array('capitalTotal' =>$capitalTotal, 'capitalTotalAdmin' => $capitalTotalAdmin, 'saldoSaqueAdmin' => $saldoSaqueAdmin, 'movimentos' => $movimentos, 'cotas' => $cotas, 'rendimentos' => $rendimentos, 'rendimentosClientes' => $rendimentosClientes, 'comissoes' => $comissoes, 'rendimentosBrutos' => $rendimentosBrutos, 'rendimentosAdminMensais' => $rendimentosAdminMensais, 'saquesPendentes' => $saquesPendentes, 'txAdm' => $txAdm,'scalpins' => $scalpins);
		$this->load->view('admin/index.php', $dados);
	}

	public function deposito(){
		$clientes = $this->Cliente_model->getClientes();
		$dados = array('clientes' => $clientes);
		$this->load->view('admin/deposito', $dados);
	}

	public function cadastrarScalpin(){
		$this->load->view('admin/scalpins.php');
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

	public function alterarSenhaCliente()
	{
		# code...
		$idcliente = $this->input->get('idcliente');
		$dados = array('idcliente' => $idcliente);
		$this->load->view('admin/alterar_senha_cliente', $dados);
	}

	public function updateSenhaCliente()
	{
		# code...
		$idcliente = $this->input->post('idCliente');
		$idusuario = $this->Cliente_model->getIDuserByCliente($idcliente);
		$senha = md5($this->input->post('senha'));		
		var_dump($idcliente);
		var_dump($idusuario);
		$this->Usuario_model->updateSenha($idusuario['usuario_idusuario'], $senha);
		$this->session->set_flashdata('success', 'Senha alterada com sucesso!');
		redirect('Clientes_Controller/minhaConta');
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
		$cliente = new Cliente();
		$cliente->email = $this->input->post('email');
		$cliente->nome = $this->input->post('nome');
		$cliente->cpf = $this->input->post('cpf');
		$cliente->telefone = $this->input->post('telefone');
		$cliente->celular = $this->input->post('celular');
		$idusuario = $this->Cliente_model->getIDuserByCliente($idcliente);
		$this->Cliente_model->updateDadosCliente($idcliente, $cliente);
		$this->Usuario_model->updateDados($idusuario['usuario_idusuario'], $cliente->email);
		$this->session->set_flashdata('success', 'Dados atualizados com sucesso!');
		redirect('Admin_Controller/mostrarDadosCliente?cliente='.$idcliente);
	}

	public function updateContaSaqueCliente()
	{
		# code...
		$contaSaque = new ContaSaque();
		$idCliente = $this->input->post('idClienteContaSaque');
		$contaSaque->banco_idbanco = $this->input->post('banco');
		$contaSaque->agencia = $this->input->post('agencia');
		$contaSaque->conta = $this->input->post('conta');
		$contaSaque->tipo = $this->input->post('tipo');
		$contaSaque->operacao = $this->input->post('operacao');
		$contaSaque->digito = $this->input->post('digito');
		$contaSaque->cliente_idcliente = $idCliente;
		var_dump($contaSaque);
		$this->ContaSaque_model->updateContaSaque($contaSaque);
		$this->session->set_flashdata('success', 'Conta Saque atualizada!');
		redirect('Admin_Controller/mostrarDadosCliente?cliente='.$idCliente);
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
