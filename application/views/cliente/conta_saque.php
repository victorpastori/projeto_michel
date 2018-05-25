<?php if ($this->session->userdata('usuario_logado')['tipo'] == 2) {
      $this->load->view('cabecalhoCliente');
    } else if ($this->session->userdata('usuario_logado')['tipo'] == 1){
      $this->load->view('cabecalhoAdmin');
    } ?>

<form action="<?= base_url("index.php/Clientes_Controller/cadastrarContaSaque")?>" method="post">
	<div class="row align-items-center">
		<div class="col-9">
	<div class="form-group">
	    <label for="selectBanco">Banco</label>
	    <select class="form-control" id="selectBanco" name="banco" onchange="mostraOperacao();">
		    <?php foreach ($bancos as $banco) : ?>
		
				<option value="<?= $banco['idbanco'] ?>"><?= $banco['codigo'] ?> - <?= $banco['nome'] ?></option>

			<?php endforeach ?>
	    </select>
  	</div>
	<div class="form-group">
		<label for="inputAgencia">Agencia(sem digito) </label>
    	<input type="text" class="form-control" name="agencia" id="inputAgencia" aria-describedby="emailHelp" placeholder="Informe o número de sua agência sem o digito)">
  	</div>
  	<div class="form-row">
  	<div class="col-3 form-group">
		<label for="inputConta">Conta</label>
    	<input type="text" class="form-control" name="conta" id="inputConta" aria-describedby="emailHelp" placeholder="Informe o número de sua conta">
  	</div>
  	<div class="col-1 form-group">
  		<label for="inputDigito">Digito</label>
    	<input type="text" class="form-control" name="digito" id="inputDigito" >
  	</div>
  	</div>

  	<div class="form-group">
		<label style="display: none" for="inputOperacao" id="lblOperacao" disabled="true">Operação
			<button style="display: none" type="button" class="btn btn-secondary" id="btnOperacao" disabled="true" data-toggle="tooltip" data-html="true" data-placement="top" title="
			001 – Conta Corrente de Pessoa Física</br>
			002 – Conta Simples de Pessoa Física</br>
			003 – Conta Corrente de Pessoa Jurídica</br>
			006 – Entidades Públicas</br>
			007 – Depósitos Instituições Financeiras</br>
			013 – Poupança de Pessoa Física</br>
			022 – Poupança de Pessoa Jurídica</br>">?</button> 
		</label>
    	<input style="display: none" type="text" class="form-control" name="operacao" id="inputOperacao" ddisabled="true" aria-describedby="emailHelp" placeholder="Informe a operação">
  	</div>

  	<div class="form-group">
	    <label for="selectTipo">Tipo</label>
	    <select class="form-control" id="selectTipo" name="tipo">
		    <option value="1">Corrente</option>
		    <option value="2">Poupança</option>
	    </select>
  	</div>
  	<button type="submit" class="btn btn-primary">Cadastrar Conta Saque</button>
  	</div>
  	</div>
</form>


<?php $this->load->view('rodape'); ?>