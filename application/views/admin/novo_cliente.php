<?php $this->load->view('cabecalhoAdmin'); ?>

<form action="#" method="post">
	<div class="form-group">
		<label for="inputNome">Nome</label>
		<input type="text" name="nome" id="inputNome" required placeholder="Informe seu nome completo">
	</div>

	<div class="form-group">
		<label for="inputCpf">Cpf</label>
		<input type="text" name="cpf" id="inputCpf" required placeholder="Informe seu cpf">
	</div>

	<div class="form-group">
		<label for="inputEmail">E-mail</label>
		<input type="email" name="nome" id="inputEmail" required placeholder="Informe um e-mail válido">
	</div>

	<div class="form-group">
		<label for="inputSenha">Senha</label>
		<input type="password" name="senha" id="inputSenha" required placeholder="Informe senha para acesso">
	</div>
	
  	<button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
</form>


<?php $this->load->view('rodape'); ?>