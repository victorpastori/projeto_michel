<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function cadastrarUsuario(){

		$this->usuario->email = $this->input->post('email');
		$this->usuario->nome = $this->input->post('nome');
		$this->usuario->senha = md5($this->input->post('senha'));
		$this->Usuario_model->cadastrarUsuario($this->usuario);
		$this->load->view('public/cad-pergunta.php');
	}

	public function autenticar(){
		$email = $this->input->post('email');
		$senha = md5($this->input->post('senha'));

		$usuario = $this->Usuario_model->buscaUsuarioLogin($email, $senha);
		if ($usuario) {
			$this->session->set_userdata('usuario_logado', $usuario);
			$this->session->set_flashdata('success', 'Logado com sucesso!');
		}else{
			$this->session->set_flashdata('danger', 'Usuário ou senha inválidos!');
		}

		redirect('/');
	}

	public function logout(){
		$this->session->unset_userdata("usuario_logado");
		$this->session->set_flashdata('success', 'Deslogado com sucesso!');
		redirect('/');
	}
}
