<?php 


class Conta_model extends CI_Model {

		public function cadastrarConta($conta){
			$this->db->insert('conta', $conta);
		}

		public function getConta($idusuario)
			$this->db->select('*');
			$this->db->from('conta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			return $this->db->get()->resul_array();
		}

		public function getContas()
			$this->db->select('*');
			$this->db->from('conta');
			return $this->db->get()->resul_array();
		}

		public function aplicarRendimento($rendimento){
			
		}
		

		public function updateSaldo($valor){
			
		}

		public function depositarInvestimento(){
			
		}
}