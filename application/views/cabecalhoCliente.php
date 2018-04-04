<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css")?>" />
	<title></title>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="<?= base_url("index.php/Clientes_Controller")?>">SCC</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="<?= base_url("index.php/Clientes_Controller/saque")?>">Saque <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="<?= base_url("index.php/Clientes_Controller/minhasCotas")?>">Cotas</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="<?= base_url("index.php/Clientes_Controller/minhaConta")?>">Minha Conta</a>
	      </li>
	      
	      <li class="nav-item">
	        <a class="nav-link" href="<?= base_url("index.php/Usuarios_Controller/logout")?>">Sair</a>
	      </li>
	    </ul>
	  </div>
	</nav>
	<div class="container">
		

	