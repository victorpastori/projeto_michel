<?php 


class Comissao_model extends CI_Model {

		public function cadastrarComissao($comissao){
			$this->db->insert('comissao', $comissao);
		}

		public function getComissoes(){
			// apinel admin
		}
		
}