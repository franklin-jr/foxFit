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


if(isset($_POST['salvar'])){
  $exec = $objuser->queryInsert($_POST);
  if($exec== 'ok'){
   echo '<script type="text/JavaScript"> alert("CADASTRO EFETUADO")</script>';
   header("location: /sistemafox/painel.php");

 }else{
  echo '<script type="text/JavaScript"> alert("Erro, Cadastro nao Efetuado '.$exec.'")</script>';
}

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
  <link rel="stylesheet" href="_css/ajuste.css">


  <title>Fox Fit</title>

</head>
<body>


   <!--Inicio Menu Superior, está em posição fixa-->

      <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark ">

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
        <a class="nav-link" href="estoque.php">Estoque</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Relatórios</a>
          </li>

        </ul>

      </nav>
     <!--FIM Menu Superior, está em posição fixa-->

  <div class="container-fluid"><!--container GERAL -->



    <div class="row">
      <!-- menu Lateral -->
      <div class=" menu col-sm-3 d-none d-sm-block"><!--coluna lateral -->

        <div class="nm nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a href="painel.php" class="nav-link active" >Painel</a>
          <a href="cliente.php" class="nav-link" >Clientes</a>
          <a  href="vendas.php" class="nav-link">Venda</a>
          <a href="produto.php" class="nav-link" >Produtos</a>
          <a href="relatorio.php" class="nav-link" >Relatórios</a>
          <a href="estoque.php" class="nav-link" >Estoque</a>
        </div>
        <!-- FIM menu Lateral -->

        

          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <img src="_img/config.png">
           </button>
           <div class=" conf dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="" data-toggle="modal" data-target="#modal1"> Novo Usuário </a>
            <a class="dropdown-item" href="#">Alterar Usuário</a>
            <a class="dropdown-item" href="#">Permição de Usuário</a>
            <a class="dropdown-item" href="#">Alterar categoria</a>
            <a class="dropdown-item" href="#">Alterar Fabricante</a>
          </div>
        
      </div> <!-------------------------------- FIM config -------------------------------------------------------------->


    </div><!--FIM coluna lateral -->


    <div class=" tela ml-auto col-sm-9 col-xs-12"><!-- cloluna tela -->
     

        <div class="row"><!--linha titulo-->

          <div class="container-fluid">
            <div class="titulo text-center bg-dark col-12">

             <h2 class="texto">Painel</h2> 

           </div>

         </div>
       </div> <!--fim linha titulo-->



       <div class="row"><!--linha opções-->

        <div class=" t1 col-sm-3 col-6 "><!-- /.col-vender -->

          <label>
           <a href="#"> <img class="rounded-circle text-center" src="_img/venda.png" alt="Generic placeholder image" width="110" height="110"> 
            <h3 class="text-center">Vender</h3></a>
          </label>

        </div><!-- /.fim col-vender -->

        <div class=" t1 col-sm-3 col-1 col-6 "><!-- /.col-cliente -->

          <label>
           <a href="cadastro_cliente.php"> <img class="rounded-circle text-center" src="_img/cadcliente.png" alt="Generic placeholder image" width="110" height="110"> 
            <h3 class="text-center">+Cliente</h3></a>
          </label>

        </div><!-- /.fim col-cliente -->

        <div class=" t1 col-sm-3 col-6">

          <label>
           <a href="cadastro_produto.php"> <img class="rounded-circle text-center" src="_img/produto.png" alt="Generic placeholder image" width="110" height="110"> 
            <h3 class="text-center">+Produto</h3></a>
          </label>
        </div><!-- /.col-produto -->

        <div class=" t1 col-sm-3 col-6"><!-- /.col-caixa -->

          <label>
           <a href="#"> <img class="rounded-circle text-center" src="_img/caixa.png" alt="Generic placeholder image" width="110" height="110"> 
            <h3 class="text-center">Caixa</h3></a>
          </label>
        </div><!-- /.fim col-caixa -->

      </div><!--fim linha opções-->


      <div class="row">

        <div class="linha col-12 d-none d-sm-block"></div>

      </div>




    </div> <!--fim coluna tela-->



  </div> <!--fim container GERAL-->




  <!-- Modal cadastro de user -->
  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">CADASTRO DE USUÁRIO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <form method="post">
            <div class="form-group">
              <label for="exampleInputEmail1">Usuário</label>
              <input type="text" name="nomeuser" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite nome de Usuário">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Senha</label>
              <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite uma Senha" required autofocus>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Confirma Senha</label>
              <input type="password" class="form-control" id="conf_senha" placeholder="Confirme a Senha" required autofocus>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Sair</button>
              <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
            </div>

          </form>


        </div>
        
      </div>
    </div>
  </div>

  <!--FIM MODAL-->




  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="_js/jquery-3.3.1.slim.min.js"></script>
  <script src="_js/bootstrap.bundle.js" ></script>
  <script src="_js/bootstrap.min.js"></script>
   <script src="_js/valida.js"></script>
</body>
</html>