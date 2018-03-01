<?php 


class Investimento_model extends CI_Model {

		public function cadastrarInvestimento($investimento){
			$this->db->insert('investimento', $investimento);
		}

		public function aplicarRendimento($rendimento){

		}

		public function getInvestimentos(){

		}

		public function getInvestimentosCliente(){

		}

		public function attStatusInvestimento(){

		}
		
}