<?php 


class ContaSaque_model extends CI_Model {

		public function cadastrarContaSaque($contaSaque){
			$this->db->insert('contaSaque', $contaSaque);
		}

		public function getContaSaque($idcliente){
			$this->db->select('*');
			$this->db->from('contaSaque');
			$this->db->join('banco', 'idbanco = banco_idbanco');
			$this->db->where('cliente_idcliente', $idcliente);
			return $this->db->get()->row_array();
		}

		public function updateContaSaque($contaSaque)
		{
			# code...
			$this->db->where('cliente_idcliente', $contaSaque->cliente_idcliente);
			$this->db->update('contaSaque', $contaSaque);
		}
		
}