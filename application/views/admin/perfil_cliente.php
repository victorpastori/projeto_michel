<?php $this->load->view('cabecalhoAdmin'); ?>

Cliente: <?=$cliente['nome']?><br><br>

Conta:<br>

	Saldo: US$ <?= $saldos['saldo'] ?><br>
	Saldo Saque: US$ <?=$saldos['saldoSaque'] ?> <br><br>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Movimentos</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Cotas</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Rendimentos</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  	<?php if ($movimentos) { ?>
		Movimentos<br>
	<?php foreach ($movimentos as $movimento) : ?>
		<p><?= $movimento['tipo']?> --- US$ <?= $movimento['valor']?> --- <?= $movimento['data']?> </p>
	<?php endforeach ?> 
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  	<?php if ($cotas) { ?>
	Cotas<br>
	<?php foreach ($cotas as $cota) : ?>
		<p> <?= $cota['dataCompra']?> - Tamanho da quota: US$ <?= $cota['valor']?> | Rentabilidade: <?= $cota['rendimento']?>% = US$ <?= $cota['valor']*$cota['rendimento']/100;?> (-25%) = <?= ($cota['valor']*$cota['rendimento']/100)*0.75;?> </p>
	<?php endforeach ?> 
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  	<?php if ($rendimentos) { ?>
		Rendimenos<br>
	<?php foreach ($rendimentos as $rendimento) : ?>
		<p> US$ <?= $rendimento['total']?> --- <?= $rendimento['month']?>/<?= $rendimento['year']?></p>	
	<?php endforeach ?>
<?php } ?>
  </div>
</div>	

<?php $this->load->view('rodape'); ?>