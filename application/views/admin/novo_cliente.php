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

	<div class="form-group">
	    <label for="selectBanco">Banco</label>
	    <select class="form-control" id="selectBanco" name="banco">
		    <?php foreach ($bancos as $banco) : ?>
		
				<option value="<?= $banco['idbanco'] ?>"><?= $banco['codigo'] ?> - <?= $banco['nome'] ?></option>

			<?php endforeach ?>
	    </select>
  	</div>
	<div class="form-group">
		<label for="inputAgencia">Agencia</label>
    	<input type="text" class="form-control" name="agencia" id="inputAgencia" aria-describedby="emailHelp" placeholder="Informe o número de sua agência">
  	</div>
  	<div class="form-group">
		<label for="inputConta">Conta</label>
    	<input type="text" class="form-control" name="conta" id="inputConta" aria-describedby="emailHelp" placeholder="Informe o número de sua conta">
  	</div>
  	<div class="form-group">
	    <label for="selectTipo">Tipo</label>
	    <select class="form-control" id="selectTipo" name="tipo">
		    <option value="1">Corrente</option>
		    <option value="2">Poupança</option>
	    </select>
  	</div>
	
  	<button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
</form>


<?php $this->load->view('rodape'); ?>