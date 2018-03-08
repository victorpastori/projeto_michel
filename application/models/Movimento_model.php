<?php 


class Movimento_model extends CI_Model {

		public function cadastrarMovimento($movimento){
			$this->db->insert('movimento', $movimento);
		}

		public function getAllMovimentos(){
			$this->db->select('*');
			$this->db->from('movimento');
			$this->db->join('tipo_movimento', 'idtipo_movimento = tipo_movimento_idtipo_movimento');
			return $this->db->get()->result_array();
		}

		public function getMovimentosCliente($idusuario){
			$this->db->select('valor, data, tipo, status');
			$this->db->from('movimento');
			$this->db->join('tipo_movimento', 'idtipo_movimento = tipo_movimento_idtipo_movimento');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			return $this->db->get()->result_array();
		}

		public function attStatusSaque(){
			
		}
		
}