<?php $this->load->view('cabecalhoAdmin'); ?>

	<?php foreach ($cotas as $cota) : ?>
		
		<p><?= $cota['nome'] ?> ---- <?= $cota['valor'] ?> ---- <?= $cota['dataCompra'] ?> </p>

	<?php endforeach ?>	

<?php $this->load->view('rodape'); ?>