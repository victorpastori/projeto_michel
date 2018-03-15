<?php $this->load->view('cabecalhoAdmin'); ?>

Capital total: US$ <?= $capitalTotal ?> <br>
Capital total empresa: US$ <?= $capitalTotalAdmin ?><br><br>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Movimentos</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Cotas</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Rendimentos</a>
    <a class="nav-item nav-link" id="nav-rend-cli-tab" data-toggle="tab" href="#nav-rend-cli" role="tab" aria-controls="nav-rend-cli" aria-selected="false">Rendimentos Clientes</a>
    <a class="nav-item nav-link" id="nav-comissoes-tab" data-toggle="tab" href="#nav-comissoes" role="tab" aria-controls="nav-comissoes" aria-selected="false">Comissoes</a>
    <a class="nav-item nav-link" id="nav-lucro-total-tab" data-toggle="tab" href="#nav-lucro-total" role="tab" aria-controls="nav-lucro-total" aria-selected="false">Lucro Total</a>
    <a class="nav-item nav-link" id="nav-rend-bruto-tab" data-toggle="tab" href="#nav-rend-bruto" role="tab" aria-controls="nav-rend-bruto" aria-selected="false">Rendimento Bruto Total</a>
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
		Rendimentos<br>
	<?php foreach ($rendimentos as $rendimento) : ?>
		<p><?= $rendimento['tipo']?> --- <?= $rendimento['percentual']?>% --- US$ <?= $rendimento['total']?>(Descontado taxa ADM) --- <?= $rendimento['month']?>/<?= $rendimento['year']?></p>	
	<?php endforeach ?>
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-rend-cli" role="tabpanel" aria-labelledby="nav-rend-cli-tab">
  	<?php if ($rendimentosClientes) { ?>
		Rendimenos Clientes<br>
	<?php foreach ($rendimentosClientes as $rendimentoCliente) : ?>
		<p> US$ <?= $rendimentoCliente['total']?> --- <?= $rendimentoCliente['month']?>/<?= $rendimentoCliente['year']?></p>	
	<?php endforeach ?>
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-comissoes" role="tabpanel" aria-labelledby="nav-comissoes-tab">
  	<?php if ($comissoes) { ?>
		Comissoes<br>
		<?php foreach ($comissoes as $comissao) : ?>
			<p> US$ <?= $comissao['total']?> -  <?= $comissao['month']?>/<?= $comissao['year']?> </p>
		<?php endforeach ?> 
	<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-lucro-total" role="tabpanel" aria-labelledby="nav-lucro-total-tab">
  	<?php if ($comissoes) { ?>
		Comissoes<br>
		<?php foreach ($comissoes as $index => $comissao) : ?>
			<p> US$ <?= $rendimentosAdminMensais[$index]['total']+ $comissao['total']?> -  <?= $comissao['month']?>/<?= $comissao['year']?> </p>
		<?php endforeach ?> 
	<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-rend-bruto" role="tabpanel" aria-labelledby="nav-rend-bruto-tab">
  	<?php if ($rendimentosBrutos) { ?>
		Rendimento Bruto<br>
		<?php foreach ($rendimentosBrutos as $rendimentoBruto) : ?>
			<p> US$ <?= $rendimentoBruto['total']+$rendimentoBruto['totalComissao']?> --- <?= $rendimentoBruto['month']?>/<?= $rendimentoBruto['year']?></p>
		<?php endforeach ?> 
	<?php } ?>
  </div>
</div>


<?php $this->load->view('rodape'); ?>