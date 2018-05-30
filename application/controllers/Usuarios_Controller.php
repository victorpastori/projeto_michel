<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_Controller extends CI_Controller {

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
		$this->load->model('Sistema_model');
	}

	public function index()
	{
		//$this->redirectUsuarioLogado();
		$this->load->view('public/index');
	}

	public function isUsuarioLogado(){
		if($this->session->userdata('usuario_logado')){
			if ($this->session->userdata('usuario_logado')['tipo'] == 1) {
						redirect('Admin_Controller/index');
				}else {
						redirect('Clientes_Controller/index');
				}
		}
	}

	public function firstAccess($usuario)
	{
		# code...
		$usuario = $this->Usuario_model->buscaUsuarioLogin($usuario->login, $usuario->senha);
		var_dump($usuario);
		if ($usuario) {
			$this->session->set_userdata('usuario_logado', $usuario);
			$this->session->set_flashdata('success', 'Logado com sucesso!');
		}else{
			$this->session->set_flashdata('erroLogin', 'Usuário ou senha inválidos!');
			redirect('/');
		}
		if ($this->session->userdata('usuario_logado')['tipo'] == 1) {
				redirect('Admin_Controller/index');
		}else {
				redirect('Clientes_Controller/index');
		}
	}

	public function autenticar(){
		$login = $this->input->post('login');
		$senha = md5($this->input->post('senha'));

		$usuario = $this->Usuario_model->buscaUsuarioLogin($login, $senha);
		var_dump($usuario);
		if ($usuario) {
			$this->session->set_userdata('usuario_logado', $usuario);
			$this->session->set_flashdata('success', 'Logado com sucesso!');
		}else{
			$this->session->set_flashdata('erroLogin', 'Usuário ou senha inválidos!');
			redirect('/');
		}
		if ($this->session->userdata('usuario_logado')['tipo'] == 1) {
				redirect('Admin_Controller/index');
		}else {
				redirect('Clientes_Controller/index');
		}
	}

	public function alterarSenha(){
		$idusuario = $this->session->userdata('usuario_logado')['idusuario'];
		$senha = $this->input->post('senha');
		$this->Usuario_model->updateSenha($idusuario, $senha);
	}

	public function redirectUsuarioLogado(){
		if($this->session->userdata('usuario_logado')){
			if ($this->session->userdata('usuario_logado')['tipo'] == 1) {
				redirect('Admin_Controller/index');
		}else {
				redirect('Clientes_Controller/index');
		}
		}else{
			$this->load->view('public/index');
		}
	}

	public function novoCliente(){
		$bancos = $this->Banco_model->getBancos();
		$dados = array('bancos' => $bancos );
		$this->load->view('public/novo_cliente', $dados);
	}

	public function registrarNovoCliente(){
		//$this->isLoged();
		$usuario = new Usuario();
		$usuario->login = $this->input->post('email');
		$usuario->senha = md5($this->input->post('senha'));
		$usuario->tipo = 2; 
		$cliente = new Cliente();
		$cliente->nome = $this->input->post('nome');
		$cliente->email = $this->input->post('email');
		$cliente->cpf = $this->input->post('txtCPF');
		$cliente->telefone = $this->input->post('telefone');
		$cliente->celular = $this->input->post('celular');
		$contaSaque = new ContaSaque();
		$contaSaque->banco_idbanco = $this->input->post('banco');
		$contaSaque->agencia = $this->input->post('agencia');
		$contaSaque->conta = $this->input->post('conta');
		$contaSaque->tipo = $this->input->post('tipo');
		$contaSaque->operacao = $this->input->post('operacao');
		$contaSaque->digito = $this->input->post('digito');
		if($this->existeUsuario($usuario->login)){
			$this->session->set_flashdata('error', 'Login já existente no sistema! Use outro Email!');
			redirect('Admin_Controller/novoCliente');
		}

		if($this->existeCpf($cliente->cpf)){
			$this->session->set_flashdata('error', 'CPF já cadastrado no sistema!');
			redirect('Admin_Controller/novoCliente');
		}
		
		$idusuario = $this->Usuario_model->cadastrarUsuario($usuario);
		$cliente->usuario_idusuario = $idusuario;
		$idcliente = $this->Cliente_model->cadastrarCliente($cliente);
		$contaSaque->cliente_idcliente = $idcliente;
		$this->cadastrarContaSaque($contaSaque);
		$this->cadastrarContaCliente($idcliente, $idusuario);
		$this->firstAccess($usuario);
	}

	public function existeUsuario($email){
		return $this->Usuario_model->existeEmail($email);
	}	

	public function existeCpf($cpf){
		return $this->Cliente_model->existeCpf($cpf);
	}

	public function cadastrarContaCliente($idcliente, $idusuario){
		//$this->isLoged();
		$conta = new Conta();
		$conta->saldo = 0;
		$conta->saldoSaque = 0;
		$conta->saldoBloqueado = 0;
		$conta->cliente_idcliente = $idcliente;
		$conta->cliente_usuario_idusuario = $idusuario;
		$this->Conta_model->cadastrarConta($conta);
		$this->session->set_flashdata('success', 'Cliente cadastrado com sucesso!');
	}

	public function cadastrarContaSaque($contaSaque)
	{
		# code...
		$this->ContaSaque_model->cadastrarContaSaque($contaSaque);
		
	}

	public function isLoged()
	{
		# code...
		if ($this->session->userdata('usuario_logado')) {
			# code...
			redirect('Clientes_Controller/index');
		}
	}
}
