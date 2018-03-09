<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Usuario_model');
	}

	public function index()
	{
		$this->load->view('public/index');
	}

	public function cadastrarUsuario(){

		$this->usuario->email = $this->input->post('email');
		$this->usuario->nome = $this->input->post('nome');
		$this->usuario->senha = md5($this->input->post('senha'));
		$this->Usuario_model->cadastrarUsuario($this->usuario);
		$this->load->view('public/cad-pergunta.php');
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
			$this->session->set_flashdata('danger', 'Usuário ou senha inválidos!');
			redirect('/');
		}
		if ($this->session->userdata('usuario_logado')['tipo'] == 1) {
				redirect('Admin_Controller/index');
		}else {
				redirect('Clientes_Controller/index');
		}
	}

	public function logout(){
		$this->session->unset_userdata("usuario_logado");
		$this->session->set_flashdata('success', 'Deslogado com sucesso!');
		redirect('/');
	}
}
