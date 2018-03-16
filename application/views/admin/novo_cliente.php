<?php $this->load->view('cabecalhoAdmin'); ?>

<form action="<?= base_url("index.php/Clientes_Controller/cadastrarCliente")?>" method="post">
	<div class="form-group">
		<label for="inputNome">Nome</label>
		<input class="form-control" type="text" name="nome" id="inputNome" required placeholder="Informe seu nome completo">
	</div>

	<div class="form-group">
		<label for="inputCpf">CPF</label>
		<input class="form-control" type="text" name="cpf" id="inputCpf" required placeholder="Informe seu CPF">
	</div>

	<div class="form-group">
		<label for="inputEmail">E-mail</label>
		<input class="form-control" type="email" name="email" id="inputEmail" required placeholder="Informe um e-mail válido">
	</div>

	<div class="form-group">
		<label for="inputSenha">Senha</label>
		<input class="form-control" type="password" name="senha" id="inputSenha" required placeholder="Informe senha para acesso">
	</div>
	
  	<button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
</form>


<?php $this->load->view('rodape'); ?>