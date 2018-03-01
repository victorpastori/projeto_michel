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

  	<button type="submit" class="btn btn-primary">Buscar Cliente</button>
</form>

<?php $this->load->view('rodape'); ?>