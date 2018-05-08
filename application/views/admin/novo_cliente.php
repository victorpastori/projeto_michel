<?php $this->load->view('cabecalhoAdmin'); ?>

<form action="<?= base_url("index.php/Clientes_Controller/cadastrarCliente")?>" method="post">
	<div class="form-group">
		<label for="inputNome">Nome</label>
		<input class="form-control" type="text" name="nome" id="inputNome" required placeholder="Informe seu nome completo">
	</div>

	<div class="form-group">
		<label for="inputCpf">CPF</label>
		<input class="form-control" type="text" id="txtCPF" name="txtCPF" id="inputCpf" required placeholder="Informe seu CPF" onkeypress="javascript: return EntradaNumerico(event);" onfocus="javascript: RemoveMask('txtCPF');" onblur="javascript: FG_FormatarCPF('txtCPF');" autocomplete="off">
	</div>

	<div class="form-group">
		<label for="inputEmail">E-mail</label>
		<input class="form-control" type="email" name="email" id="inputEmail" required placeholder="Informe um e-mail válido">
	</div>

	<div class="form-group">
		<label for="inputSenha">Senha</label>
		<input class="form-control" type="password" name="senha" id="inputSenha" required placeholder="Informe senha para acesso">
	</div>

	<div class="form-group">
	    <label for="selectBanco">Banco</label>
	    <select class="form-control" id="selectBanco" name="banco" onchange="mostraOperacao();">
		    <?php foreach ($bancos as $banco) : ?>
		
				<option value="<?= $banco['idbanco'] ?>"><?= $banco['codigo'] ?> - <?= $banco['nome'] ?></option>

			<?php endforeach ?>
	    </select>
  	</div>
	<div class="form-group">
		<label for="inputAgencia">Agencia 
			<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Introduza o código que identifica a agência do seu banco. Informe apenas os números antes do dígito. EX: Se sua agência é 1234-5 digite 1234.">?</button> 
		</label>
    	<input type="text" class="form-control" name="agencia" id="inputAgencia" aria-describedby="emailHelp" placeholder="Informe o número de sua agência">
  	</div>
  	<div class="form-group">
		<label for="inputConta">Conta
			<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Informe todo o número da conta, inclusive o dígito separado por hífen. Ex: Se sua conta é 12345-6 informe exatamente assim. Se o número da sua conta contem um X, substitua esta letra por um zero (0). Se sua conta possui o cógigo da transação para conta corrente ou poupança, não é necessário colocar, pois você já informou qual o tipo da conta.">?</button> 
		</label>
    	<input type="text" class="form-control" name="conta" id="inputConta" aria-describedby="emailHelp" placeholder="Informe o número de sua conta">
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
	
  	<button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
</form>

<script language="JavaScript" src="<?= base_url('js/validaCPF.js')?>"></script>
<?php $this->load->view('rodape'); ?>