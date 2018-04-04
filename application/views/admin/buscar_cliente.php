<?php $this->load->view('cabecalhoAdmin'); ?>

<form action="<?= base_url("index.php/Admin_Controller/mostrarCliente")?>" method="get">

	<div class="form-group">
	    <label for="selectCliente">Cliente</label>
	    <select class="form-control" id="selectCliente" name="cliente">
	    	<?php foreach ($clientes as $cliente) : ?>
		
				<option value="<?= $cliente['idcliente'] ?>"><?= $cliente['nome'] ?></option>

			<?php endforeach ?>	
	    </select>
  	</div>

  	<button type="submit" class="btn btn-primary">Buscar Cliente</button>
  	<a href="<?= base_url("index.php/Admin_Controller/clientes")?>" class="btn btn-success">Listar Todos</a>
</form>

<?php $this->load->view('rodape'); ?>