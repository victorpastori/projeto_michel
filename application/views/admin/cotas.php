<?php $this->load->view('cabecalhoAdmin'); ?>

	<table id="my-table" class="table">
	  <thead>
	    <tr>
	      <th scope="col">Cliente</th>	
	      <th scope="col">Data Compra</th>
	      <th scope="col">Data Fechamento</th>
	      <th scope="col">Tamanho Cota(US$)</th>
	      <th scope="col">Rentabilidade</th>
	      <th scope="col">Rendimento(US$)</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($cotas as $cota) : 
		$data = DateTime::createFromFormat('Y-m-d', $cota['dataCompra']);
		$data = $data->format('d/m/Y');
		$dataFechamento = DateTime::createFromFormat('Y-m-d', $cota['dataFechamento']);
		$dataFechamento = $dataFechamento->format('d/m/Y');  ?>
	    <tr>
	      <td><?= $cota['nome']?></td>
	      <td><?= $data?></td>
	      <td><?= $dataFechamento?></td>
	      <td>$<?= number_format($cota['valor'],2, ',', ',')?></td>
	      <td><?= $cota['rendimento']?>%</td>
	      <td>$<?= number_format(($cota['valor']*$cota['rendimento']/100),2, ',', ',');?> (-<?= $txAdm['valorAdmCota']?>%) = <?= number_format((($cota['valor']*$cota['rendimento']/100)*(1-$txAdm['valorAdmCota']/100)),2, ',', ',');?></td>
	    </tr>
	    <?php endforeach ?>	
	  </tbody>
	</table>


<?php $this->load->view('rodape'); ?>