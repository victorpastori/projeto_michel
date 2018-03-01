<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_Controller extends My_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('Cliente');
		$this->load->library('Usuario');
	}

	public function index(){
		$saldos;
		$movimentos;
		$cotas;
		$rendimentos;
		$dados = array('saldos' => $saldos , 'movimentos' => $movimentos, 'cotas' => $cotas, 'rendimentos' => $rendimentos);
		$this->load->view('welcome_message', $dados);
	}

	public function cadastrarCliente(){
		$usuario = new Usuario();
		$usuario->login = $this->input->post('email');
		$cliente->senha = $this->input->post('senha');
		$cliente->tipo = 2; 
		$cliente = new Cliente();
		$cliente->nome = $this->input->post('nome');
		$cliente->email = $this->input->post('email');
		$cliente->cpf = = $this->input->post('cpf');
		$idusuario = $this->Usuario_model->cadastrarUsuario($usuario);
		$cliente->usuario_idusuario = $idusuario;
		$idcliente = $this->Cliente_model->cadastrarCliente($cliente);
		$this->cadastrarContaCliente($idcliente);
	}

	public function cadastrarContaCliente($idcliente){
		$conta = new Conta();
		$conta->saldo = 0;
		$conta->saldoSaque = 0;
		$conta->saldoBloqueado = 0;
		$conta->cliente_idcliente = $idcliente;
		$this->Conta_model->cadastrarContaCliente($conta);
		redirect('/')
	}

	public function saque(){
		$this->load->view('cliente/saque');
	}

	public function minhasCotas(){
		$cotas = $this->Cota_model->getCotasCliente($idusuario);
		$this->load->view('cliente/cotas')
	}

	public function minhaConta(){
		$cliente = $this->Cliente_model->getCliente($idusuario);
		$contaSaque = $this->ContaSaque_model->getContaSaque($cliente->idcliente);
		$dados = array('cliente' => $cliente, 'contaSaque' => $contaSaque);
		$this->load->view('cliente/minhaConta', $dados);
	}
}
