<?php 


class Sistema_model extends CI_Model {

		public function updateDados($sistema)
		{
			# code...
			$this->db->set('valorAdmCota', $sistema->valorAdmCota);
			$this->db->set('valorAdmRend', $sistema->valorAdmRend);
			$this->db->set('diaInicialRendimento', $sistema->diaInicialRendimento);
			$this->db->where('idsistema', 1);
			$this->db->update('sistema');
		}

		public function getDadosSistema()
		{
			# code...
			$this->db->select('*');
			$this->db->from('sistema');
			return $this->db->get()->row_array();
		}
		
}