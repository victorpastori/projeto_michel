<?php 


class Movimento_model extends CI_Model {

		public function cadastrarMovimento($movimento){
			$this->db->insert('movimento', $movimento);
		}

		public function getAllMovimentos(){
			$this->db->select('*');
			$this->db->from('movimento');
			$this->db->join('tipo_movimento', 'idtipo_movimento = tipo_movimento_idtipo_movimento');
			$this->db->order_by('data', 'DESC');
			return $this->db->get()->result_array();
		}

		public function getMovimentosCliente($idusuario){
			$this->db->select('SUM(valor) as valor, data, tipo, status');
			$this->db->from('movimento');
			$this->db->join('tipo_movimento', 'idtipo_movimento = tipo_movimento_idtipo_movimento');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			$this->db->group_by('data, tipo, status');
			$this->db->order_by('data', 'DESC');
			return $this->db->get()->result_array();
		}

		public function attStatusSaque(){
			
		}

		public function getSaquesPendentes(){
			$this->db->select('nome, valor, data, tipo');
			$this->db->from('movimento');
			$this->db->where('status', 0);
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->join('cliente', 'idcliente = cliente_idcliente');
			$this->db->join('tipo_movimento', 'idtipo_movimento = tipo_movimento_idtipo_movimento');
			$this->db->where('idtipo_movimento', 2);
			$this->db->order_by('data', 'DESC');
			return $this->db->get()->result_array();
		}
		
}