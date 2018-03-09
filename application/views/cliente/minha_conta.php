<?php if ($this->session->userdata('usuario_logado')['tipo'] == 2) {
      $this->load->view('cabecalhoCliente');
    } else if ($this->session->userdata('usuario_logado')['tipo'] == 1){
      $this->load->view('cabecalhoAdmin');
    } ?>

<form action="<?=base_url("index.php/Clientes_Controller/updateSenha")?>" method="post">
	<div class="form-group">
		<label for="inputNome">Nome</label>
    	<input type="text" class="form-control" name="nome" id="inputNome" aria-describedby="emailHelp" required value="<?= $cliente['nome']?>" disabled>
    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
<form action="#" method="post">
  <div class="form-group">
      <label for="selectBanco">Banco</label>
      <select class="form-control" id="selectBanco" name="banco" required disabled>
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
    <label for="inputAgencia">Agencia</label>
      <input type="text" class="form-control" name="agencia" id="inputAgencia" value="<?= $contaSaque['agencia'] ?>" required aria-describedby="emailHelp" disabled>
    </div>
    <div class="form-group">
    <label for="inputValor">Conta</label>
      <input type="text" class="form-control" name="conta" id="inputValor" value="<?= $contaSaque['conta'] ?>" required aria-describedby="emailHelp" disabled>
    </div>
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
      document.getElementById('btnEditarConta').disabled = true;
  }
  </script>


<?php $this->load->view('rodape'); ?>