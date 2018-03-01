<?php 


class Cota_model extends CI_Model {

		public function cadastrarCota($cota){
			$this->db->insert('cota', $cota);
		}

		public function getCotas(){
			$this->db->select('*');
			$this->db->from('cota');
			return $this->db->get()->resul_array();
		}

		public function getMyCotas($idusuario){
			$this->db->select('valor, dataCompra, dataFechamento, rendimento');
			$this->db->from('cota');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->where('cliente_usuario_idusuario', $idusuario)
			return $this->db->get()->resul_array();
		}

		public function getCotasCliente($idcliente){
			$this->db->select('valor, dataCompra, dataFechamento, rendimento');
			$this->db->from('cota');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->where('cliente_idcliente', $idcliente)
			return $this->db->get()->resul_array();
		}
		
}