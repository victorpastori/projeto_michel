<?php 


class Sistema_model extends CI_Model {

		public function updateDadosSistema()
		{
			# code...
		}

		public function getDadosSistema()
		{
			# code...
			$this->db->select('*');
			$this->db->from('sistema');
			return $this->db->get()->row_array();
		}
		
}