<?php $this->load->view('cabecalhoAdmin'); ?>
<h2>Depósito de investimento</h2>
<form action="<?= base_url("index.php/Contas_Controller/realizarDeposito")?>" method="post">

	<div class="form-group">
	    <label for="selectCliente">Cliente</label>
	    <select class="form-control" id="selectCliente" name="cliente" required>
	    	<option placeholder="Escolha um cliente"></option>
		    <?php foreach ($clientes as $cliente) : ?>
		
				<option value="<?= $cliente['idcliente'] ?>"><?= $cliente['nome'] ?></option>

			<?php endforeach ?>
	    </select>
  	</div>

	<div class="form-group">
		<label for="inputValor">Valor (US$)</label>
		<input class="form-control" type="number" name="valor" id="inputValor" min="1" step=".01" required placeholder="Valor do depósito em DÓLARES(US$)">
	</div>

	<div class="form-group">
		<label for="inputCarencia">Carência (Meses)</label>
		<input class="form-control" type="number" name="carencia" id="inputCarencia" min="0" required placeholder="Tempo de carência para saque em meses">
	</div>	
  	<button type="submit" class="btn btn-primary">Realizar Depósito</button>
</form>

<?php $this->load->view('rodape'); ?>