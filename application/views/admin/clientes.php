<?php $this->load->view('cabecalhoAdmin'); ?>

<table id="my-table" class="table">
	  <thead>
	    <tr>
	      <th scope="col">Nome</th>
	      <th scope="col">Saldo Saque</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($clientes as $cliente) : ?>
			<tr>
		      <td><?= $cliente['nome'] ?></td>
		      <td>US$ <?= number_format($cliente['saldoSaque'],2, ',', '.') ?></td>
		    </tr>
		<?php endforeach ?>	
	  </tbody>
	</table>

	

<?php $this->load->view('rodape'); ?>