<?php 


class Banco_model extends CI_Model {

		public function getBancos()
		{
			# code...
			$this->db->select('*');
			$this->db->from('banco');
			$this->db->order_by('codigo');
			return $this->db->get()->result_array();
		}
		
}