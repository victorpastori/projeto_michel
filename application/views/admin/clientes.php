<?php $this->load->view('cabecalhoAdmin'); ?>

	<?php foreach ($clientes as $cliente) : ?>
		
		<p><?= $cliente['nome'] ?> ---- US$ <?= number_format($cliente['saldoSaque'],2) ?> </p>

	<?php endforeach ?>	

<?php $this->load->view('rodape'); ?>