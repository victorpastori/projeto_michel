<?php $this->load->view('cabecalhoAdmin'); ?>
<h2>Cadastrar nova cota</h2>
<form action="<?= base_url("index.php/Cotas_Controller/cadastrarCota")?>" method="post">

	<div class="form-group">
	    <label for="selectCliente">Cliente</label>
	    <select class="form-control" id="selectCliente" name="cliente">
	    	<option placeholder="Escolha um cliente"></option>
		    <?php foreach ($clientes as $cliente) : ?>
		
				<option value="<?= $cliente['idcliente'] ?>"><?= $cliente['nome'] ?></option>

			<?php endforeach ?>
	    </select>
  	</div>

	<div class="form-group">
		<label for="inputValor">Valor</label>
		<input class="form-control" type="number" name="valor" id="inputValor" min="1" required placeholder="Valor da cota">
	</div>

	<div class="form-group">
		<label for="inputRendimento">Rendimento %</label>
		<input class="form-control" type="number" name="rendimento" id="inputRendimentop" min="0" required placeholder="Rendimento no fechamento da cota em %">
	</div>

	<div class="form-group">
		<label for="inputDataFechamento">Data Fechamento</label>
		<input class="form-control" type="date" name="dataFechamento" id="inputDataFechamento" required placeholder="Data de fechamento da cota">
	</div>
	
  	<button type="submit" class="btn btn-primary">Cadastrar Cota</button>
</form>

<?php $this->load->view('rodape'); ?>