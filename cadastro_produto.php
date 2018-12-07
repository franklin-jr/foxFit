
<?php

require_once '_classes/funcao.class.php';
require_once '_classes/produto.class.php';

$objFc = new funcao();
$objproduto= new Produto();


if(isset($_POST['salvar'])){
  $exec = $objproduto->queryInsert($_POST);
  if($exec== 'ok'){
   echo '<script type="text/JavaScript"> alert("CADASTRO EFETUADO")</script>';
   header("location: /sistemafox/painel.php");

 }else{
  echo '<script type="text/JavaScript"> alert("Erro, Cadastro nao Efetuado '.$exec.'")</script>';
}

}

?>
<!---------------------------------------------------------------------------------------->

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
          <a href="cliente.php" class="nav-link " >Clientes</a>
          <a  href="vendas.php" class="nav-link">Venda</a>
          <a href="produto.php" class="nav-link active" >Produtos</a>
          <a href="relatorio.php" class="nav-link" >Relatórios</a>
        </div>

      </div>




      <div class=" tela ml-auto col-sm-9 col-xs-12"><!-- tela-->


        <div class="row">

          <div class="container-fluid">
            <div class="titulo text-center bg-dark col-12">

             <h2 class="texto">PRODUTO</h2> 

           </div>

         </div>
       </div> <!--fim linha titulo-->




       <div class=" t5 col-sm-8 ">


        <form method="post" enctype="multipart/form-data">
          <div class="form-row">
            <!------------------------------------------------------------------------------------------>
            <div class="col-sm-6">

             <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class=" campo input-group-text" id="inputGroup-sizing-default">Descrição</span>
              </div>
              <input type="text" maxlength="20" class="campo form-control" name="nomeproduto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

          </div>
          <!------------------------------------------------------------------------------------------>
          <div class="col-sm-6">

           <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="campo input-group-text" id="inputGroup-sizing-default">Categoria</span>
          </div>
          <select class="campo custom-select" name="idcategoria" id="inputGroupSelect01">
            <option value="1">--</option>
              <?php foreach($objproduto->querySelectCat() as $rst) { ?>
                <option value="<?=$rst[ 'idcategoria']?>"><?=$rst[ 'nomecategoria']?></option>
              <?php }?>
           
          </select>
        </div>

        </div>
        <!------------------------------------------------------------------------------------------>




        <div class="col-sm-3">

         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Tamanho</span>
          </div>
          <select class="custom-select" name="tamanhoproduto" id="inputGroupSelect01">
            <option value="P">P</option>
            <option value="M">M</option>
            <option value="G">G</option>
          </select>
        </div>

      </div>

      <!------------------------------------------------------------------------------------------>
      <div class="col-sm-4">

       <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Cor</span>
        </div>
       <select class="custom-select" name="corproduto" id="inputGroupSelect01">
            <option value="Preto">Preto</option>
            <option value="Branco">Branco</option>
            <option value="Azul">Azul</option>
            <option value="Vermelho">Vermelho</option>
            <option value="Estampado">Estampado</option>
            <option value="Rosa">Rosa</option>
          </select>
      </div>

    </div>
    <!------------------------------------------------------------------------------------------>
    <div class="col-sm-5">

     <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Fabricante</span>
          </div>
          <select class="custom-select" name="idfabricante" id="inputGroupSelect01">
            <option value="1">--</option>
              <?php foreach($objproduto->querySelectFab() as $rst) { ?>
                <option value="<?=$rst[ 'idfabricante']?>"><?=$rst[ 'nomefabricante']?></option>
              <?php }?>
           
          </select>
        </div>

  </div>

  <!------------------------------------------------------------------------------------------>
  <div class="col-sm-4">

   <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-default">R$ Venda</span>
    </div>
    <input type="text" class="form-control" name="valorvproduto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" onKeyPress="return(moeda(this,'.',',',event))">
  </div>

</div>
<!------------------------------------------------------------------------------------------>

<div class="col-sm-4">

 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">R$ Custo</span>
  </div>
  <input type="text" class="form-control" name="valorcproduto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" onKeyPress="return(moeda(this,'.',',',event))">
</div>

</div>
<!------------------------------------------------------------------------------------------>

<div class="col-sm-3">

 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Qtd.</span>
  </div>
  <input type="number" class="form-control" name="quantproduto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
</div>

</div>
<!------------------------------------------------------------------------------------------>

<div class="col-sm-8">

 <div class="form-group">
  <label for="exampleFormControlFile1">Foto do Produto</label>
  <input type="file" class="form-control-file" name="fotoproduto" id="exampleFormControlFile1">
</div>

</div>
<!------------------------------------------------------------------------------------------>


<div class="col-sm-4 col-xs-12">
  <a href="" data-toggle="modal" data-target="#modals"> <button type="button"  class="btn btn-dark">Salvar</button></a>
  <button type="reset" class="btn btn-dark">Limpar</button>
</div>



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
                    <p>Confirme "Sim" para concluir Cadastro de Produto?</p>
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

</div><!--fim col form-->


</div><!--linha de fechamento -->



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
<script src="_js/mascaras.js"></script>
</body>
</html>