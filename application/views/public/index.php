<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url("css/signin.css")?>" />
    <link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css")?>" />
    <title></title>
</head>
<body class="text-center">
  

    <form class="form-signin" action="<?= base_url("index.php/Usuarios_Controller/autenticar")?>" method="post">
      <?php if ($this->session->flashdata('erroLogin')) { ?>

        <div class="alert alert-danger" role="alert">
          <?php 
          echo $this->session->flashdata('erroLogin');
         ?>
        </div>
        <?php   } ?>
</div>
      <?= pow(1+1, 7/30)-1; ?>
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Log in</h1>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" name="login" class="form-control" placeholder="Email" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" id="inputSenha" name="senha" class="form-control" placeholder="Senha" required="">
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
    </form>
</body>
</html>