<?php $this->load->view('cabecalhoAdmin'); ?>

<form action="<?= base_url("index.php/Contas_Controller/lancarScalpins")?>" method="post">

	<h3>Depósido de Scalpins e Operações Normais</h3>

	<div class="form-group">
		<label for="inputValor">Valor (US$)</label>
		<input class="form-control" type="number" name="valor" id="inputValor" min="1" step=".01" required placeholder="Valor em DÓLARES(US$)">
	</div>

	<div class="form-group">
		<label for="inputCarencia">Tipo</label>
		<input class="form-control" type="text" name="carencia" id="inputCarencia" min="0" required placeholder="Scalpins e Operações Normais" disabled>
	</div>	
  	<button type="submit" class="btn btn-primary">Lançar Scalpins</button>
</form>

<?php $this->load->view('rodape'); ?>