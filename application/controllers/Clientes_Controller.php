<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->isUsuarioLogado();
		$this->load->library('Cliente');
		$this->load->library('Usuario');
		$this->load->library('Conta');
		$this->load->library('ContaSaque');
		$this->load->model('Usuario_model');
		$this->load->model('Cliente_model');
		$this->load->model('Conta_model');
		$this->load->model('Cota_model');
		$this->load->model('ContaSaque_model');
		$this->load->model('Banco_model');
		$this->load->model('Movimento_model');
		$this->load->model('Rendimento_model');
		$this->load->model('Investimento_model');
	}

	public function isUsuarioLogado(){
		if(!$this->session->userdata('usuario_logado')){
			$this->session->set_flashdata('danger', 'Sua sessão expirou ou você não está logado! Por favor efetue o login!');
			redirect('/');
		}
	}

	public function index(){
		$idusuario = $this->session->userdata('usuario_logado')['idusuario'];
		$saldos = $this->Conta_model->getConta($idusuario);
		$saldoCotas = $this->Cota_model->getSaldoMyCotas($idusuario);
		$saldoInvestimentos = $this->Investimento_model->getSaldoInvestimentosCliente($idusuario);
		$investimentos = $this->Investimento_model->getInvestimentosCliente($idusuario);
		$movimentos = $this->Movimento_model->getMovimentosCliente($idusuario);
		$cotas = $this->Cota_model->getMyCotas($idusuario);
		$rendimentos = $this->Rendimento_model->getRendimentosCliente($idusuario);
		$dados = array('saldos' => $saldos , 'movimentos' => $movimentos, 'cotas' => $cotas, 'rendimentos' => $rendimentos, 'saldoCotas' => $saldoCotas, 'saldoInvestimentos' => $saldoInvestimentos, 'investimentos' => $investimentos);
		$this->load->view('cliente/index', $dados);
	}

	public function cadastrarCliente(){
		$this->isAdmin();
		$usuario = new Usuario();
		$usuario->login = $this->input->post('email');
		$usuario->senha = md5($this->input->post('senha'));
		$usuario->tipo = 2; 
		$cliente = new Cliente();
		$cliente->nome = $this->input->post('nome');
		$cliente->email = $this->input->post('email');
		$cliente->cpf = $this->input->post('cpf');
		$idusuario = $this->Usuario_model->cadastrarUsuario($usuario);
		$cliente->usuario_idusuario = $idusuario;
		$idcliente = $this->Cliente_model->cadastrarCliente($cliente);
		$this->cadastrarContaCliente($idcliente, $idusuario);
	}

	public function cadastrarContaCliente($idcliente, $idusuario){
		$this->isAdmin();
		$conta = new Conta();
		$conta->saldo = 0;
		$conta->saldoSaque = 0;
		$conta->saldoBloqueado = 0;
		$conta->cliente_idcliente = $idcliente;
		$conta->cliente_usuario_idusuario = $idusuario;
		$this->Conta_model->cadastrarConta($conta);
		redirect('Admin_Controller/clientes');
	}

	public function saque(){
		$this->load->view('cliente/saque');
	}

	public function minhasCotas(){
		$cotas = $this->Cota_model->getMyCotas($this->session->userdata('usuario_logado')['idusuario']);
		$dados = array('cotas' => $cotas);
		$this->load->view('cliente/cotas', $dados);
	}

	public function minhaConta(){
		$idusuario = $this->session->userdata('usuario_logado')['idusuario'];
		$cliente = $this->Cliente_model->getClienteByUser($idusuario);
		$contaSaque = $this->ContaSaque_model->getContaSaque($cliente['idcliente']);
		$bancos = $this->Banco_model->getBancos();
		$dados = array('cliente' => $cliente, 'contaSaque' => $contaSaque, 'bancos' => $bancos);
		$this->load->view('cliente/minha_conta', $dados);
	}

	public function contaSaque()
	{
		# code...
		$bancos = $this->Banco_model->getBancos();
		$dados = array('bancos' => $bancos );
		$this->load->view('cliente/conta_saque', $dados);
	}

	public function cadastrarContaSaque()
	{
		# code...
		$contaSaque = new ContaSaque();
		$cliente = $this->Cliente_model->getClienteByUser($this->session->userdata('usuario_logado')['idusuario']);
		$contaSaque->banco_idbanco = $this->input->post('banco');
		$contaSaque->agencia = $this->input->post('agencia');
		$contaSaque->conta = $this->input->post('conta');
		$contaSaque->tipo = $this->input->post('tipo');
		$contaSaque->cliente_idcliente = $cliente['idcliente'];
		$this->ContaSaque_model->cadastrarContaSaque($contaSaque);
		redirect('Clientes_Controller/minhaConta');
		
	}

	public function updateContaSaque()
	{
		# code...
		$cliente = $this->Cliente_model->getClienteByUser($this->session->userdata('usuario_logado')['idusuario']);
		$contaSaque = new ContaSaque();
		$contaSaque->banco_idbanco = $this->input->post('banco');
		$contaSaque->agencia = $this->input->post('agencia');
		$contaSaque->conta = $this->input->post('conta');
		$contaSaque->tipo = $this->input->post('tipo');
		$contaSaque->cliente_idcliente = $cliente['idcliente'];
		$this->ContaSaque_model->updateContaSaque($contaSaque);
	}

	public function alterarSenha()
	{
		# code...
		$this->load->view('cliente/alterar_senha');
	}

	public function updateSenha()
	{
		# code...
		$idusuario = $this->session->userdata('usuario_logado')['idusuario'];
		$senha = md5($this->input->post('senha'));
		$this->Usuario_model->updateSenha($idusuario, $senha);
		redirect('Clientes_Controller/minhaConta');
	}

	public function updateDados()
	{
		# code...
		$idusuario = $this->session->userdata('usuario_logado')['idusuario'];
		$email = $this->input->post('email');
		$nome = $this->input->post('nome');
		$this->Cliente_model->updateDados($idusuario, $email, $nome);
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
