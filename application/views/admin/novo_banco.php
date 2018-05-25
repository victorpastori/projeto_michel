<?php $this->load->view('cabecalhoAdmin'); ?>

<form action="<?= base_url("index.php/Sistema_Controller/insereBanco")?>" method="post">

	<h3>Inserir novo banco</h3>

	<div class="form-group">
		<label for="inputValor">Nome do banco</label>
		<input class="form-control" type="text" name="nome" id="nome" required">
	</div>

	<div class="form-group">
		<label for="inputCarencia">Código</label>
		<input class="form-control" type="text" name="codigo" id="codigo" required>
	</div>	
  	<button type="submit" class="btn btn-primary">Cadastrar banco</button>
</form>

<?php $this->load->view('rodape'); ?>