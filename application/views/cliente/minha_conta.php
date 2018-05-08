<?php if ($this->session->userdata('usuario_logado')['tipo'] == 2) {
      $this->load->view('cabecalhoCliente');
    } else if ($this->session->userdata('usuario_logado')['tipo'] == 1){
      $this->load->view('cabecalhoAdmin');
    } ?>

<form action="<?=base_url("index.php/Clientes_Controller/updateDados")?>" method="post">
	<div class="form-group">
		<label for="inputNome">Nome</label>
    	<input type="text" class="form-control" name="nome" id="inputNome" aria-describedby="emailHelp" required value="<?= $cliente['nome']?>" disabled>
    	
  	</div>
	<div class="form-group">
		<label for="inputEmail">Email/Login</label>
    	<input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="emailHelp" required value="<?= $cliente['email']?>" disabled>
  	</div>
  	<button type="submit" id="btnSalvar" class="btn btn-success" disabled>Salvar</button>
  	<input type="button" id="btnEditar" class="btn btn-primary" onclick="changeForm()" value="Editar">
  	<a href="<?= base_url("index.php/Clientes_Controller/alterarSenha")?>" class="btn btn-danger">Alterar Senha</a>
</form>

<br>

<?php if (!$contaSaque) { ?>
  <a href="<?=base_url("index.php/Clientes_Controller/contaSaque")?>" class="btn btn-primary">Cadastrar Conta Saque</a>
<?php } else { ?>
<form action="<?=base_url("index.php/Clientes_Controller/updateContaSaque")?>" method="post">
  <div class="form-group">
      <label for="selectBanco">Banco</label>
      <select class="form-control" id="selectBanco" name="banco" required disabled onchange="mostraOperacao();">
        <?php foreach ($bancos as $banco) : ?>
        <?php if ($banco['idbanco'] == $contaSaque['idbanco']) { ?>
            <option value="<?= $banco['idbanco'] ?>" selected="selected"><?= $banco['codigo'] ?> - <?= $banco['nome'] ?></option>
        <?php } else { ?>
            <option value="<?= $banco['idbanco'] ?>"><?= $banco['codigo'] ?> - <?= $banco['nome'] ?></option>
        <?php } ?>
        

      <?php endforeach ?>
      </select>
    </div>
  <div class="form-group">
    <label for="inputAgencia">Agencia 
      <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Introduza o código que identifica a agência do seu banco. Informe apenas os números antes do dígito. EX: Se sua agência é 1234-5 digite 1234.">?</button> 
    </label>
      <input type="text" class="form-control" name="agencia" id="inputAgencia" value="<?= $contaSaque['agencia'] ?>" required aria-describedby="emailHelp" placeholder="Informe o número de sua agência" disabled>
    </div>
    <div class="form-group">
    <label for="inputConta">Conta
      <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Informe todo o número da conta, inclusive o dígito separado por hífen. Ex: Se sua conta é 12345-6 informe exatamente assim. Se o número da sua conta contem um X, substitua esta letra por um zero (0). Se sua conta possui o cógigo da transação para conta corrente ou poupança, não é necessário colocar, pois você já informou qual o tipo da conta.">?</button> 
    </label>
      <input type="text" class="form-control" name="conta" id="inputValor" value="<?= $contaSaque['conta'] ?>" required aria-describedby="emailHelp" disabled  placeholder="Informe o número de sua conta">
    </div>

    <?php if ($contaSaque['operacao']) { ?>
      <div class="form-group">
    <label for="inputOperacao" id="lblOperacao" >Operação
      <button  type="button" class="btn btn-secondary" id="btnOperacao"  data-toggle="tooltip" data-html="true" data-placement="top" title="
      001 – Conta Corrente de Pessoa Física</br>
      002 – Conta Simples de Pessoa Física</br>
      003 – Conta Corrente de Pessoa Jurídica</br>
      006 – Entidades Públicas</br>
      007 – Depósitos Instituições Financeiras</br>
      013 – Poupança de Pessoa Física</br>
      022 – Poupança de Pessoa Jurídica</br>">?</button> 
    </label>
      <input  type="text" class="form-control" name="operacao" id="inputOperacao" ddisabled="true" aria-describedby="emailHelp" disabled="true" placeholder="Informe a operação" value="<?= $contaSaque['operacao'] ?>">
    </div>

    <?php } else { ?>

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
    <?php } ?>
    
    <div class="form-group">
      <label for="selectTipo">Tipo</label>
      <select class="form-control" id="selectTipo" name="tipo" required disabled>
        <?php if ($contaSaque['tipo'] == 1) { ?>
            <option value="1" selected="selected">Corrente</option>
            <option value="2">Poupança</option>
        <?php } else { ?>
            <option value="1" >Corrente</option>
            <option value="2" selected="selected">Poupança</option>
        <?php } ?>
      </select>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <input type="button" id="btnEditarConta" class="btn btn-primary" onclick="changeFormConta()" value="Editar">
</form>
<?php } ?>


<script>
  function changeForm(){
      document.getElementById('inputNome').disabled = false;
      document.getElementById('inputEmail').disabled = false;
      document.getElementById('btnSalvar').disabled = false;
      document.getElementById('btnEditar').disabled = true;
    }

  function changeFormConta(){
      document.getElementById('selectBanco').disabled = false;
      document.getElementById('inputAgencia').disabled = false;
      document.getElementById('inputValor').disabled = false;
      document.getElementById('selectTipo').disabled = false;
      document.getElementById('inputOperacao').disabled = false;
      document.getElementById('btnEditarConta').disabled = true;
  }
  </script>

<?php $this->load->view('rodape'); ?>