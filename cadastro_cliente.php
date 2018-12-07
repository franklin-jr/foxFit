
<?php

require_once '_classes/funcao.class.php';
require_once '_classes/cliente.class.php';

$objFc = new funcao();
$objclient= new cliente();

if(isset($_POST['salvar'])){
  $exec = $objclient->queryInsert($_POST);
  if($exec== 'ok'){
   echo '<script type="text/JavaScript"> alert("CADASTRO EFETUADO")</script>';
   header("location: /sistemafox/cliente.php");

 }else{
  echo '<script type="text/JavaScript"> alert("Erro, Cadastro nao Efetuado '.$exec.'")</script>';
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
  header("location: ../sistemafox"); 
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

             <h2 class="texto">Cadastro de Cliente</h2> 

           </div>

         </div>
       </div> <!--fim linha titulo-->



       <div class="row">



        <div class=" t1 col-sm-12 ">


          <form method="post">
            <div class="form-row">

              <div class="col-sm-12">
                <input type="text" name="nomecliente" class="campo form-control" placeholder="Nome" required autofocus>
              </div>

              <div class="col-sm-12">
                <input type="email" name="email" class="campo form-control" placeholder="email" required autofocus>
              </div>


              <div class="col-sm-4 col-xs-12">
                <input type="text" name="cpf" class="campo form-control" placeholder="CPF"  onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" required autofocus>
              </div>

              <div class="col-sm-4 col-xs-12">
                <input type="text" name="datanascimento" class="campo form-control" placeholder="Data Nascimento" onkeypress="javascript: mascaraData( this, event )" maxlength="10">
              </div>

              <div class="col-sm-4 col-xs-12">
                <input type="text" name="telefone" class="campo form-control" placeholder="telefone" maxlength="14" onkeydown="javascript: fMasc( this, mTel ); " required autofocus>
              </div>



              <div class="col-sm-12">
                <input type="text" name="endereco" class="campo form-control" placeholder="Endereço">
              </div>




              <div class="col-sm-3 col-xs-12">
                <input type="text" name="bairro" class="campo form-control" placeholder="Bairro">
              </div>


              <div class="col-sm-3 col-xs-12">
                <input type="text" name="cidade" class="campo form-control" placeholder="Cidade">
              </div>

              <div class="col-sm-3 col-xs-12">
                <input type="text" name="estado" class="campo form-control" placeholder="Estado">
              </div>


            </div>

            <a href="" data-toggle="modal" data-target="#modals"> <button type="button"  class="btn btn-dark">Salvar</button></a>
            <button type="reset" class="btn btn-dark">Limpar</button>


            <!-- MODAL-->


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
                    <p>Confirme "Sim" para concluir Cadastro?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                    <button type="submit" id="salvar" name="salvar" data-target="salvar" class="btn btn-success">Sim</button>
                  </div>
                </div>
              </div>
            </div>

            <!--FIM MODAL-->


          </form>

        </div><!--fim linha cards-->



        <div class="container-fluid">
          <div class="row">

            <div class="roda col-12 d-none d-sm-block"></div>


          </div>

        </div>



      </div> <!--fim linha tela-->




    </div> <!--fim container GERAL-->

    



<script language=\"JavaScript\"> 
<!-- 


function isNum( caractere ) 
{ 
         var strValidos = \"0123456789\" 
         if ( strValidos.indexOf( caractere ) == -1 ) 
                 return false; 
         return true; 
} 
function validaTecla(campo, event) 
{ 
         var BACKSPACE=  8; 
         var key; 
         var tecla; 


         CheckTAB=true; 
         if(navigator.appName.indexOf(\"Netscape\")!= -1) 
                 tecla= event.which; 
         else 
                 tecla= event.keyCode; 


         key = String.fromCharCode( tecla); 
         //alert( \'key: \' + tecla + \'  -> campo: \' + campo.value); 


         if ( tecla == 13 ) 
                 return false; 
         if ( tecla == BACKSPACE ) 
                 return true; 
         return ( isNum(key)); 
} 
function FormataCNPJ( el ) 
{ 
         vr = el.value; 
         tam = vr.length; 


      if ( vr.indexOf(\".\") == -1 ) 
      { 
      if ( tam <= 2 ) 
              el.value = vr; 
      if ( (tam > 2) && (tam <= 6) ) 
              el.value = vr.substr( 0, 2 ) + \'.\' + vr.substr( 2, tam ); 
      if ( (tam >= 7) && (tam <= 10) ) 
              el.value = vr.substr( 0, 2 ) + \'.\' + vr.substr( 2, 3 ) + \'.\'  
+ vr.substr( 5, 3 ) + \'/\'; 
      if ( (tam >= 11) && (tam <= 18) ) 
             el.value = vr.substr( 0, 2 ) + \'.\' + vr.substr( 2, 3 ) + \'.\' +  
vr.substr( 5, 3 ) + \'/\' + vr.substr( 8, 4 ) + \'-\' + vr.substr( 12, 2 ) ; 
      } 
      return true; 
} 


//--> 
</script> 








    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="_js/jquery-3.3.1.slim.min.js"></script>
    <script src="_js/bootstrap.min.js"></script>
    <script src="_js/1.14.3/umd/popper.min.js" ></script>
    <script src="_js/mascaras.js"></script>
  </body>
  </html>