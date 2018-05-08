<?php 


class Comissao_model extends CI_Model {

		public function cadastrarComissao($comissao){
			$this->db->insert('comissao', $comissao);
		}

		public function getComissoes(){
			// apinel admin
			$this->db->select('SUM(c.valor) as total, MONTH(r.data) as month, YEAR(r.data) as year ');
			$this->db->from('comissao as c');
			$this->db->join('rendimento as r', 'idrendimento = rendimento_idrendimento');
			$this->db->order_by('MONTH(r.data)', 'DESC');
			$this->db->order_by('MONTH(year)', 'DESC');
			$this->db->group_by('MONTH(r.data), YEAR(r.data)');
			return $this->db->get()->result_array();
		}
		
}