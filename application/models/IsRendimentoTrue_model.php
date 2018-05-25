<?php 


class IsRendimentoTrue_model extends CI_Model {

		public function novo(){
			$data = array(
		        'status' => 1,
		        'data' => date("Y-m-d")
				);

			$this->db->insert('isRendimentoTrue', $data);
		}
		
}