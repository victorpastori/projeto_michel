<?php $this->load->view('cabecalhoCliente'); ?>

<form action="<?= base_url("index.php/Clientes_Controller/cadastrarContaSaque")?>" method="post">
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
    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  	</div>
  	<div class="form-group">
		<label for="inputConta">Conta</label>
    	<input type="text" class="form-control" name="conta" id="inputConta" aria-describedby="emailHelp" placeholder="Informe o número de sua conta">
    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  	</div>
  	<div class="form-group">
	    <label for="selectTipo">Tipo</label>
	    <select class="form-control" id="selectTipo" name="tipo">
		    <option value="1">Corrente</option>
		    <option value="2">Poupança</option>
	    </select>
  	</div>
  	<button type="submit" class="btn btn-primary">Cadastrar Conta Saque</button>
</form>


<?php $this->load->view('rodape'); ?>