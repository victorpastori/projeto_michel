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

		public function getTxAdmRend()
		{
			# code...
			$this->db->select('valorAdmRend');
			$this->db->from('sistema');
			return $this->db->get()->row_array();
		}

		public function getTxAdmCota()
		{
			# code...
			$this->db->select('valorAdmCota');
			$this->db->from('sistema');
			return $this->db->get()->row_array();
		}

		public function insereBanco($banco)
		{
			# code...
			$this->db->insert('banco', $banco);
		}
		
}