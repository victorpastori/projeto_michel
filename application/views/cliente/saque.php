<?php if ($this->session->userdata('usuario_logado')['tipo'] == 2) {
      $this->load->view('cabecalhoCliente');
    } else if ($this->session->userdata('usuario_logado')['tipo'] == 1){
      $this->load->view('cabecalhoAdmin');
    } ?>

<form action="<?=base_url("index.php/Contas_Controller/solicitarSaque")?>" method="post">
	<div class="form-group">
		<label for="inputValor">Valor</label>
    	<input type="number" class="form-control" name="valor" id="inputValor" aria-describedby="emailHelp" placeholder="Informe valor para saque">
  	</div>
  	<button type="submit" class="btn btn-primary">Solicitar Saque</button>
</form>


<?php $this->load->view('rodape'); ?>