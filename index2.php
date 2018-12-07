
<?php
//CHAMANDO CLASSE
require_once '_classes/user.class.php';
//INSTANCIANDO A CLASSE
$objuser= new user();

//VALIDANDO USUARIO
session_start();
if($_SESSION["logado"] == "sim"){
  $objuser->usuarioLogado($_SESSION['user']);
}else{
  header("location: /sistemafox"); 
}

//SAINDO DA CONTA
if(isset($_GET['sair']) == "sim"){
  $objuser->sairUsuario();
}

?>

<!doctype html>
<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="_css/bootstrap.min.css">
  <link rel="stylesheet" href="_css/ajuste.css">


  <title>Fox Fit</title>


</head>
<body  background="_img/fundoll.png">

  <div class="container">
    <!--Inicio Menu Superior, está em posição fixa-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

     <!--Zona de Login-->
     <img src="_img/user.png"> <div class="us border-right" > <span><?=$_SESSION['nomeuser']?></span> </div> 
     <div class="us1"> <a href="?sair=sim"><img src="_img/sair.png"> Sair</a></div> 

     <!--Botão aparece quando tela diminui (Responsivo), e inclusão de logo marca no menu-->
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index2.php">Inicio <span class="sr-only">(current)</span></a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="painel.php">Painel</a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="cliente.php">Cliente</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Vendas</a>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Produtos</a>

          <div class="dropdown-menu" aria-labelledby="navbarDropdown">

            <a class="dropdown-item" href="produto.php">Todos</a>
            <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="3">Leggin</a>
            <a class="dropdown-item" href="#">Regata</a>
            <a class="dropdown-item" href="#">Camiseta</a>

          </div>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="#">Estoque</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Relatórios</a>
        </li>

      </ul>

    </nav>

    <!--FIM Menu Superior, está em posição fixa-->

<div class="row"> <!--linha tela-->

<div class="campo col-sm-6">
    <!--carrossel-->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner ">
        <div class="carousel-item active">
          <img class="d-block w-100" src="_img/teste.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="_img/teste2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="_img/teste3.jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!--FIM carrossel-->
</div>

<div class="campo col-sm-6"> 

<div class="jumbotron">
  <h1 class="display-8">Bem vindo(a) <?=$_SESSION['nomeuser']?> !</h1>
  <p class="lead">Voce esta logado no sitema Fox Fit, a melhor loja de Moda Fitnnes. </p>
  <hr class="my-4">
  <p>Cadastre seus clientes, controle seu estoque, realize vendas e muito mais.</p>
  <a class="btn btn-primary btn-lg" href="painel.php" role="button">Iniciar</a>
</div>

</div>





</div><!--Fim linha tela-->



    <div class="row">

      <div class="container">
        <div class="teste col-12">

         <label class="texto">&copy; Excalibur sistemas </br>Contato:996914923</label> 

       </div>

     </div>
   </div>




 </div> <!--fim container1-->



 <!-- Optional JavaScript -->
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="_js/jquery-3.3.1.slim.min.js"></script>
 <script src="_js/1.14.3/umd/popper.min.js" ></script>
 <script src="_js/bootstrap.min.js"></script>
</body>
</html>