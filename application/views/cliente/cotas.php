<?php $this->load->view('cabecalhoCliente'); ?>

	<?php foreach ($cotas as $cota) : ?>
		
		<p> <?= $cota['dataCompra']?> - Tamanho da quota: US$ <?= $cota['valor']?> | Rentabilidade: <?= $cota['rendimento']?>% = US$ <?= $cota['valor']*$cota['rendimento']/100;?> (-25%) = <?= ($cota['valor']*$cota['rendimento']/100)*0.75;?> </p>

	<?php endforeach ?>	


<?php $this->load->view('rodape'); ?>