<?php $this->load->view('cabecalhoCliente'); ?>

<form action="#" method="post">
	<div class="form-group">
		<label for="inputSenha">Nova Senha</label>
    	<input type="password" class="form-control" name="senha" id="inputSenha" aria-describedby="emailHelp" placeholder="Informe o número de sua agência">
    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  	</div>
  	<div class="form-group">
		<label for="inputSenha2">Confirmar Nova Senha</label>
    	<input type="password" class="form-control" name="senha2" id="inputSenha2" aria-describedby="emailHelp" placeholder="Informe o número de sua conta">
    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  	</div>
  	<button type="submit" class="btn btn-primary">Alterar Senha</button>
</form>


<?php $this->load->view('rodape'); ?>