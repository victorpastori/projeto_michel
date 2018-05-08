<?php $this->load->view('cabecalhoAdmin'); ?>

<table id="my-table" class="table">
	  <thead>
	    <tr>
	      <th scope="col">Nome</th>
	      <th scope="col">Saldo Saque</th>
		  <th scope="col">Total Inv. Ativos</th>
	      <th scope="col">Total Inv. Encerrados</th>
	      <th scope="col">Total Cotas Ativas</th>
	      <th scope="col">Total Cotas Fechadas</th>
	      <th scope="col">Total</th>
	      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($clientes as $index => $cliente) : ?>
			<tr>
		      <td><?= $cliente['nome'] ?></td>
		      <td>$ <?= number_format($cliente['saldoSaque'],2, ',', '.') ?></td>
		      <td>$ <?= number_format($saldoInvestimentos[$index]['total'],2, ',', '.') ?></td>
		      <td>$ <?= number_format($saldoInvestimentosEncerrados[$index]['total'],2, ',', '.') ?></td>
		      <td>$ <?= number_format($saldoCotas[$index]['total'],2, ',', '.') ?></td>
		      <td>$ <?= number_format($saldoCotasFechadas[$index]['total'],2, ',', '.') ?></td>
		      <td>$ <?= number_format($cliente['saldoSaque']+$saldoInvestimentos[$index]['total']+$saldoCotas[$index]['total'],2, ',', '.') ?></td>
		      <td><a href="<?= base_url("index.php/Admin_Controller/mostrarCliente?cliente=".$cliente['idcliente'])?>" class="btn btn-primary">Ver Perfil</a></td>
		    </tr>
		<?php endforeach ?>	
	  </tbody>
	</table>

	

<?php $this->load->view('rodape'); ?>