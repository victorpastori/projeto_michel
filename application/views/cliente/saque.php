<?php if ($this->session->userdata('usuario_logado')['tipo'] == 2) {
      $this->load->view('cabecalhoCliente');
    } else if ($this->session->userdata('usuario_logado')['tipo'] == 1){
      $this->load->view('cabecalhoAdmin');
    } ?>

<?php if ($this->session->flashdata('erroSaque')) { ?>

<div class="alert alert-danger" role="alert">
  <?php 
	echo $this->session->flashdata('erroSaque');
 ?>
</div>
<?php   } ?>

<?php if ($this->session->flashdata('saqueOk')) { ?>

<div class="alert alert-success" role="success">
  <?php 
	echo $this->session->flashdata('saqueOk');
 ?>
</div>
<?php   } ?>    

<form action="<?=base_url("index.php/Contas_Controller/solicitarSaque")?>" method="post">
	<div class="form-group">
		<label for="inputValor">Valor</label>
    	<input type="number" class="form-control" name="valor" id="inputValor" aria-describedby="emailHelp" placeholder="Informe valor para saque">
  	</div>
  	<button type="submit" class="btn btn-primary">Solicitar Saque</button>
</form>

<?php if ($saquesPendentes) { ?>
			Saques Pendentes<br>
		<table id="table-saques" class="table">
		  <thead>
		    <tr>
		      <th scope="col">Valor</th>
		      <th scope="col">Data</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($saquesPendentes as $saquePendente) : 
				$data = DateTime::createFromFormat('Y-m-d', $saquePendente['data']);
				$data = $data->format('d/m/Y'); ?>
				<tr>
			      <td>$<?= number_format($saquePendente['valor'],2, ',', ',')?></td>
			      <td><?= $data ?></td>
			    </tr>
			<?php endforeach ?> 
		  </tbody>
		</table>
	<?php } ?>


<?php $this->load->view('rodape'); ?>