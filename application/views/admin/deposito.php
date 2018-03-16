<?php $this->load->view('cabecalhoAdmin'); ?>

<form action="<?= base_url("index.php/Contas_Controller/realizarDeposito")?>" method="post">

	<div class="form-group">
	    <label for="selectCliente">Cliente</label>
	    <select class="form-control" id="selectCliente" name="cliente">
		    <?php foreach ($clientes as $cliente) : ?>
		
				<option value="<?= $cliente['idcliente'] ?>"><?= $cliente['nome'] ?></option>

			<?php endforeach ?>
	    </select>
  	</div>

	<div class="form-group">
		<label for="inputValor">Valor</label>
		<input class="form-control" type="number" name="valor" id="inputValor" min="1" required placeholder="Valor do depósito">
	</div>

	<div class="form-group">
		<label for="inputCarencia">Carência</label>
		<input class="form-control" type="number" name="carencia" id="inputCarencia" min="0" required placeholder="Tempo de carência para saque">
	</div>	
  	<button type="submit" class="btn btn-primary">Realizar Depósito</button>
</form>

<?php $this->load->view('rodape'); ?>