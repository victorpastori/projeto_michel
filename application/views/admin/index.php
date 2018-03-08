<?php $this->load->view('cabecalhoAdmin'); ?>

Capital total: US$ <?= $capitalTotal ?> <br>
Capital total empresa: US$ <?= $capitalTotalAdmin ?><br>

<?php if ($movimentos) { ?>
		Movimentos<br>
	<?php foreach ($movimentos as $movimento) : ?>
		<p><?= $movimento['tipo']?> --- US$ <?= $movimento['valor']?> --- <?= $movimento['data']?> </p>
	<?php endforeach ?> 
<?php } ?>

<br>
<?php if ($cotas) { ?>
	Cotas<br>
	<?php foreach ($cotas as $cota) : ?>
		<p> <?= $cota['dataCompra']?> - Tamanho da quota: US$ <?= $cota['valor']?> | Rentabilidade: <?= $cota['rendimento']?>% = US$ <?= $cota['valor']*$cota['rendimento']/100;?> (-25%) = <?= ($cota['valor']*$cota['rendimento']/100)*0.75;?> </p>
	<?php endforeach ?> 
<?php } ?>

<?php if ($rendimentos) { ?>
		Rendimenos<br>
	<?php foreach ($rendimentos as $rendimento) : ?>
		<p> US$ <?= $rendimento['total']?> --- <?= $rendimento['month']?>/<?= $rendimento['year']?></p>	
	<?php endforeach ?>
<?php } ?>

<?php $this->load->view('rodape'); ?>