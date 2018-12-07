
<?php

require_once '_classes/funcao.class.php';
require_once '_classes/cliente.class.php';

$objFc = new funcao();
$objclient= new cliente();

if(isset($_GET['acao'])){
  switch($_GET['acao']){
    case 'edit': $idcli = $objclient->querySeleciona($_GET['id']); break;

  }
}


if(isset($_POST['salvar'])){

  $exec = $objclient->queryUpdate($_POST);
  if($exec == 'ok'){
    header("location: /sistemafox/cliente.php");
    echo '<script type="text/JavaScript"> alert("CADASTRO EFETUADO")</script>';
  } else{
    echo '<script type="text/JavaScript"> alert("Erro, Cadastro nao Efetuado ',"||| ", $exec.'")</script>';
  }

}  //fim edita cliente
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


  <title>Edita</title>

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

  <div class="container-fluid"><!--container GERAL -->

    <div class="row">
      <!-- menu Lateral -->
      <div class=" menu col-sm-3 d-none d-sm-block">

        <div class="nm nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a href="painel.php" class="nav-link" >Painel</a>
          <a href="cliente.php" class="nav-link active" >Clientes</a>
          <a  href="vendas.php" class="nav-link">Venda</a>
          <a href="produto.php" class="nav-link" >Produtos</a>
          <a href="relatorio.php" class="nav-link" >Relatórios</a>
        </div>

      </div>
      <!-- FIM menu Lateral -->

      <div class=" tela ml-auto col-sm-9 col-xs-12"> <!--Coluna tela-->


        <div class="row"><!--linha titulo-->

          <div class="container-fluid">
            <div class="titulo text-center bg-dark col-12">

             <h2 class="texto">EDITA CLIENTE</h2> 

           </div>

         </div>
       </div> <!--fim linha titulo-->


       <div class="row"><!--linha icone e dados de cliente -->  

        <div class="t33 col-sm-2 ">   <!--icone de cliente-->
         <label>
           <img  src="_img/clienteg.png" alt="Generic placeholder image" width="80" height="80"> 

         </label> 
       </div><!-- fim icone cliente -->


       <div class="t4 col-sm-7 "> <!--coluna de dados de cliente-->

        <h4> <?=$idcli['nomecliente']?> </h4>  
        <label>
         <b>CPF:</b> <?=$idcli[ 'cpf']?></br>
         <b>Contato:</b> <?=$idcli['telefone']?></br>
         <b>Data Nas:</b> <?=$idcli['datanascimento']?></br>
         <b>Email:</b> <?=$idcli['email']?></br>
         <b>End:</b> <?=$idcli['endereco']?>, <?=$idcli['bairro']?>, <?=$idcli['cidade']?>-<?=$idcli['estado']?>
       </label>

     </div> <!--FIM coluna de dados de cliente-->


   </div>  <!--FIM linha icone e dados de cliente -->  



   <div class="row"><!--linha tela-->

    <div class=" t1 col-sm-12 "><!--coluna formulario-->


      <form method="post">
        <div class="form-row">

          <div class="col-sm-12">
            <input type="text" name="nomecliente" class="campo form-control" placeholder="Nome" required value= "<?=$idcli['nomecliente']?>">
          </div>

          <div class="col-sm-12">
            <input type="email" name="email" class="campo form-control" placeholder="email" required value= "<?=$idcli['email']?>">
          </div>


          <div class="col-sm-4 col-xs-12"> 
            <input type="text" name="cpf" class="campo form-control" placeholder="CPF"  required value= "<?=$idcli['cpf']?>" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" required autofocus>
          </div>

          <div class="col-sm-4 col-xs-12">
            <input type="text" name="datanascimento" class="campo form-control" placeholder="Data Nascimento" required value= "<?=$idcli['datanascimento']?>" onkeypress="mascaraData( this, event )" maxlength="10">
          </div>

          <div class="col-sm-4 col-xs-12">
            <input type="text" name="telefone" class="campo form-control" placeholder="telefone" required value= "<?=$idcli['telefone']?>" maxlength="14" onkeydown="javascript: fMasc( this, mTel ); " required autofocus>
          </div>


          <div class="col-sm-12">
            <input type="text" name="endereco" class="campo form-control" placeholder="Endereço" required value= "<?=$idcli['endereco']?>">
          </div>


          <div class="col-sm-3 col-xs-12">
            <input type="text" name="bairro" class="campo form-control" placeholder="Bairro" required value= "<?=$idcli['bairro']?>">
          </div>

          <div class="col-sm-3 col-xs-12">
            <input type="text" name="cidade" class="campo form-control" placeholder="Cidade" required value= "<?=$idcli['cidade']?>">
          </div>

          <div class="col-sm-3 col-xs-12">
            <input type="text" name="estado" class="campo form-control" placeholder="Estado" required value= "<?=$idcli['estado']?>">
          </div>


        </div>

        <button type="submit" id="salvar" name="salvar" class="btn btn-dark">Salvar</button>
        <input type="hidden" name="id" value="<?=$objFc->base64($idcli['idcliente'], 1)?>">


      </form>

    </div><!--FIM coluna formulario-->


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