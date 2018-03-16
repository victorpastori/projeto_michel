<?php 


class Rendimento_model extends CI_Model {

		public function cadastrarRendimento($rendimentos){
			$this->db->insert_batch('rendimento', $rendimentos);
		}

		public function getRendimentos(){
			$this->db->select('*');
			$this->db->from('rendimento');
			$this->db->join('tipo_rendimento', 'idtipo_rendimento = tipo_rendimento_idtipo_rendimento');
			$this->db->order_by('data', 'DESC');
			return $this->db->get()->result_array();
		}

		public function getRendimentosCliente($idusuario){
			$this->db->select('SUM(valor) as total, MONTH(data) as month, YEAR(data) as year, tipo, percentual');
			$this->db->from('rendimento');
			$this->db->join('tipo_rendimento', 'idtipo_rendimento = tipo_rendimento_idtipo_rendimento');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			$this->db->order_by('MONTH(data)', 'DESC');
			$this->db->order_by('MONTH(year)', 'DESC');
			$this->db->group_by('MONTH(data), YEAR(data), tipo, percentual');
			return $this->db->get()->result_array();
		}

		public function getRendimentosNoAdmin($idusuario){
			$this->db->select('SUM(valor) as total, MONTH(data) as month, YEAR(data) as year');
			$this->db->from('rendimento');
			$this->db->join('tipo_rendimento', 'idtipo_rendimento = tipo_rendimento_idtipo_rendimento');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->where('cliente_usuario_idusuario !=', $idusuario);
			$this->db->order_by('MONTH(data)', 'DESC');
			$this->db->order_by('MONTH(year)', 'DESC');
			$this->db->group_by('MONTH(data), YEAR(data)');
			return $this->db->get()->result_array();
		}

		public function getSumAllRendimentosAdmin($idusuario){
			$this->db->select('SUM(valor) as total, MONTH(data) as month, YEAR(data) as year');
			$this->db->from('rendimento');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->where('cliente_usuario_idusuario =', $idusuario);
			$this->db->order_by('MONTH(data)', 'DESC');
			$this->db->order_by('MONTH(year)', 'DESC');
			$this->db->group_by('MONTH(data), YEAR(data)');
			return $this->db->get()->result_array();
		}

		public function getSumAllRendimentos(){
			$this->db->select('SUM(r.valor) as total, SUM(c.valor) as totalComissao, MONTH(r.data) as month, YEAR(r.data) as year');
			$this->db->from('rendimento as r');
			$this->db->join('comissao as c', 'rendimento_idrendimento = idrendimento');
			$this->db->order_by('MONTH(r.data)', 'DESC');
			$this->db->order_by('MONTH(year)', 'DESC');
			$this->db->group_by('MONTH(r.data), YEAR(r.data)');
			return $this->db->get()->result_array();
		}
		
}