<?php $this->load->view('cabecalhoCliente'); ?>

<form action="#" method="post">
	<div class="form-group">
		<label for="inputValor">Valor</label>
    	<input type="number" class="form-control" name="valor" id="inputValor" aria-describedby="emailHelp" placeholder="Informe valor para saque">
    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  	</div>
  	<button type="submit" class="btn btn-primary">Solicitar Saque</button>
</form>


<?php $this->load->view('rodape'); ?>