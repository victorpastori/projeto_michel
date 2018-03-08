<?php $this->load->view('cabecalhoAdmin'); ?>

<form action="<?= base_url("index.php/Contas_Controller/cadastrarRendimentos")?>" method="post">
	<div class="form-group">
		<label for="inputRendimento">Rendimento Mensal</label>
    	<input type="number" class="form-control" name="rendimento" id="inputRendimento" aria-describedby="emailHelp" placeholder="Informe valor do rendimento">
  	</div>

  	<div class="form-group">
		<label for="inputDataFechamento">Data</label>
		<input class="form-control" type="date" name="data" id="inputDataFechamento" required placeholder="Data de fechamento da cota">
	</div>
  	<button type="submit" class="btn btn-primary">Aplicar Rendimento</button>
</form>

<?php $this->load->view('rodape'); ?>