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

		public function getSaldoTotalConta()
		{
			# code...
			$this->db->select('saldoSaque, SUM(cota.valor) as totalCota, SUM(investimento.valor) as total.investimento');
			$this->db->from('conta, cota, investimento');
			$this->db->where('idconta = cota.conta_idconta AND idconta = investimento.conta_idconta');
			return $this->db->get()->result_array();
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
			$this->db->where('saldoSaque >', 0);
			return $this->db->get()->result_array();
		}

		public function aplicarRendimento($rendimento){
			//$this->db->set('saldo', "saldo+saldo*$rendimento", FALSE); // SALDO TOTAL SERÁ CALCULADO A PARTIR DOS INVESTIMENTOS E COTAS
			$this->db->set('saldoSaque', "saldoSaque+saldoSaque*$rendimento", FALSE);
			$this->db->where('idconta !=', 1);
			$this->db->update('conta');
		}
		
		public function aplicarRendimentoAdmin($rendimento){
			//$this->db->set('saldo', "saldo+saldo*$rendimento", FALSE); // SALDO TOTAL SERÁ CALCULADO A PARTIR DOS INVESTIMENTOS E COTAS
			$this->db->set('saldoSaque', "saldoSaque+saldoSaque*$rendimento", FALSE);
			$this->db->where('idconta', 1);
			$this->db->update('conta');
		}

		// ADICIONA VALOR DO DÉPÓSITADO AO SALDO BLOQUEADO (OBSOLETO)
		/*public function updateSaldoDeposito($valor, $idconta){
			$this->db->set('saldoBloqueado', 'saldoBloqueado+'.$valor, FALSE);
			$this->db->where('idconta', $idconta);
			$this->db->update('conta');
		}*/

		public function updateSaldoSaque($valor, $idconta){
			//$this->db->set('saldo', 'saldo-'.$valor, FALSE); // SALDO DEIXA DE SER USADO -- SALDO TOTAL SERÁ CALCULADO A PARTIR DOS INVESTIMENTOS E COTAS
			$this->db->set('saldoSaque', 'saldoSaque-'.$valor, FALSE);
			$this->db->where('idconta', $idconta);
			$this->db->update('conta');
		}

		public function depositarInvestimento(){
			
		}

		public function getSaldoSaqueAdmin($idusuario)
		{
			# code...
			$this->db->select('saldoSaque');
			$this->db->from('conta');
			$this->db->where('cliente_usuario_idusuario', $idusuario);
			return $this->db->get()->row_array();
		}

		public function getTotalCapital()
		{
			# code...
			$this->db->select('SUM(saldoSaque) as total');
			$this->db->from('conta');
			return $this->db->get()->row_array();
		}
}