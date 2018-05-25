<?php $this->load->view('cabecalhoCliente'); ?>

<br>

<div class="container">
	<div class="row">
		<div class="container col-xl-5"></div>
		<div class="card border-warning mb-3" style="max-width: 18rem; margin-left: 4px; margin-right: 4px;">
		  <div class="card-header">Saldo em Cotas:</div>
		  <div class="card-body text-warning">
		    <h5 class="card-title">$<?= number_format($saldoCotas['total'], 2, ',', ',')?></h5>
		  </div>
		</div>
		<div class="card border-primary mb-3" style="max-width: 18rem; margin-left: 4px; margin-right: 4px;">
		  <div class="card-header">Saldo em Investimentos:</div>
		  <div class="card-body text-primary">
		    <h5 class="card-title">$<?= number_format($saldoInvestimentos['total'], 2, ',', ',') ?></h5>
		  </div>
		</div>
		<div class="card border-success mb-3" style="max-width: 18rem; margin-left: 4px; margin-right: 4px;">
		  <div class="card-header">Saldo Saque:</div>
		  <div class="card-body text-success">
		    <h5 class="card-title">$<?= number_format($saldos['saldoSaque'],2, ',', ',') ?></h5>
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
	<table id="table-movimentos" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Tipo</th>
		      <th scope="col">Valor (US$)</th>
		      <th scope="col">Data</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($movimentos as $movimento) : 
				$data = DateTime::createFromFormat('Y-m-d', $movimento['data']);
				$data = $data->format('d/m/Y'); ?>
				<tr>
			      <td><?= $movimento['tipo']?></td>
			      <td>$<?= number_format($movimento['valor'],2, ',', ',')?></td>
			      <td><?= $data?></td>
			    </tr>
			<?php endforeach ?> 
		  </tbody>
		</table>
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-investimentos" role="tabpanel" aria-labelledby="nav-investimentos-tab">
  	<?php if ($investimentos) { ?>
		Investimentos<br>
		<table id="table-investimentos" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Data</th>
		      <th scope="col">Valor (US$)</th>
		      <th scope="col">Carência Restante</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($investimentos as $investimento) : 
				$data = DateTime::createFromFormat('Y-m-d', $investimento['data']);
				$data = $data->format('d/m/Y'); ?>
				<tr>
			      <td><?= $data?></td>
			      <td>$<?= number_format($investimento['valor'],2, ',', ',')?></td>
			      <td><?= $investimento['carenciaRestante']?></td>
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
		      <th scope="col">Tamanho Cota (US$)</th>
		      <th scope="col">Rentabilidade</th>
		      <th scope="col">Rendimento (US$)</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($cotas as $cota) : 
			$data = DateTime::createFromFormat('Y-m-d', $cota['dataCompra']);
			$data = $data->format('d/m/Y');  ?>
		    <tr>
		      <td><?= $data?></td>
		      <td>$<?= number_format($cota['valor'],2, ',', ',')?></td>
		      <td><?= $cota['rendimento']?>%</td>
		      <td>$<?= number_format(($cota['valor']*$cota['rendimento']/100),2, ',', ',');?> (-<?= $txAdm['valorAdmCota']?>%) = <?= number_format((($cota['valor']*$cota['rendimento']/100)*(1-$txAdm['valorAdmCota']/100)),2, ',', '.');?></td>
		    </tr>
		    <?php endforeach ?>	
		  </tbody>
		</table>
<?php } ?>
  </div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  	<?php if ($rendimentos) { ?>
		Rendimenos<br>
		<table id="table-rendimentos" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Tipo</th>
		      <th scope="col">Valor Aplicado</th>
		      <th scope="col">Rentabilidade</th>
		      <th scope="col">Rentabilidade Líquida</th>
		      <th scope="col">Valor(US$)</th>
		      <th scope="col">Data</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($rendimentos as $rendimento) : ?>
		    <tr>
		      <td><?= $rendimento['tipo']?></td>
			  <td>$<?= number_format($rendimento['capital'],2, ',', ',')?></td>
			  <td><?= $rendimento['percentual']?>%</td>
			  <td><?= $rendimento['rentabilidadeLiquida']?>%</td>
			  <td>$<?= number_format($rendimento['valor'],2, ',', ',')?></td>
			  <td><?= $rendimento['month']?>/<?= $rendimento['year']?></td>
		    </tr>
		    <?php endforeach ?>	
		  </tbody>
		</table>
	<?php } ?>
  </div>
</div>


<?php $this->load->view('rodape'); ?>