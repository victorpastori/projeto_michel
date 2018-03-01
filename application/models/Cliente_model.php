<?php 


class Cliente_model extends CI_Model {

		public function cadastrarCliente($cliente){
			$this->db->insert('cliente', $cliente);
		}

		public function getClientes(){
			$this->db->select('idcliente, nome, saldo');
			$this->db->from('cliente');
			$this->db->join('conta', 'idcliente = cliente_idcliente');
			return $this->db->get()->resul_array();
		}

		public function getCliente($idcliente){
			$this->db->select('nome, saldo');
			$this->db->from('cliente');
			$this->db->join('conta', 'idcliente = cliente_idcliente');
			$this->db->where('idcliente', $idcliente)
			return $this->db->get()->resul_array();
		}
		
}