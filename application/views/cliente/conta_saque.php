<?php $this->load->view('cabecalhoCliente'); ?>

<form action="#" method="post">
	<div class="form-group">
	    <label for="selectBanco">Banco</label>
	    <select class="form-control" id="selectBanco" name="banco">
		    <option>1</option>
		    <option>2</option>
		    <option>3</option>
		    <option>4</option>
		    <option>5</option>
	    </select>
  	</div>
	<div class="form-group">
		<label for="inputAgencia">Agencia</label>
    	<input type="text" class="form-control" name="agencia" id="inputAgencia" aria-describedby="emailHelp" placeholder="Informe o número de sua agência">
    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  	</div>
  	<div class="form-group">
		<label for="inputValor">Conta</label>
    	<input type="number" class="form-control" name="conta" id="inputValor" aria-describedby="emailHelp" placeholder="Informe o número de sua conta">
    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  	</div>
  	<div class="form-group">
	    <label for="selectTipo">Tipo</label>
	    <select class="form-control" id="selectTipo" name="tipo">
		    <option>Corrente</option>
		    <option>Poupança</option>
	    </select>
  	</div>
  	<button type="submit" class="btn btn-primary">Cadastrar Conta Saque</button>
</form>


<?php $this->load->view('rodape'); ?>