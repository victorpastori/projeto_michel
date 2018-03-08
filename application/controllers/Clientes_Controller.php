<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_Controller extends My_Controller {

	function __construct(){
		parent::__construct();
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
	}

	public function index(){
		$idusuario = $this->session->userdata('usuario_logado')['idusuario'];
		$saldos = $this->Conta_model->getConta($idusuario);
		$movimentos = $this->Movimento_model->getMovimentosCliente($idusuario);
		$cotas = $this->Cota_model->getMyCotas($idusuario);
		$rendimentos = $this->Rendimento_model->getRendimentosCliente($idusuario);
		$dados = array('saldos' => $saldos , 'movimentos' => $movimentos, 'cotas' => $cotas, 'rendimentos' => $rendimentos);
		$this->load->view('cliente/index', $dados);
	}

	public function cadastrarCliente(){
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

	public function alterarSenha()
	{
		# code...
		$this->load->view('cliente/alterar_senha');
	}

	public function updateSenha()
	{
		# code...
		$senha = $this->input->post('senha');
		$this->Usuario_model->updateSenha($senha);
		redirect(base_url("Clientes_Controller/minha_conta"));
	}
}
