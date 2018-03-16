
<?php $this->load->view('cabecalhoAdmin'); ?>
<br>

<div class="container">
	<div class="row">
		<div class="container col-xl-5"></div>
		<div class="card border-dark mb-3" style="max-width: 18rem; margin-left: 4px; margin-right: 4px;">
		  <div class="card-header">Capital total:</div>
		  <div class="card-body text-dark">
		    <h5 class="card-title">US$ <?= number_format($capitalTotal, 2, ',', '.')?></h5>
		  </div>
		</div>
		<div class="card border-dark mb-3" style="max-width: 18rem; margin-left: 4px; margin-right: 4px;">
		  <div class="card-header">Capital empresa:</div>
		  <div class="card-body text-dark">
		    <h5 class="card-title">US$ <?= number_format($capitalTotalAdmin, 2, ',', '.') ?></h5>
		  </div>
		</div>
		<div class="card border-dark mb-3" style="max-width: 18rem; margin-left: 4px; margin-right: 4px;">
		  <div class="card-header">Saldo Saque:</div>
		  <div class="card-body text-dark">
		    <h5 class="card-title">US$ <?= number_format($capitalTotalAdmin,2, ',', '.') ?></h5>
		  </div>
		</div>
	</div>
</div>	

<div class="card">
<nav class="card-header ">
  <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
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
<div class="tab-content card-body" id="nav-tabContent" >
	<div class="tab-pane fade show active" id="nav-saques" role="tabpanel" aria-labelledby="nav-saques-tab">
  	<?php if ($saquesPendentes) { ?>
			Saques Pendentes<br>
		<table id="table-saques" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Cliente</th>
		      <th scope="col">Valor</th>
		      <th scope="col">Data</th>
		      <th scope="col"></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($saquesPendentes as $saquePendente) : 
				$data = DateTime::createFromFormat('Y-m-d', $saquePendente['data']);
				$data = $data->format('d/m/Y'); ?>
				<tr>
			      <td><?= $saquePendente['nome']?></td>
			      <td>US$ <?= number_format($saquePendente['valor'],2, ',', '.')?></td>
			      <td><?= $data ?></td>
			      <td><a href="<?= base_url("index.php/Clientes_Controller/alterarSenha")?>" class="btn btn-success">Atualizar Status</a></td>
			    </tr>
			<?php endforeach ?> 
		  </tbody>
		</table>
	<?php } ?>
  </div>

  <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  	<?php if ($movimentos) { ?>
			Movimentos<br>
		<table id="table-movimentos" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Tipo</th>
		      <th scope="col">Valor</th>
		      <th scope="col">Data</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($movimentos as $movimento) : 
				$data = DateTime::createFromFormat('Y-m-d', $movimento['data']);
				$data = $data->format('d/m/Y'); ?>
				<tr>
			      <td><?= $movimento['tipo']?></td>
			      <td>US$ <?= number_format($movimento['valor'],2, ',', '.')?></td>
			      <td><?= $data?></td>
			    </tr>
			<?php endforeach ?> 
		  </tbody>
		</table>
		
	<?php } ?>
  </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  	<?php if ($cotas) { ?>
		Cotas<br>
		<table id="table-cotas" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Data Compra</th>
		      <th scope="col">Tamanho Cota</th>
		      <th scope="col">Rentabilidade</th>
		      <th scope="col">Rendimento</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($cotas as $cota) : 
			$data = DateTime::createFromFormat('Y-m-d', $cota['dataCompra']);
			$data = $data->format('d/m/Y');  ?>
		    <tr>
		      <td><?= $data?></td>
		      <td>US$ <?= number_format($cota['valor'],2, ',', '.')?></td>
		      <td><?= $cota['rendimento']?>%</td>
		      <td>US$ <?= number_format(($cota['valor']*$cota['rendimento']/100),2, ',', '.');?> (-25%) = <?= number_format((($cota['valor']*$cota['rendimento']/100)*0.75),2, ',', '.');?></td>
		    </tr>
		    <?php endforeach ?>	
		  </tbody>
		</table>
	<?php } ?>
  </div>

  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  	<?php if ($rendimentos) { ?>
		Rendimentos<br>
		<table id="table-rendimentos"  class="table">
		  <thead>
		    <tr>
		      <th scope="col">Tipo</th>
		      <th scope="col">Taxa</th>
		      <th scope="col">Total(Descontado taxa Administração)</th>
		      <th scope="col">Data</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($rendimentos as $rendimento) : ?>
				<tr>
			      <td><?= $rendimento['tipo']?></td>
			      <td><?= $rendimento['percentual']?>%</td>
			      <td>US$ <?= number_format($rendimento['total'],2, ',', '.')?></td>
			      <td><?= $rendimento['month']?>/<?= $rendimento['year']?></td>
			    </tr>
			<?php endforeach ?> 
		  </tbody>
		</table>
<?php } ?>
  </div>

  <div class="tab-pane fade" id="nav-rend-cli" role="tabpanel" aria-labelledby="nav-rend-cli-tab">
  	<?php if ($rendimentosClientes) { ?>
		Rendimenos Clientes<br>
		<table id="table-rend-clientes" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Data</th>
		      <th scope="col">Total</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($rendimentosClientes as $rendimentoCliente) : ?>
				<tr>
			      <td><?= $rendimentoCliente['month']?>/<?= $rendimentoCliente['year']?></td>
			      <td>US$ <?= number_format($rendimentoCliente['total'],2, ',', '.')?></td>
			    </tr>
			<?php endforeach ?> 
		  </tbody>
		</table>
<?php } ?>
  </div>

  <div class="tab-pane fade" id="nav-comissoes" role="tabpanel" aria-labelledby="nav-comissoes-tab">
  	<?php if ($comissoes) { ?>
		Comissoes<br>
		<table id="table-comissoes" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Data</th>
		      <th scope="col">Total</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($comissoes as $comissao) : ?>
				<tr>
			      <td><?= $comissao['month']?>/<?= $comissao['year']?></td>
			      <td>US$ <?= number_format($comissao['total'],2, ',', '.')?></td>
			    </tr>
			<?php endforeach ?> 
		  </tbody>
		</table>
	<?php } ?>
  </div>

  <div class="tab-pane fade" id="nav-lucro-total" role="tabpanel" aria-labelledby="nav-lucro-total-tab">
  	<?php if ($comissoes) { ?>
		Lucro Total<br>
		<table id="table-lucro-total" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Data</th>
		      <th scope="col">Total</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($comissoes as $index => $comissao) : ?>
				<tr>
			      <td><?= $comissao['month']?>/<?= $comissao['year']?></td>
			      <td>US$ <?= number_format(($rendimentosAdminMensais[$index]['total']+ $comissao['total']),2, ',', '.')?></td>
			    </tr>
			<?php endforeach ?> 
		  </tbody>
		</table>
	<?php } ?>
  </div>

  <div class="tab-pane fade" id="nav-rend-bruto" role="tabpanel" aria-labelledby="nav-rend-bruto-tab">
  	<?php if ($rendimentosBrutos) { ?>
		Rendimento Bruto<br>
		<table id="table-rend-bruto" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Data</th>
		      <th scope="col">Total</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($rendimentosBrutos as $rendimentoBruto) : ?>
				<tr>
			      <td><?= $rendimentoBruto['month']?>/<?= $rendimentoBruto['year']?></td>
			      <td>US$ <?= number_format(($rendimentoBruto['total']+$rendimentoBruto['totalComissao']),2, ',', '.')?></td>
			    </tr>
			<?php endforeach ?> 
		  </tbody>
		</table>
	<?php } ?>
  </div>
</div>
</div>	


<?php $this->load->view('rodape'); ?>