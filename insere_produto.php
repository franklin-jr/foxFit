<?php
//CHAMANDO CLASSE
require_once '_classes/user.class.php';
require_once '_classes/produto.class.php';
//INSTANCIANDO A CLASSE
$objuser= new user();
$objproduto = new Produto();
$objFc = new funcao();

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



 // entrada produto
if(isset($_POST['salvar'])){

  $exec = $objproduto->queryUpdateQuant($_POST);
  if($exec == 'ok'){
    header("location: /sistemafox/insere_produto.php");
    echo '<script type="text/JavaScript"> alert("CADASTRO EFETUADO")</script>';
  } else{
    echo '<script type="text/JavaScript"> alert("Erro, Cadastro nao Efetuado ',"||| ", $exec.'")</script>';
  }

}  

// saida produto
if(isset($_POST['salvar1'])){

  $exec = $objproduto->queryUpdateQuantSaida($_POST);
  if($exec == 'ok'){
    header("location: /sistemafox/insere_produto.php");
    echo '<script type="text/JavaScript"> alert("CADASTRO EFETUADO")</script>';
  } else{
    echo '<script type="text/JavaScript"> alert("Erro, Cadastro nao Efetuado ',"||| ", $exec.'")</script>';
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
      <div class=" menu col-sm-3 d-none d-sm-block"><!--coluna lateral -->

        <div class="nm nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a href="painel.php" class="nav-link" >Painel</a>
          <a href="cliente.php" class="nav-link" >Clientes</a>
          <a  href="vendas.php" class="nav-link">Venda</a>
          <a href="produto.php" class="nav-link" >Produtos</a>
          <a href="relatorio.php" class="nav-link" >Relatórios</a>
          <a href="estoque.php" class="nav-link active" >Estoque</a>
        </div>
        <!-- FIM menu Lateral -->

        



      </div><!--FIM coluna lateral -->


      <div class=" tela ml-auto col-sm-9 col-xs-12"><!-- cloluna tela -->


        <div class="row"><!--linha titulo-->

          <div class="container-fluid">
            <div class="titulo text-center bg-dark col-12">

             <h2 class="texto">Entrada e Saida</h2> 

           </div>

         </div>
       </div> <!--fim linha titulo-->



       <div class="row"><!--linha opções-->



         <div class="col-sm-7 col-xs-12"> <!--coluna table-->

<div class="pesq">

           <form class="form-inline my-2 my-lg-0">
            <input class=" campo3 form-control mr-sm-2" name="buscar" type="search" placeholder="pesquisar" aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Pesquisar</button>
          </form>

        </div>
          
      <table class="campo table table-sm table-striped table-bordered">
        <thead class="thead-dark text-center">
          <tr>
            <th scope="col">Cod.</th>
            <th scope="col">Descrição</th>
            <th scope="col">Cor</th>
            <th scope="col">Qtd.</th>
            <th scope="col"></th>
            
          </tr>
        </thead>
        <tbody>
          <?php   foreach($objproduto->querySelect() as $rst) { ?>  
            <tr>
              <td><?=$rst[ 'idproduto']?></td>
              <td><?=$objFc->tratarCaracter($rst['nomeproduto'], 2)?> - <?=$rst[ 'tamanhoproduto']?></td>
              <td><?=$rst[ 'corproduto']?></td>
              <td><?=$rst[ 'quantproduto']?></td>
              <td>  <a href=""  data-toggle="modal" data-target="#modal2<?=$rst[ 'idproduto']?>"> Entrada </a> -  <a href=""  data-toggle="modal" data-target="#modal3<?=$rst[ 'idproduto']?>"> Saida </a>   </td>
              
            </tr>


            <!-- Modal entrada  -->
            <div class="modal fade" id="modal2<?=$rst[ 'idproduto']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Entrada de Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">


                    <form method="post">
            <div class="form-row">

             
                        <div class="col-sm-6">  <b>Produto: </b> <?=$objFc->tratarCaracter($rst['nomeproduto'], 2)?></br>   </div>
                        <div class="col-sm-6"> <b>Estoque Atual: </b>  <?=$rst[ 'quantproduto']?>   </div>
                        <div class="col-sm-6">  <b>Fab: </b> <?=$objFc->tratarCaracter($rst['nomefabricante'], 2)?></br>   </div>
                        <div class="col-sm-6"> <b>Valor Atual: </b>R$  <?=$rst[ 'valorvproduto']?>   </div>
                         <div class="col-sm-6"> <b>Cor: </b> <?=$rst[ 'corproduto']?>   </div>
                          <div class="col-sm-6"> <b>Tamanho: </b> <?=$rst[ 'tamanhoproduto']?>   </div>

                        <input type="hidden" name="qatual" value=" <?=$rst[ 'quantproduto']?>" class="campo form-control" id="inputEmail3" placeholder="quant">
              
                  <label for="inputEmail3" class="campo col-sm-2 col-form-label">Inserir:</label>
                  <div class="col-sm-3">
                    <input type="number"  name="quantproduto" class="campo form-control" id="inputEmail3" placeholder="quant">
                  </div>

                   <input type="hidden" name="idproduto" value="<?=$rst[ 'idproduto']?>" class="campo form-control" id="inputEmail3" placeholder="quant">
             

            </div>

            <button type="submit" id="salvar" name="salvar" data-target="salvar" class="btn btn-success">Inserir</button>
           

            </form>

                    
                  </div>

                </div>
              </div>
            </div>

            <!--FIM MODAL entrada -->



            <!-- Modal saida  -->
            <div class="modal fade" id="modal3<?=$rst[ 'idproduto']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Saida de Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">


                    <form method="post">
            <div class="form-row">

             
                        <div class="col-sm-6">  <b>Produto: </b> <?=$objFc->tratarCaracter($rst['nomeproduto'], 2)?></br>   </div>
                        <div class="col-sm-6"> <b>Estoque Atual: </b>  <?=$rst[ 'quantproduto']?>   </div>
                        <div class="col-sm-6">  <b>Fab: </b> <?=$objFc->tratarCaracter($rst['nomefabricante'], 2)?></br>   </div>
                        <div class="col-sm-6"> <b>Valor Atual: </b>R$  <?=$rst[ 'valorvproduto']?>   </div>
                         <div class="col-sm-6"> <b>Cor: </b> <?=$rst[ 'corproduto']?>   </div>
                          <div class="col-sm-6"> <b>Tamanho: </b> <?=$rst[ 'tamanhoproduto']?>   </div>

                        <input type="hidden" name="qatual" value=" <?=$rst[ 'quantproduto']?>" class="campo form-control" id="inputEmail3" placeholder="quant">
              
                  <label for="inputEmail3" class="campo col-sm-2 col-form-label">Saida:</label>
                  <div class="col-sm-3">
                    <input type="number"  name="quantproduto" class="campo form-control" id="inputEmail3" placeholder="quant">
                  </div>

                   <input type="hidden" name="idproduto" value="<?=$rst[ 'idproduto']?>" class="campo form-control" id="inputEmail3" placeholder="quant">
             

            </div>

            <button type="submit" id="salvar" name="salvar1" data-target="salvar" class="btn btn-success">Saida</button>
           

            </form>

                    
                  </div>

                </div>
              </div>
            </div>

            <!--FIM MODAL saida -->





          <?php } ?>
        </tbody>
      </table>


         </div>   <!--fim col table-->



<div class="col-sm-2"></div>
      


      <div class=" ops col-sm-3"><!--coluna cadastros---------------------------------------->


        <ul class="ops1 list-group">
          <a href="cadastro_produto.php"><li class="list-group-item">Cadastrar Produto</li></a>
          <a href="" data-toggle="modal" data-target="#modal1"><li class="list-group-item" >Cadastrar Fabricante</li></a>
          <a href="" data-toggle="modal" data-target="#modal2"><li class="list-group-item">Cadastrar Categoria</li></a>
          <a href="" data-toggle="modal" data-target="#modal3"><li class="list-group-item">Incluir Produto</li></a>

        </ul>

      </div><!--FIM coluna cadastros--------------------------------------------------->





    </div><!--fim linha opções-->


    <div class="row">

      <div class="linha col-12 d-none d-sm-block"></div>

    </div>



    

  </div> <!--fim coluna tela-->





</div> <!--fim container GERAL-->




<!-- Modal cadastro de Fabricanter -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CADASTRO DE FABRICANTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Fabricante</label>
            <input type="text" name="nomefabricante" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite nome de Fabricante">
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

<!--FIM MODAL fabricante-->


<!-- Modal cadastro de Categoria -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CADASTRO DE CATEGORIA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Categoria</label>
            <input type="text" name="nomecategoria" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite nome de Categoria">
          </div>

          

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Sair</button>
            <button type="submit" name="salvarcat" class="btn btn-primary">Salvar</button>
          </div>

        </form>


      </div>

    </div>
  </div>
</div>

<!--FIM MODAL Categoria-->






</div> <!-----Fim linha--->






<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="_js/jquery-3.3.1.slim.min.js"></script>
<script src="_js/bootstrap.bundle.js" ></script>
<script src="_js/bootstrap.min.js"></script>
<script src="_js/valida.js"></script>
</body>
</html>