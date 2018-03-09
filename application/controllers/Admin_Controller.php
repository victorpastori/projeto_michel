<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends My_Controller {

	function __construct(){
		parent::__construct();
		$this->isAdmin();
		$this->load->model('Cliente_model');
		$this->load->model('Cota_model');
		$this->load->model('Conta_model');
		$this->load->model('Movimento_model');
		$this->load->model('Investimento_model');
		$this->load->model('Rendimento_model');
		$this->load->model('Sistema_model');
	}

	public function da(){
		
	}

	public function index(){
		$idusuario = $this->session->userdata('usuario_logado')['idusuario'];

		$capitalTotal = $this->Conta_model->getTotalCapital();
		$capitalTotalAdmin = $this->Conta_model->getTotalCapitalAdmin($idusuario);
		$totalInvestimento = $this->Investimento_model->getTotalInvestimentos();
		$totalInvestimentoAdmin = $this->Investimento_model->getTotalInvestimentosAdmin($idusuario);

		$capitalTotal = $capitalTotal['saldo']+$capitalTotal['saldoBloqueado']+$totalInvestimento['total'];
		$capitalTotalAdmin = $capitalTotalAdmin['saldo']+$capitalTotalAdmin['saldoBloqueado']+$totalInvestimentoAdmin['total'];
		
		$movimentos = $this->Movimento_model->getMovimentosCliente($idusuario);

		$cotas = $this->Cota_model->getMyCotas($idusuario);

		$rendimentos = $this->Rendimento_model->getRendimentosCliente($idusuario);
		$rendimentosClientes = $this->Rendimento_model->getRendimentosNoAdmin($idusuario);
		$rendimentoTotal;
		$lucroTotalEmpresa;
		
		$comissoes;
		$dados = array('capitalTotal' =>$capitalTotal, 'capitalTotalAdmin' => $capitalTotalAdmin, 'movimentos' => $movimentos, 'cotas' => $cotas, 'rendimentos' => $rendimentos, 'rendimentosClientes' => $rendimentosClientes);
		$this->load->view('admin/index.php', $dados);
	}

	public function deposito(){
		$clientes = $this->Cliente_model->getClientes();
		$dados = array('clientes' => $clientes);
		$this->load->view('admin/deposito', $dados);
	}

	public function clientes(){
		$clientes = $this->Cliente_model->getClientes();
		$dados = array('clientes' => $clientes);
		$this->load->view('admin/clientes', $dados);
	}

	public function novoCliente(){
		$this->load->view('admin/novo_cliente');
	}

	public function buscarCliente(){
		$clientes = $this->Cliente_model->getClientes();
		$dados = array('clientes' => $clientes);
		$this->load->view('admin/buscar_cliente', $dados);
	}

	public function mostrarCliente(){
		$idcliente = $this->input->post('cliente');
		$cliente = $this->Cliente_model->getCliente($idcliente);
		$idusuario = $cliente['usuario_idusuario'];
		$saldos = $this->Conta_model->getConta($idusuario);
		$movimentos = $this->Movimento_model->getMovimentosCliente($idusuario);
		$cotas = $this->Cota_model->getMyCotas($idusuario);
		$rendimentos = $this->Rendimento_model->getRendimentosCliente($idusuario);
		$dados = array('cliente' => $cliente, 'saldos' => $saldos , 'movimentos' => $movimentos, 'cotas' => $cotas, 'rendimentos' => $rendimentos);
		$this->load->view('admin/perfil_cliente', $dados);
	}

	public function novaCota(){
		$clientes = $this->Cliente_model->getClientes();
		$dados = array('clientes' => $clientes);
		$this->load->view('admin/nova_cota', $dados);
	}

	public function cotas(){
		$cotas = $this->Cota_model->getCotas();
		$dados = array('cotas' => $cotas);
		$this->load->view('admin/cotas', $dados);
	}

	public function minhasCotas(){
		$cotas = $this->Cota_model->getMyCotas($this->session->userdata('usuario_logado')['idusuario']);
		$dados = array('cotas' => $cotas);
		$this->load->view('admin/cotas', $dados);
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
