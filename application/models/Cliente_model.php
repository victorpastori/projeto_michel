<?php 


class Cliente_model extends CI_Model {


		public function existeCpf($cpf)
		{
			# code...
			$this->db->select('cpf');
			$this->db->from('cliente');
			$this->db->where('cpf', $cpf);
			return $this->db->get()->row_array();
		}

		public function cadastrarCliente($cliente){
			$this->db->insert('cliente', $cliente);
			return $this->db->insert_id();
		}

		public function getClientes(){
			$this->db->select('idcliente, nome, saldoSaque');
			$this->db->from('cliente');
			$this->db->join('conta', 'idcliente = cliente_idcliente');
			$this->db->order_by('nome', 'ASC');
			return $this->db->get()->result_array();
		}

		public function getClientes2(){
			$this->db->distinct();
			$this->db->select('idcliente, idcota, idinvestimento, nome, saldoSaque, cota.valor as valorC, investimento.valor as valorI');
			$this->db->from('cliente');
			$this->db->join('conta', 'idcliente = cliente_idcliente', 'inner');
			$this->db->join('cota', 'idconta = cota.conta_idconta', 'inner');
			$this->db->join('investimento', 'cota.conta_idconta = investimento.conta_idconta', 'inner');
			$this->db->where('cota.status = 1 and investimento.status != 2');
			//$this->db->group_by('idconta');
			$this->db->order_by('nome', 'ASC');
			return $this->db->get()->result_array();
		}

		public function getCliente($idcliente){
			$this->db->select('idcliente, cpf, nome, telefone,celular, email, saldo, usuario_idusuario');
			$this->db->from('cliente');
			$this->db->join('conta', 'idcliente = cliente_idcliente');
			$this->db->where('idcliente', $idcliente);
			return $this->db->get()->row_array();
		}

		public function getClienteByUser($idusuario){
			$this->db->select('*');
			$this->db->from('cliente');
			$this->db->where('usuario_idusuario', $idusuario);
			return $this->db->get()->row_array();
		}

		public function updateDados($idusuario, $cliente)
		{
			# code...
			$this->db->set('email', $cliente->email);
			$this->db->set('nome', $cliente->nome);
			$this->db->set('telefone', $cliente->telefone);
			$this->db->set('celular', $cliente->celular);
			$this->db->where('usuario_idusuario', $idusuario);
			$this->db->update('cliente');
		}

		public function updateDadosCliente($idcliente, $cliente)
		{
			# code...
			$this->db->set('email', $cliente->email);
			$this->db->set('nome', $cliente->nome);
			$this->db->set('telefone', $cliente->telefone);
			$this->db->set('celular', $cliente->celular);
			$this->db->where('idcliente', $idcliente);
			$this->db->update('cliente');
		}

		public function getIDuserByCliente($idcliente)
		{
			# code...
			$this->db->select('usuario_idusuario');
			$this->db->from('cliente');
			$this->db->where('idcliente', $idcliente);
			return $this->db->get()->row_array();
		}
		
}