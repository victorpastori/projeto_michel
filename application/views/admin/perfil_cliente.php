<?php $this->load->view('cabecalhoAdmin'); ?>

Cliente: <?=$cliente['nome']?><br><br>
<br>

<div class="container">
	<div class="row">
		<div class="container col-xl-5"></div>
		<div class="card border-dark mb-3" style="max-width: 18rem; margin-left: 4px; margin-right: 4px;">
		  <div class="card-header">Saldo em Cotas:</div>
		  <div class="card-body text-dark">
		    <h5 class="card-title">US$ <?= number_format($saldoCotas['total'], 2, ',', '.')?></h5>
		  </div>
		</div>
		<div class="card border-dark mb-3" style="max-width: 18rem; margin-left: 4px; margin-right: 4px;">
		  <div class="card-header">Saldo em Investimentos:</div>
		  <div class="card-body text-dark">
		    <h5 class="card-title">US$ <?= number_format($saldoInvestimentos['total'], 2, ',', '.') ?></h5>
		  </div>
		</div>
		<div class="card border-dark mb-3" style="max-width: 18rem; margin-left: 4px; margin-right: 4px;">
		  <div class="card-header">Saldo Saque:</div>
		  <div class="card-body text-dark">
		    <h5 class="card-title">US$ <?= number_format($saldos['saldoSaque'],2, ',', '.') ?></h5>
		  </div>
		</div>
	</div>
</div>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Movimentos</a>
    <a class="nav-item nav-link" id="nav-investimentos-tab" data-toggle="tab" href="#nav-investimentos" role="tab" aria-controls="nav-investimentos" aria-selected="true">Investimentos</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Cotas</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Rendimentos</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  	<?php if ($movimentos) { ?>
		Movimentos<br>
	<?php foreach ($movimentos as $movimento) : ?>
		<p><?= $movimento['tipo']?> --- US$ <?= number_format($movimento['valor'],2, ',', '.')?> --- <?= $movimento['data']?> </p>
	<?php endforeach ?> 
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-investimentos" role="tabpanel" aria-labelledby="nav-investimentos-tab">
  	<?php if ($investimentos) { ?>
		Investimentos<br>
	<?php foreach ($investimentos as $investimento) : 
	$data = DateTime::createFromFormat('Y-m-d', $investimento['data']);
	$data = $data->format('d/m/Y'); ?>
		<p>Data Inicio: <?= $data?> --- Saldo Atual: US$ <?= number_format($investimento['valor'],2, ',', '.')?> --- Carência Restante: <?= $investimento['carenciaRestante']?> meses </p>
	<?php endforeach ?> 
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  	<?php if ($cotas) { ?>
	Cotas<br>
	<?php foreach ($cotas as $cota) : 
	$data = DateTime::createFromFormat('Y-m-d', $cota['dataCompra']);
	$data = $data->format('d/m/Y'); ?>
		<p> <?= $data?> - Tamanho da quota: US$ <?= number_format($cota['valor'],2)?> | Rentabilidade: <?= $cota['rendimento']?>% = US$ <?= number_format(($cota['valor']*$cota['rendimento']/100),2, ',', '.');?> (-25%) = <?= number_format((($cota['valor']*$cota['rendimento']/100)*0.75),2, ',', '.');?> </p>
	<?php endforeach ?> 
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  	<?php if ($rendimentos) { ?>
		Rendimenos<br>
	<?php foreach ($rendimentos as $rendimento) : ?>
		<p> US$ <?= number_format($rendimento['total'],2, ',', '.')?> --- <?= $rendimento['month']?>/<?= $rendimento['year']?></p>	
	<?php endforeach ?>
<?php } ?>
  </div>
</div>

<?php $this->load->view('rodape'); ?>