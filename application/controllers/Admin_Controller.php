<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends My_Controller {

	function __construct(){
		parent::__construct();
	}

	public function da(){
		
	}

	public function index(){
		$saldos;
		$rendimentos;
		$saques;
		$this->load->view('welcome_message');
	}

	public function deposito(){
		$this->load->view('admin/deposito');
	}

	public function clientes(){
		$clientes = $this->Cliente_model->getClientes();
		$this->load->view('admin/clientes');
	}

	public function novoCliente(){
		$this->load->view('admin/novoCliente');
	}

	public function buscarCliente(){
		$this->load->view('admin/buscarCliente');
	}

	public function mostrarCliente(){
		$cliente;
		$saldos;
		$cotas;
		$rendimentos;
		$movimentos;
		$this->load->view('admin/buscarCliente');
	}

	public function novaCota(){
		$cotas = $this->Cota_model->getCotas();
		$this->load->view('admin/novaCota');
	}

	public function cotas(){
		$cotas = $this->Cota_model->getCotas();
		$this->load->view('admin/cotas');
	}

	public function novoRendimento(){
		$this->load->view('admin/novoRendimento');
	}
}
