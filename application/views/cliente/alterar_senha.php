<?php if ($this->session->userdata('usuario_logado')['tipo'] == 2) {
      $this->load->view('cabecalhoCliente');
    } else if ($this->session->userdata('usuario_logado')['tipo'] == 1){
      $this->load->view('cabecalhoAdmin');
    } ?>
<h2>Alterar minha senha</h2>
<form action="<?= base_url("index.php/Clientes_Controller/updateSenha")?>" method="post">
	<div class="form-group">
		<label for="inputSenha">Nova Senha</label>
    	<input type="password" class="form-control" name="senha" id="inputSenha" aria-describedby="emailHelp">
  	</div>
  	<div class="form-group">
		<label for="inputSenha2">Confirmar Nova Senha</label>
    	<input type="password" class="form-control" name="senha2" id="inputSenha2" aria-describedby="emailHelp">
  	</div>
  	<button type="submit" class="btn btn-primary">Alterar Senha</button>
</form>


<?php $this->load->view('rodape'); ?>