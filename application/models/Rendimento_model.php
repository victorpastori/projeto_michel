<?php 


class Rendimento_model extends CI_Model {

		public function cadastrarRendimento($rendimento){
			$this->db->insert_batch('rendimento', $rendimento);
		}

		public function getRendimentos(){
			// para painel admin
		}

		public function getRendimentosCliente($idusuario){
			
		}
		
}