
<?php

require_once '_classes/funcao.class.php';
require_once '_classes/cliente.class.php';

$objFc = new funcao();
$objclient= new cliente();



?>

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
<body>

  <!--Inicio Menu Superior, está em posição fixa-->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">

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



  <div class="container-fluid">

    <div class="row">

      <div class="nm menu col-sm-3 d-none d-sm-block">

        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a  href="painel.php" class="nav-link">Painel</a>
          <a href="cliente.php" class="nav-link active" >Clientes</a>
          <a  href="vendas.php" class="nav-link">Venda</a>
          <a href="produto.php" class="nav-link" >Produtos</a>
          <a href="relatorio.php" class="nav-link" >Relatórios</a>
        </div>

      </div>




      <div class=" tela ml-auto col-sm-9 col-xs-12">


        <div class="row">

          <div class="container-fluid">
            <div class="titulo text-center bg-dark col-12">

             <h2 class="texto">CLIENTE</h2> 

           </div>

         </div>
       </div> <!--fim linha titulo-->



       <div class="row">


        <div class="col-sm-11 ">

          <div class="pesq">

           <form class="form-inline my-2 my-lg-0">
            <input class=" campo3 form-control mr-sm-2" name="buscar" type="search" placeholder="pesquisar" aria-label="Search">
            <button class="btn btn-primary my-2 my-sm-0" type="submit">Pesquisar</button>
          </form>

        </div>

      </div><!-- /.col-sm-6 -->


      <div class="col-sm-1">

        <label>
         <a href="cadastro_cliente.php"> <button type="button" class="btn btn-success btn-sm">Novo</button></a>

       </label> 


     </div>   



   </div> <!--linha pesquisa-->




   <div class="row">


    <?php 

    foreach($objclient->querySelectPagi() as $rst) { ?> 

      <div class=" t2 col-sm-6 ">
        <a href="cliente_geral.php?acao=edit&id=<?=$objFc->base64($rst['idcliente'], 1)?>"> 
         <div class="reg ">
           <label>
             <h5><?=$objFc->tratarCaracter($rst['nomecliente'], 2)?></h5> Contato: <?=$rst[ 'telefone']?>
           </label>
         </div>    
       </a>
     </div><!-- /.col-lg-4 -->

   <?php }?>

 </div>  <!--linha reg -->   


 <div class="row"><!--linha paginação -->


  <div class="col-12">

   <div class="pagi"> 
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1"> << </a>
        </li>

        <li class="page-item"><a class="page-link" href="?page=1"">1</a></li>
        <li class="page-item"><a class="page-link" href="?page=2">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        

        <li class="page-item">
          <a class="page-link" href="#"> >> </a>
        </li>
  

      </ul>
    </nav>
  </div>

</div><!-- /.col-lg-12 -->

</div><!--linha paginação -->




<div class="row">

  <div class="linha col-12 d-none d-sm-block"></div>

</div>



</div> <!--fim linha tela-->





</div> <!--fim container GERAL-->

















<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="_js/jquery-3.3.1.slim.min.js"></script>
<script src="_js/1.14.3/umd/popper.min.js" ></script>
<script src="_js/bootstrap.min.js"></script>
</body>
</html>