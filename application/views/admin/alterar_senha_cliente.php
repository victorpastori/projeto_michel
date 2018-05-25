<?php if ($this->session->userdata('usuario_logado')['tipo'] == 2) {
      $this->load->view('cabecalhoCliente');
    } else if ($this->session->userdata('usuario_logado')['tipo'] == 1){
      $this->load->view('cabecalhoAdmin');
    } ?>
<h2>Alterar senha do cliente</h2>
<form action="<?= base_url("index.php/Admin_Controller/updateSenhaCliente")?>" method="post">
	<div class="form-group">
    <input type="hidden" class="form-control"  name="idCliente" id="inputId" value="<?= $idcliente ?>">
		<label for="inputSenha">Nova Senha</label>
    	<input type="password" class="form-control" name="senha" id="inputSenha" aria-describedby="emailHelp" placeholder="Informe o número de sua agência">
  	</div>
  	<div class="form-group">
		<label for="inputSenha2">Confirmar Nova Senha</label>
    	<input type="password" class="form-control" name="senha2" id="inputSenha2" aria-describedby="emailHelp" placeholder="Informe o número de sua conta">
  	</div>
  	<button type="submit" class="btn btn-primary">Alterar Senha</button>
</form>


<?php $this->load->view('rodape'); ?>