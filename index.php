
<?php

require_once '_classes/user.class.php';

$objuser= new user();


//FAZENDO O LOGIN
if(isset($_POST['btLogar'])){
  $objuser->logarUsuario($_POST);
}

?>

<!doctype html>
<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS e css de ajustes -->
  <link rel="stylesheet" href="_css/bootstrap.min.css">
  <link rel="stylesheet" href="_css/signin.css">
  <link rel="stylesheet" href="_css/ajuste.css">

  <title>Fox Fit</title>

</head>

<body background="_img/fundoll.png" >

  <div  class=" container-fluid">

    <div class="row">

      <div class="col-sm-4">   </div>



      <div id="bbl" class="col-sm-4"><!--Coluna Login-->
        <div class="text-center">

          <form action="" class="form-signin"  method="post">
            <img class="mb-2" src="_img/logologin.png" alt="" width="110" height="81">
            <h1 class="h5 mb-3 font-weight-normal">Login</h1>

            <label for="inputEmail"  class="sr-only">Usuário</label>
            <input type="text" name="nomeuser"  class=" cc1 form-control" placeholder="Usuário" required autofocus>

            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" name="senha"  class="form-control" placeholder="Senha" required>

            <button class="btn btn-lg btn-primary btn-block" type="submit" name="btLogar" >Entrar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2018-2019</p>

          </form>


          <?php 
          if(!empty($_GET["login"]) == "error"){ ?>
            <div class="alert alert-danger alert-block alert-aling mc-auto" role="alert">Ops! Usuário ou Senha Incorreto</div>
          <?php } ?>

        </div> <!--fim center-->

      </div><!--fim coluna login-->

<div class="col-sm-4"></div>


    </div><!--fim Linha-->

  </div> <!--fim container-->

</body>
</html>
