<?php $this->load->view('cabecalhoAdmin');?>

<form action="<?=base_url("index.php/Clientes_Controller/updateSenha")?>" method="post">
	<div class="form-group">
		<label for="inputinputTaxaCotas">Taxa de ADM rendimentos cotas</label>
    	<input type="number" class="form-control" name="taxaCotas" id="inputinputTaxaCotas" aria-describedby="emailHelp" required value="<?= $valorAdmCota?>" disabled>
    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  	</div>
	<div class="form-group">
		<label for="inputTaxaRendimentos">Taxa de ADM rendimentos cotas</label>
    	<input type="number" class="form-control" name="taxaRendimentos" id="inputTaxaRendimentos" aria-describedby="emailHelp" required value="<?= $valorAdmRend?>" disabled>
  	</div>
    <div class="form-group">
    <label for="inputDiaRendimento">Dia rendimento mensal</label>
      <input type="number" class="form-control" name="diaRendimento" id="inputDiaRendimento" aria-describedby="emailHelp" required value="<?= $diaInicialRendimento ?>" disabled>
    </div>
  	<button type="submit" id="btnSalvar" class="btn btn-success" disabled>Salvar</button>
  	<input type="button" id="btnEditar" class="btn btn-primary" onclick="changeForm()" value="Editar">
  	<a href="<?= base_url("index.php/Clientes_Controller/alterarSenha")?>" class="btn btn-danger">Alterar Senha</a>
</form>

<br>


<script>
  function changeForm(){
      document.getElementById('inputinputTaxaCotas').disabled = false;
      document.getElementById('inputTaxaRendimentos').disabled = false;
      document.getElementById('inputDiaRendimento').disabled = false;
      document.getElementById('btnSalvar').disabled = false;
      document.getElementById('btnEditar').disabled = true;
    }

  function changeFormConta(){
      document.getElementById('selectBanco').disabled = false;
      document.getElementById('inputAgencia').disabled = false;
      document.getElementById('inputValor').disabled = false;
      document.getElementById('selectTipo').disabled = false;
      document.getElementById('btnEditarConta').disabled = true;
  }
  </script>


<?php $this->load->view('rodape'); ?>