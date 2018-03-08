<?php $this->load->view('cabecalhoCliente'); ?>

<form action="<?=base_url("index.php/Contas_Controller/solicitarSaque")?>" method="post">
	<div class="form-group">
		<label for="inputValor">Valor</label>
    	<input type="number" class="form-control" name="valor" id="inputValor" aria-describedby="emailHelp" placeholder="Informe valor para saque">
  	</div>
  	<button type="submit" class="btn btn-primary">Solicitar Saque</button>
</form>


<?php $this->load->view('rodape'); ?>