<?php $this->load->view('cabecalhoAdmin');?>
<h2>Calcular rendimento mensal</h2>
<form action="<?=base_url("index.php/Sistema_Controller/exibirValorRendimento")?>" method="post">
	<div class="form-group">
		<label for="inputCapitalAtual">Capital Atual</label>
    	<input type="number" class="form-control" name="capitalAtual" id="inputCapitalAtual" min="1" step=".00001" required>
  	</div>
  	<button type="submit" id="btnSalvar" class="btn btn-success">Calcular</button>
</form>

<br>

<?php $this->load->view('rodape'); ?>