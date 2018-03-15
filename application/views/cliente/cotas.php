<?php $this->load->view('cabecalhoCliente'); ?>

	<?php foreach ($cotas as $cota) : ?>
		
		<p> <?= $cota['dataCompra']?> - Tamanho da quota: US$ <?= number_format($cota['valor'],2)?> | Rentabilidade: <?= $cota['rendimento']?>% = US$ <?= number_format(($cota['valor']*$cota['rendimento']/100),2);?> (-25%) = <?= number_format((($cota['valor']*$cota['rendimento']/100)*0.75),2);?> </p>

	<?php endforeach ?>	


<?php $this->load->view('rodape'); ?>