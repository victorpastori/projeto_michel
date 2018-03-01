<?php $this->load->view('cabecalhoAdmin'); ?>

<form action="#" method="post">

	<div class="form-group">
	    <label for="selectCliente">Cliente</label>
	    <select class="form-control" id="selectCliente" name="cliente">
		    <option>1</option>
		    <option>2</option>
		    <option>3</option>
		    <option>4</option>
		    <option>5</option>
	    </select>
  	</div>

	<div class="form-group">
		<label for="inputValor">Valor</label>
		<input type="number" name="valor" id="inputValor" min="1" required placeholder="Valor do depósito">
	</div>

	<div class="form-group">
		<label for="inputCarencia">Carência</label>
		<input type="number" name="carencia" id="inputCarencia" min="0" required placeholder="Tempo de carência para saque">
	</div>	
  	<button type="submit" class="btn btn-primary">Relizar Depósito</button>
</form>

<?php $this->load->view('rodape'); ?>