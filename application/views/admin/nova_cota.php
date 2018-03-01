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
		<input type="number" name="valor" id="inputValor" min="1" required placeholder="Valor da cota">
	</div>

	<div class="form-group">
		<label for="inputRendimento">Rendimento</label>
		<input type="number" name="rendimento" id="inputRendimentop" min="0" required placeholder="Rendimento no fechamento da cota">
	</div>

	<div class="form-group">
		<label for="inputDataFechamento">Data Fechamento</label>
		<input type="date" name="dataFechamento" id="inputDataFechamento" required placeholder="Data de fechamento da cota">
	</div>
	
  	<button type="submit" class="btn btn-primary">Cadastrar Cota</button>
</form>

<?php $this->load->view('rodape'); ?>