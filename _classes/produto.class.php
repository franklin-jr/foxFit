<?php

require_once "_classes/conexao.class.php";
require_once "_classes/funcao.class.php";

class Produto{

	private $con;
	private $objproduto;
	private $idproduto;
	private $nomeproduto;
	private $idcategoria;
	private $corproduto;
	private $valorvproduto;
	private $valorcproduto;
	private $tamanhoproduto;
	private $idfabricante;
	private $quantproduto;
	private $fotoproduto;
    private $nomefabricante;
    private $nomecategoria;

	

	public function __construct() {

		$this->con = new conexao();
		$this->objproduto = new funcao();
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;

	}

	public function __get($atributo){
		return $this->$atributo;
	}

	public function querySeleciona($dado){
		try{
			$this->idproduto = $this->objproduto->base64($dado, 2);
			$cst = $this->con->conectar()->prepare("SELECT idproduto, nomeproduto, idcategoria, corproduto, valorvproduto, valorcproduto, tamanhoproduto, idfabricante, quantproduto, fotoproduto FROM produto WHERE idproduto = :idpro; ");
			$cst->bindParam(":idpro", $this->idproduto, PDO::PARAM_INT);
			$cst->execute();
			return $cst->fetch();

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}


	public function querySelect(){

		try{
			$pesq = isset($_GET['buscar']) ? $_GET['buscar'] : '';  
			$pesq = '%'.$pesq.'%';
			$cst = $this->con->conectar()->prepare("SELECT produto.idproduto, produto.nomeproduto, produto.idcategoria, produto.corproduto, produto.valorvproduto, produto.valorcproduto, produto.tamanhoproduto, fabricante.nomefabricante, produto.quantproduto, produto.fotoproduto FROM produto Inner Join fabricante on produto.idfabricante = fabricante.idfabricante WHERE produto.nomeproduto  LIKE :nomepesq OR produto.corproduto LIKE :nomepesq OR produto.tamanhoproduto LIKE :nomepesq ");
			$cst->bindParam( ":nomepesq", $pesq, PDO::PARAM_STR );
			$cst->execute();
			return $cst->fetchAll();

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}


	public function queryInsert($dados){

		try{

			$this->nomeproduto = $this->objproduto->tratarCaracter($dados['nomeproduto'], 1);
			$this->idcategoria= $dados['idcategoria'];
			$this->corproduto= $dados['corproduto'];
			$this->valorvproduto= $dados['valorvproduto'];
			$this->valorcproduto= $dados['valorcproduto'];
			$this->tamanhoproduto= $dados['tamanhoproduto'];
			$this->idfabricante= $dados['idfabricante'];
			$this->quantproduto= $dados['quantproduto'];
			$this->fotoproduto= "_imgproduto/" . $_FILES["fotoproduto"]["name"];
	

			$arquivo = $_FILES["fotoproduto"];

	/*		$largura = 280;		//280px
			$altura = 380;		//380px
			$tamanho = 100000;	//1MB
			//(VERIFICANDO A EXISTENCIA DO ARQUIVO E FAZENDO A VALIDACAO DO MESMO COM TRÊS CONDIÇÕES)
			if(!empty($arquivo['name'])){
				//VALIDANDO O TIPO DE IMAGEM
				//echo $arquivo['type'];
				if(!preg_match('/^(image)\/(jpeg|png)$/', $arquivo['type'])){
					$error = '<script type="text/javascript">alert("Só pode ser enviado imagens (JPG e PNG).");</script>';
				}
				//VALIDANDO AS DIMENSÕES DO ARQUIVO
				$dimensoes = getimagesize($arquivo['tmp_name']);
				if($dimensoes[0] > $largura || $dimensoes[1] > $altura){
					$error = '<script type="text/javascript">alert("Esta imagem precisa está nessas dimensões 280x180.");</script>';
				}
				//VALIDANDO O TAMANHO DO ARQUIVO
				if($arquivo['size'] > $tamanho){
					$error = '<script type="text/javascript">alert("Esta imagem precisa ser menor que 1MB.");</script>';
				}
				//(ALTERANDO O NOME DO ARQUIVO E ENVIANDO PARA PASTA QUE LHE FOI DESTINADA)						
				if(count($error) == 0){    */
					
				move_uploaded_file($arquivo['tmp_name'], $this->fotoproduto);
				//}

			$cst = $this->con->conectar()->prepare("INSERT INTO produto(nomeproduto, idcategoria, corproduto, valorvproduto, valorcproduto, tamanhoproduto, idfabricante, quantproduto, fotoproduto) VALUES(:nomeproduto, :idcategoria, :corproduto, :valorvproduto, :valorcproduto, :tamanhoproduto, :idfabricante, :quantproduto, :fotoproduto)");
			$cst->bindParam(":nomeproduto", $this->nomeproduto, PDO::PARAM_STR);
			$cst->bindParam(":idcategoria", $this->idcategoria, PDO::PARAM_STR);
			$cst->bindParam(":corproduto", $this->corproduto, PDO::PARAM_STR);
			$cst->bindParam(":valorvproduto", $this->valorvproduto, PDO::PARAM_STR);
			$cst->bindParam(":valorcproduto", $this->valorcproduto, PDO::PARAM_STR);
			$cst->bindParam(":tamanhoproduto", $this->tamanhoproduto, PDO::PARAM_STR);
			$cst->bindParam(":idfabricante", $this->idfabricante, PDO::PARAM_STR);
			$cst->bindParam(":quantproduto", $this->quantproduto, PDO::PARAM_STR);
			$cst->bindParam(":fotoproduto", $this->fotoproduto, PDO::PARAM_STR);
			
			if($cst->execute()){
				return 'ok';
			}else{
						//return 'erro '. $cst->errorInfo();
				echo "<pre>"; print_r($cst->errorInfo());
				die();
			}

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}

	/*public function queryUpdate($dados){

		try{
			$this->idcliente = $this->objclien->base64($dados['id'], 2);
			$this->nomecliente = $this->objclien->tratarCaracter($dados['nomecliente'], 1);
			$this->cpf= $dados['cpf'];
			$this->datanascimento= $dados['datanascimento'];
			$this->email= $dados['email'];
			$this->telefone= $dados['telefone'];
			$this->endereco= $dados['endereco'];
			$this->bairro= $dados['bairro'];
			$this->cidade= $dados['cidade'];
			$this->estado= $dados['estado'];
			$cst = $this->con->conectar()->prepare(" UPDATE cliente SET nomecliente = :nomecliente, cpf = :cpf, datanascimento = :datanascimento, email = :email, telefone = :telefone, endereco = :endereco, bairro = :bairro, cidade = :cidade, estado = :estado WHERE idcliente = :idcli ");

			$cst->bindParam(":idcli", $this->idcliente, PDO::PARAM_INT);
			$cst->bindParam(":nomecliente", $this->nomecliente, PDO::PARAM_STR);
			$cst->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
			$cst->bindParam(":datanascimento", $this->datanascimento, PDO::PARAM_STR);
			$cst->bindParam(":email", $this->email, PDO::PARAM_STR);
			$cst->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
			$cst->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
			$cst->bindParam(":bairro", $this->bairro, PDO::PARAM_STR);
			$cst->bindParam(":cidade", $this->cidade, PDO::PARAM_STR);
			$cst->bindParam(":estado", $this->estado, PDO::PARAM_STR);
			if($cst->execute()){
				return 'ok';
			}else{
				return 'erro';
			}

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}*/


	/*public function queryDelete($dado){

		try{
			$this->idcliente = $this->objclien->base64($dado, 2);
			$cst = $this->con->conectar()->prepare("DELETE FROM cliente WHERE idcliente = :idcli; ");
			$cst->bindParam(":idcli", $this->idcliente, PDO::PARAM_INT);
			if($cst->execute()){
				return 'ok';
			}else{
				return 'erro';
			}


		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}
	}*/



    public function queryUpdateQuant($dados){

		try{

			$qtd1 = $_POST["qatual"];
            $qtd2 = $_POST["quantproduto"];

            $entrada = $qtd1 + $qtd2;

			$this->idproduto= $dados['idproduto'];
			$this->quantproduto= $dados['quantproduto'];
			$cst = $this->con->conectar()->prepare(" UPDATE produto SET quantproduto = :entrada WHERE idproduto = :idproduto;");

            $cst->bindParam(":idproduto", $this->idproduto, PDO::PARAM_STR);
			$cst->bindParam(":entrada", $entrada, PDO::PARAM_STR);
			if($cst->execute()){
				return 'ok';
			}else{
				return 'erro';
			}

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}



public function queryUpdateQuantSaida($dados){

		try{

			$qtd1 = $_POST["qatual"];
            $qtd2 = $_POST["quantproduto"];

            $saida = $qtd1 - $qtd2;

			$this->idproduto= $dados['idproduto'];
			$this->quantproduto= $dados['quantproduto'];
			$cst = $this->con->conectar()->prepare(" UPDATE produto SET quantproduto = :saida WHERE idproduto = :idproduto;");

            $cst->bindParam(":idproduto", $this->idproduto, PDO::PARAM_STR);
			$cst->bindParam(":saida", $saida, PDO::PARAM_STR);
			if($cst->execute()){
				return 'ok';
			}else{
				return 'erro';
			}

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}

	/*public function queryDelete($dado){

		try{
			$this->idcliente = $this->objclien->base64($dado, 2);
			$cst = $this->con->conectar()->prepare("DELETE FROM cliente WHERE idcliente = :idcli; ");
			$cst->bindParam(":idcli", $this->idcliente, PDO::PARAM_INT);
			if($cst->execute()){
				return 'ok';
			}else{
				return 'erro';
			}


		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}
	}*/









//------------------------------------fim produto----------------------------------------

public function querySelectCat(){

		try{
			$cst = $this->con->conectar()->prepare("SELECT idcategoria, nomecategoria FROM categoria; ");
			$cst->execute();
			return $cst->fetchAll();

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}



    public function queryInsertCat($dados){

		try{
			$this->nomecategoria = $this->objproduto->tratarCaracter($dados['nomecategoria'], 1);
			

			$cst = $this->con->conectar()->prepare("INSERT INTO categoria(nomecategoria) VALUES(:nomecategoria)");
			$cst->bindParam(":nomecategoria", $this->nomecategoria, PDO::PARAM_STR);
			
			
			if($cst->execute()){
				return 'ok';
			}else{
						//return 'erro '. $cst->errorInfo();
				echo "<pre>"; print_r($cst->errorInfo());
				die();
			}

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}



//------------------------------------------------fim categoria--------------------------------------
	

	public function querySelectFab(){

		try{
			$cst = $this->con->conectar()->prepare("SELECT idfabricante, nomefabricante FROM fabricante; ");
			$cst->execute();
			return $cst->fetchAll();

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}


public function queryInsertFab($dados){

		try{
			$this->nomefabricante = $this->objproduto->tratarCaracter($dados['nomefabricante'], 1);
			

			$cst = $this->con->conectar()->prepare("INSERT INTO fabricante(nomefabricante) VALUES(:nomefabricante)");
			$cst->bindParam(":nomefabricante", $this->nomefabricante, PDO::PARAM_STR);
			
			
			if($cst->execute()){
				return 'ok';
			}else{
						//return 'erro '. $cst->errorInfo();
				echo "<pre>"; print_r($cst->errorInfo());
				die();
			}

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}


//carrinho------------------------------------------------------------------------------------------

public function carrinho($dado){
		$cst = $this->con->conectar()->prepare("SELECT produto.idproduto, produto.nomeproduto, produto.idcategoria, produto.corproduto, produto.valorvproduto, produto.valorcproduto, produto.tamanhoproduto, fabricante.nomefabricante, produto.quantproduto, produto.fotoproduto FROM produto Inner Join fabricante on produto.idfabricante = fabricante.idfabricante WHERE iduser = :iduser;");
		$cst->bindParam(":idpro", $this->idproduto, PDO::PARAM_INT);
		$cst->execute();
		$rst = $cst->fetch();
		$_SESSION['nomeproduto'] = $rst['nomeproduto'];
	}




												                                 









}
?>



