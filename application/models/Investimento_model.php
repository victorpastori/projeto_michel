<?php 


class Investimento_model extends CI_Model {

		public function cadastrarInvestimento($investimento){
			$this->db->insert('investimento', $investimento);
		}

		public function aplicarRendimento($rendimento){
			$this->db->set('valor', 'valor+'.$rendimento, FALSE);
			$this->db->where('status', 1);
			$this->db->update('investimento');
		}

		public function getInvestimentos(){

		}

		public function getInvestimentosCliente(){

		}

		public function getInvestimentosAtivos(){
			$this->db->select('*');
			$this->db->from('investimento');
			$this->db->where('status', 1);
			return $this->db->get()->result_array();
		}

		public function attStatusInvestimento(){

		}

		public function getTotalInvestimentosAdmin($idusuario)
		{
			# code...
			$this->db->select('SUM(valor) as total');
			$this->db->from('investimento');
			$this->db->join('conta', 'conta_idconta = idconta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			$this->db->where('status = 0 or status = 1');
			return $this->db->get()->row_array();
		}

		public function getTotalInvestimentos()
		{
			# code...
			$this->db->select('SUM(valor) as total');
			$this->db->from('investimento');
			$this->db->where('status = 0 or status = 1');
			return $this->db->get()->row_array();
		}
		
}