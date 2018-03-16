<?php $this->load->view('cabecalhoAdmin'); ?>

	<table id="my-table" class="table">
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


<?php $this->load->view('rodape'); ?>