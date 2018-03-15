<?php 


class Cliente_model extends CI_Model {

		public function cadastrarCliente($cliente){
			$this->db->insert('cliente', $cliente);
			return $this->db->insert_id();
		}

		public function getClientes(){
			$this->db->select('idcliente, nome, saldoSaque');
			$this->db->from('cliente');
			$this->db->join('conta', 'idcliente = cliente_idcliente');
			return $this->db->get()->result_array();
		}

		public function getCliente($idcliente){
			$this->db->select('idcliente, nome, email, saldo, usuario_idusuario');
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

		public function updateDados($idusuario, $email, $nome)
		{
			# code...
			$this->db->set('email', $email);
			$this->db->set('nome', $nome);
			$this->db->where('usuario_idusuario', $idusuario);
			$this->db->update('cliente');
		}
		
}