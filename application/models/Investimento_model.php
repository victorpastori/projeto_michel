<?php 


class Investimento_model extends CI_Model {

		public function cadastrarInvestimento($investimento){
			$this->db->insert('investimento', $investimento);
		}

		public function aplicarRendimento($rendimento){
			$this->db->set('valor', "valor+valor*$rendimento", FALSE);
			$this->db->set('carenciaRestante', 'carenciaRestante-1', FALSE);
			$this->db->where('status', 1);
			$this->db->update('investimento');
		}

		public function aplicarRendimentoParciais($valor, $status, $idinvestimento){
			$this->db->set('valor', $valor, FALSE);
			$this->db->set('status', $status, FALSE);
			$this->db->where('idinvestimento', $idinvestimento);
			$this->db->update('investimento');
		}
		
		public function getInvestimentos($idusuario){
			
		}

		public function getInvestimentosCliente($idusuario){
			$this->db->select('*');
			$this->db->from('investimento');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			//$this->db->where('status !=', 2);
			$this->db->order_by('data', 'DESC');
			return $this->db->get()->result_array();
		}

		public function getSaldoInvestimentosCliente($idusuario){
			$this->db->select('SUM(valor) as total');
			$this->db->from('investimento');
			$this->db->join('conta', 'idconta = conta_idconta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			$this->db->where('status !=', 2);
			return $this->db->get()->row_array();
		}

		public function getSaldoInvestimentosAllClientes(){
			$this->db->select('nome, SUM(valor) as total');
			$this->db->from('cliente');
			$this->db->join('conta', 'idcliente = cliente_idcliente', 'left');
			$this->db->join('investimento', 'idconta = conta_idconta', 'left');
			$this->db->group_by('nome');
			$this->db->order_by('nome', 'ASC');
			return $this->db->get()->result_array();
		}

		public function getSaldoInvestimentosEncerradosAllClientes(){
			$this->db->select('nome, SUM(valor) as total');
			$this->db->from('cliente');
			$this->db->join('conta', 'idcliente = cliente_idcliente', 'left');
			$this->db->join('historico_investimento', 'idconta = conta_idconta', 'left');
			$this->db->group_by('nome');
			$this->db->order_by('nome', 'ASC');
			return $this->db->get()->result_array();
		}

		public function getInvestimentosAtivos(){
			$this->db->select('*');
			$this->db->from('investimento');
			$this->db->where('status', 1);
			$this->db->order_by('data', 'DESC');
			return $this->db->get()->result_array();
		}

		public function getInvestimentosParciais(){
			$this->db->select('*');
			$this->db->from('investimento');
			$this->db->where('status', 0);
			$this->db->order_by('data', 'DESC');
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
			$this->db->where('cliente_usuario_idusuario =', $idusuario);
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

		public function getTotalInvestimentosAtivos(){
			$this->db->select('SUM(valor) as total');
			$this->db->from('investimento');
			$this->db->where('status = 1');
			return $this->db->get()->row_array();
		}

		public function getTotalInvestimentosInativos(){
			$this->db->select('SUM(valor) as total');
			$this->db->from('investimento');
			$this->db->where('status = 0');
			return $this->db->get()->row_array();
		}
		
}