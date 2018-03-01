<?php 


class Usuario_model extends CI_Model {

		public function cadastrarUsuario($usuario){
			$this->db->insert('usuario', $usuario);
		}

		public function updateSenha($senha){
			$this->db->set('senha', $senha, FALSE);
			$this->db->update('usuario');
		}

	 	public function buscaUsuarioLogin($email, $senha){
		    $this->db->where('email', $email);
		    $this->db->where('senha', $senha);
		    $usuario = $this->db->get('usuario')->row_array();
		    return $usuario;
		}

		public function autenticar(){
			
		}

		public function logout(){

		}
		
}