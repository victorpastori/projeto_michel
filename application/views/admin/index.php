
<?php $this->load->view('cabecalhoAdmin'); ?>
<br>

<div class="container">
	<div class="row">
		<div class="col-xl-5"></div>
		<div class="alert alert-primary col-sm"><p>Capital total:</p> US$ <?= number_format($capitalTotal, 2)?></div>
		<div class="alert alert-info col-sm"><p>Capital empresa:</p> US$ <?= number_format($capitalTotalAdmin, 2) ?></div>
		<div class="alert alert-success col-sm"><p>Saldo Saque:</p> US$ <?= number_format($capitalTotalAdmin,2) ?></div>
	</div>
</div>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
  	<a class="nav-item nav-link active" id="nav-saques-tab" data-toggle="tab" href="#nav-saques" role="tab" aria-controls="nav-saques" aria-selected="true">Saques Pendentes</a>
    <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Movimentos</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Cotas</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Rendimentos</a>
    <a class="nav-item nav-link" id="nav-rend-cli-tab" data-toggle="tab" href="#nav-rend-cli" role="tab" aria-controls="nav-rend-cli" aria-selected="false">Rendimentos Clientes</a>
    <a class="nav-item nav-link" id="nav-comissoes-tab" data-toggle="tab" href="#nav-comissoes" role="tab" aria-controls="nav-comissoes" aria-selected="false">Comissoes</a>
    <a class="nav-item nav-link" id="nav-lucro-total-tab" data-toggle="tab" href="#nav-lucro-total" role="tab" aria-controls="nav-lucro-total" aria-selected="false">Lucro Total</a>
    <a class="nav-item nav-link" id="nav-rend-bruto-tab" data-toggle="tab" href="#nav-rend-bruto" role="tab" aria-controls="nav-rend-bruto" aria-selected="false">Rendimento Bruto Total</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
	<div class="tab-pane fade show active" id="nav-saques" role="tabpanel" aria-labelledby="nav-saques-tab">
  	<?php if ($saquesPendentes) { ?>
			Saques Pendentes<br>
		<?php foreach ($saquesPendentes as $saquePendente) : 
		$data = DateTime::createFromFormat('Y-m-d', $saquePendente['data']);
		$data = $data->format('d/m/Y'); ?>

			<p><?= $saquePendente['nome']?> --- <?= $saquePendente['tipo']?> --- US$ <?= number_format($saquePendente['valor'],2)?> --- <?= $data ?> <a href="<?= base_url("index.php/Clientes_Controller/alterarSenha")?>" class="btn btn-success">Atualizar Status</a> </p>
		<?php endforeach ?> 
	<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  	<?php if ($movimentos) { ?>
			Movimentos<br>
		<?php foreach ($movimentos as $movimento) : 
	$data = DateTime::createFromFormat('Y-m-d', $movimento['data']);
	$data = $data->format('d/m/Y'); ?>
		<p><?= $movimento['tipo']?> --- US$ <?= number_format($movimento['valor'],2)?> --- <?= $data?> </p>
	<?php endforeach ?> 
	<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  	<?php if ($cotas) { ?>
		Cotas<br>
		<?php foreach ($cotas as $cota) : 
		$data = DateTime::createFromFormat('Y-m-d', $cota['dataCompra']);
		$data = $data->format('d/m/Y');  ?>
			<p> <?= $data?> - Tamanho da quota: US$ <?= number_format($cota['valor'],2)?> | Rentabilidade: <?= $cota['rendimento']?>% = US$ <?= number_format(($cota['valor']*$cota['rendimento']/100),2);?> (-25%) = <?= number_format((($cota['valor']*$cota['rendimento']/100)*0.75),2);?> </p>
		<?php endforeach ?> 
	<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  	<?php if ($rendimentos) { ?>
		Rendimentos<br>
	<?php foreach ($rendimentos as $rendimento) : ?>
		<p><?= $rendimento['tipo']?> --- <?= $rendimento['percentual']?>% --- US$ <?= number_format($rendimento['total'],2)?>(Descontado taxa ADM) --- <?= $rendimento['month']?>/<?= $rendimento['year']?></p>	
	<?php endforeach ?>
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-rend-cli" role="tabpanel" aria-labelledby="nav-rend-cli-tab">
  	<?php if ($rendimentosClientes) { ?>
		Rendimenos Clientes<br>
	<?php foreach ($rendimentosClientes as $rendimentoCliente) : ?>
		<p> US$ <?= number_format($rendimentoCliente['total'],2)?> --- <?= $rendimentoCliente['month']?>/<?= $rendimentoCliente['year']?></p>	
	<?php endforeach ?>
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-comissoes" role="tabpanel" aria-labelledby="nav-comissoes-tab">
  	<?php if ($comissoes) { ?>
		Comissoes<br>
		<?php foreach ($comissoes as $comissao) : ?>
			<p> US$ <?= number_format($comissao['total'],2)?> -  <?= $comissao['month']?>/<?= $comissao['year']?> </p>
		<?php endforeach ?> 
	<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-lucro-total" role="tabpanel" aria-labelledby="nav-lucro-total-tab">
  	<?php if ($comissoes) { ?>
		Comissoes<br>
		<?php foreach ($comissoes as $index => $comissao) : ?>
			<p> US$ <?= number_format(($rendimentosAdminMensais[$index]['total']+ $comissao['total']),2)?> -  <?= $comissao['month']?>/<?= $comissao['year']?> </p>
		<?php endforeach ?> 
	<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-rend-bruto" role="tabpanel" aria-labelledby="nav-rend-bruto-tab">
  	<?php if ($rendimentosBrutos) { ?>
		Rendimento Bruto<br>
		<?php foreach ($rendimentosBrutos as $rendimentoBruto) : ?>
			<p> US$ <?= number_format(($rendimentoBruto['total']+$rendimentoBruto['totalComissao']),2)?> --- <?= $rendimentoBruto['month']?>/<?= $rendimentoBruto['year']?></p>
		<?php endforeach ?> 
	<?php } ?>
  </div>
</div>


<?php $this->load->view('rodape'); ?>