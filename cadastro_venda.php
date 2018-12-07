
<?php

require_once '_classes/funcao.class.php';
require_once '_classes/produto.class.php';
require_once '_classes/cliente.class.php';

$objFc = new funcao();
$objproduto= new Produto();
$objclient= new cliente();


//seleciona cliente
if(isset($_GET['add'])){
  switch($_GET['add']){
    case 'cliente': $idcli = $objclient->querySeleciona($_GET['id']); 

  }
}





/*session_start();
if(!isset($_SESSION['itens'])){
  $_SESSION['itens'] = array();
} 
if(isset($_GET['add']) && $_GET['add'] == "carrinho"){
   $idproduto = $_GET['id'];
   if(!isset($_SESSION['itens'] [$idproduto])){
    $_SESSION['itens'] [$idproduto] =1;
   }else{
     $_SESSION['itens'] [$idproduto] +=1;
   }

}*/


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
        <a class="nav-link" href="estoque.php">Estoque</a>
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

        <div class="nm nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a  href="painel.php" class="nav-link">Painel</a>
          <a href="cliente.php" class="nav-link" >Clientes</a>
          <a  href="vendas.php" class="nav-link active">Venda</a>
          <a href="produto.php" class="nav-link" >Produtos</a>
          <a href="relatorio.php" class="nav-link" >Relatórios</a>
          <a href="estoque.php" class="nav-link" >Estoque</a>
        </div>

      </div>




      <div class=" tela ml-auto col-sm-9 col-xs-12">


        <div class="row">

          <div class="container-fluid">
            <div class="titulo text-center bg-dark col-12">

             <h2 class="texto">Vendas</h2> 

           </div>

         </div>
       </div> <!--fim linha titulo-->





       <div class="row mt-4"><!--linha form -->

        <div class="col-sm-6">
           <button data-toggle="modal" data-target="#modals" type="button" class="btn btn-primary btn-sm my-2 my-sm-0">Selecionar Cliente</button>


          <form>
            <div class="form-row"> 
              <div class="col-sm-12">
               <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="campo input-group-text" id="inputGroup-sizing-default">Cliente</span>
                </div>
                <input type="text" readonly="true" value="<?=$idcli['nomecliente']?>"  class="campo form-control" name="nomeproduto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>
            </div>

              <div class="col-sm-4">
               <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Cod.</span>
                </div>
                <input type="text" readonly="true" value="<?=$idcli['idcliente']?>"  class="form-control" name="nomeproduto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>
            </div>

             
              <div class="col-sm-8">
               <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">CPF</span>
                </div>
                <input type="text" readonly="true" value="<?=$idcli['cpf']?>"  class="form-control" name="nomeproduto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>
            </div>

         


         </div>

        </form>
     




      </div><!---Fim Coluna cliente e produto--->


      <div class="col-sm-6">
        <div class="col-sm-12 text-center" id="sele">
      <h3>Carrinho <img src="_img/carr.png"></h3>
         </div>

        <div class="table-responsive mt-sm-2">
          <table class="table table-striped table-bordered table-sm mt-sm-2">
            <thead>
              <tr class="text-center">
                <th>cod.</th>
                <th>fotoproduto</th>
                <th>Produto</th>
                <th>Cor</th>
                <th>Tamanho</th>
                <th>Valor und.</th>
              </tr>
            </thead>

            <tbody>

              <tr>     
                <td>2</td>
                <td> <img src="_imgproduto/calca.jpg" width="49" height="62">  </td>
                <td>Calça Leggin</td>
                <td>Preto</td>
                <td>P</td>
                <td>R$ 120,00</td>
              </tr>

              <tr>     
                <td>8</td>
                <td> <img src="_imgproduto/ff1.jpg" width="49" height="62">  </td>
                <td>Calça Leggin</td>
                <td>Preto</td>
                <td>P</td>
                <td>R$ 120,00</td>
              </tr>

              <tr>     
                <td>20</td>
                <td> <img src="_imgproduto/f1146.jpg" width="49" height="62">  </td>
                <td>Calça Leggin</td>
                <td>Preto</td>
                <td>P</td>
                <td>R$ 120,00</td>
              </tr>


            </tbody>
          </table>
        </div><!----final Table---->

        <div class="row">

        <div class=" col-sm-6 text-left">
          <button data-toggle="modal" data-target="#modalp" type="button" class="btn btn-success btn-sm my-2 my-sm-0">Inserir Produto</button>
 
        </div>


        <div class=" col-sm-6 text-right">
          <span> Valor Total: 360,00</span>
        </div>

</div>


      </div>   
    </div><!--Fim linha form -->  

















  </div> <!--fim linha tela-->




</div> <!--fim container GERAL-->






<!-- MODAL------------------------------------------------------------>

<div class="modal fade bd-example-modal-lg" id="modals" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atenção</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="table-responsive mt-sm-2">
          <table class="table table-striped table-bordered table-sm mt-sm-2">
            <thead>
              <tr>
                <th>cod.</th>
                <th>Cliente</th>
                <th>CPF</th>



              </tr>
            </thead>
            <tbody>
              <?php 

              foreach($objclient->querySelect() as $rst) { ?>  

                <tr>   

                  <td><?=$rst[ 'idcliente']?></td>
                  <td><a href="?add=cliente&id=<?=$objFc->base64($rst['idcliente'], 1)?>"><?=$objFc->tratarCaracter($rst['nomecliente'], 2)?></a></td>
                  <td><?=$rst[ 'cpf']?></td>


                <?php } ?>       

              </tbody>
            </table>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">voltar</button>


        </div>
      </div>
    </div>
  </div>

  <!--FIM MODAL----------------------------------------------------------->




  <!-- MODAL------------------------------------------------------------>

  <div class="modal fade bd-example-modal-lg" id="modalp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Selecione Produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
        <div class="modal-body">

          <div class="table-responsive mt-sm-2">
            <table class="table table-striped table-bordered table-sm mt-sm-2">
              <thead>
                <tr>
                  <th>cod.</th>
                  <th>fotoproduto</th>
                  <th>Produto</th>
                  <th>Cor</th>
                  <th>Tamnaho</th>
                  
                  
                  
                </tr>
              </thead>
              <tbody>
                <?php 

                foreach($objproduto->querySelect() as $rst) { ?>  

                  <tr>   

                    <td><?=$rst[ 'idproduto']?></td>
                    <td> <img src="<?=$rst[ 'fotoproduto']?>" width="76" height="95">  </td>
                    <td><a href="?add=carrinho$id=<?=$rst[ 'idproduto']?>"><?=$objFc->tratarCaracter($rst['nomeproduto'], 2)?></a></td>
                    <td><?=$rst[ 'corproduto']?></td>
                    <td><?=$rst[ 'tamanhoproduto']?></td>


                  <?php } ?>       

                </tbody>
              </table>
            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">voltar</button>


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