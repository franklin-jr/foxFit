
<?php

require_once '_classes/funcao.class.php';
require_once '_classes/cliente.class.php';

$objFc = new funcao();
$objclient= new cliente();

if(isset($_GET['acao'])){
  switch($_GET['acao']){
    case 'edit': $idcli = $objclient->querySeleciona($_GET['id']); break;
    case 'delet':
    if($idcli = $objclient->queryDelete($_GET['id']) == 'ok'){
      header("location: /sistemafox/cliente.php");
    }else{
      echo '<script type="text/JavaScript"> alert("ERRO - ligue para assistencia")</script>';
    }
    break;

  }
}

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


  <title>Clientes</title>



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

      <div class=" menu col-sm-3 d-none d-sm-block">

        <div class="nm nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a href="painel.php" class="nav-link" >Painel</a>
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



        <div class="t33 col-sm-2 ">  
         <label>
           <img  src="_img/clienteg.png" alt="Generic placeholder image" width="110" height="110"> 

         </label> 
       </div><!-- /.col-lg-2 -->


       <div class="t3 col-sm-7 ">

        <h2> <?=$idcli['nomecliente']?> </h2>  
        <label>
         <b>CPF:</b> <?=$idcli[ 'cpf']?></br>
         <b>Contato:</b> <?=$idcli['telefone']?></br>
         <b>Data Nas:</b> <?=$idcli['datanascimento']?></br>
         <b>Email:</b> <?=$idcli['email']?></br>
         <b>End:</b> <?=$idcli['endereco']?>, <?=$idcli['bairro']?>, <?=$idcli['cidade']?>-<?=$idcli['estado']?>
       </label>

     </div><!-- /.col-lg-7 -->


     <div class="t333 col-sm-3 col-xs-12 ">  
      <label>
       <a href="edita_cliente.php?acao=edit&id=<?=$objFc->base64($idcli['idcliente'], 1)?>"> 
        <button type="button" class="btn btn-primary btn-sm">Editar</button></a>

        <a href="" data-toggle="modal" data-target="#modals">
          <button type="button" class="btn btn-danger btn-sm">Excluir</button></a>
        </label> 
      </div><!-- /.col-lg-3 -->

    </div>  <!--linha reg -->   



    <div class="row">

      <div class="linha col-12 d-none d-sm-block"></div>

    </div>


  </div> <!--fim linha tela-->

  



</div> <!--fim container GERAL-->


<!-- MODAL------------------------------------------------------------>

<div class="modal" id="modals" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atenção</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja Excluir <?=$idcli['nomecliente']?> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
        <a href="?acao=delet&id=<?=$objFc->base64($idcli['idcliente'], 1)?>">
          <button type="submit" id="salvar" name="salvar" class="btn btn-success">Sim</button></a>
        </div>
      </div>
    </div>
  </div>

  <!--FIM MODAL----------------------------------------------------------->




  

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="_js/jquery-3.3.1.slim.min.js"></script>
  <script src="_js/1.14.3/umd/popper.min.js" ></script>
  <script src="_js/bootstrap.min.js"></script>
</body>
</html>