<?php $this->load->view('cabecalhoAdmin'); ?>

	<?php foreach ($clientes as $cliente) : ?>
		
		<p><?= $cliente['nome'] ?> ---- <?= $cliente['saldo'] ?> </p>

	<?php endforeach ?>	

<?php $this->load->view('rodape'); ?>