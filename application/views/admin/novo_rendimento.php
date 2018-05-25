<?php $this->load->view('cabecalhoAdmin'); ?>
<h2>Cadastrar novo rendimento mensal</h2>
<form action="<?= base_url("index.php/Contas_Controller/cadastrarRendimentos")?>" method="post">
	<div class="form-group">
		<label for="inputRendimento">Rendimento Mensal (%)</label>
		<?php if ($rendimento) { ?>
			<input type="number" class="form-control" name="rendimento" min="1" step=".01" id="inputRendimento" aria-describedby="emailHelp" placeholder="Informe valor do rendimento em %" value="<?= $rendimento?>">
		<?php }else { ?>


    	<input type="number" class="form-control" name="rendimento" min="1" step=".01" id="inputRendimento" aria-describedby="emailHelp" placeholder="Informe valor do rendimento em %">
		<?php } ?>
  	</div>

  	<div class="form-group">
		<label for="inputDataFechamento">Data</label>
		<input class="form-control" type="date" name="data" id="inputDataFechamento" required placeholder="Data de fechamento da cota">
	</div>
  	<button type="submit" class="btn btn-primary">Aplicar Rendimento</button>
</form>

<?php $this->load->view('rodape'); ?>