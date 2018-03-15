<?php 


class Usuario_model extends CI_Model {

		public function cadastrarUsuario($usuario){
			$this->db->insert('usuario', $usuario);
			return $this->db->insert_id();		}

		public function updateSenha($idusuario, $senha){
			$this->db->set('senha', $senha);
			$this->db->where('idusuario', $idusuario);
			$this->db->update('usuario');
		}

	 	public function buscaUsuarioLogin($login, $senha){
	 		$this->db->select('*');
	 		$this->db->from('usuario');
		    $this->db->where('login', $login);
		    $this->db->where('senha', $senha);
		    $usuario = $this->db->get()->row_array();
		    return $usuario;
		}

		public function autenticar(){
			
		}

		public function logout(){

		}
		
}