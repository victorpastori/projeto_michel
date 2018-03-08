<?php 


class Conta_model extends CI_Model {

		public function cadastrarConta($conta){
			$this->db->insert('conta', $conta);
		}

		public function getIdContaByCliente($idcliente){
			$this->db->select('idconta');
			$this->db->from('conta');
			$this->db->where('cliente_idcliente', $idcliente);
			$data = $this->db->get()->row_array();
			return $data['idconta'];
		}

		public function getIdConta($idusuario){
			$this->db->select('idconta');
			$this->db->from('conta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			$result = $this->db->get()->row_array();
			return $result['idconta'];
		}


		public function getConta($idusuario){
			$this->db->select('*');
			$this->db->from('conta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			return $this->db->get()->row_array();
		}

		// PEGAR CONTAS PARA APLICAR RENDIMENTO MENSAL
		public function getContas(){
			$this->db->select('*');
			$this->db->from('conta');
			return $this->db->get()->result_array();
		}

		public function aplicarRendimento($rendimento){
			$this->db->set('saldo', "saldo+saldo*$rendimento", FALSE);
			$this->db->set('saldoSaque', "saldoSaque+saldoSaque*$rendimento", FALSE);
			$this->db->update('conta');
		}
		

		public function updateSaldoDeposito($valor, $idconta){
			$this->db->set('saldoBloqueado', 'saldoBloqueado+'.$valor, FALSE);
			$this->db->where('idconta', $idconta);
			$this->db->update('conta');
		}

		public function updateSaldoSaque($valor, $idconta){
			$this->db->set('saldo', 'saldo-'.$valor, FALSE);
			$this->db->set('saldoSaque', 'saldoSaque-'.$valor, FALSE);
			$this->db->where('idconta', $idconta);
			$this->db->update('conta');
		}

		public function depositarInvestimento(){
			
		}

		public function getTotalCapitalAdmin($idusuario)
		{
			# code...
			$this->db->select('saldo, saldoBloqueado');
			$this->db->from('conta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			return $this->db->get()->row_array();
		}

		public function getTotalCapital()
		{
			# code...
			$this->db->select('SUM(saldo) as saldo, SUM(saldoBloqueado) as saldoBloqueado');
			$this->db->from('conta');
			return $this->db->get()->row_array();
		}
}