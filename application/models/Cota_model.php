<?php 


class Cota_model extends CI_Model {

		public function cadastrarCota($cota){
			$this->db->insert('cota', $cota);
		}

		public function getCotas(){
			$this->db->select('nome, valor, dataCompra, dataFechamento, rendimento');
			$this->db->from('cota');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->join('cliente', 'idcliente = cliente_idcliente');
			return $this->db->get()->result_array();
		}

		public function getMyCotas($idusuario){
			$this->db->select('valor, dataCompra, dataFechamento, rendimento');
			$this->db->from('cota');
			$this->db->where('status = 1');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			return $this->db->get()->result_array();
		}

		public function getCotasCliente($idcliente){
			$this->db->select('nome, valor, dataCompra, dataFechamento, rendimento');
			$this->db->from('cota');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->join('cliente', 'idcliente = cliente_idcliente');
			$this->db->where('idcliente', $idcliente);
			return $this->db->get()->result_array();
		}

		public function getTotalCotas()
		{
			# code...
			$this->db->select('SUM(valor) as total');
			$this->db->from('cota');
			$this->db->where('status = 1');
			return $this->db->get()->row_array();
		}

		public function getTotalCotasAdmin($idusuario)
		{
			# code...
			$this->db->select('SUM(valor) as total');
			$this->db->from('cota');
			$this->db->join('conta', 'conta_idconta = idconta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			$this->db->where('status = 1');
			return $this->db->get()->row_array();
		}
		
}