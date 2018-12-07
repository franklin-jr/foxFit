<?php

require_once "_classes/conexao.class.php";
require_once "_classes/funcao.class.php";

class cliente{

	private $con;
	private $objclien;
	private $idcliente;
	private $nomecliente;
	private $cpf;
	private $datanascimento;
	private $email;
	private $telefone;
	private $endereco;
	private $bairro;
	private $cidade;
	private $estado;
	private $data_cad;
	

	public function __construct() {

		$this->con = new conexao();
		$this->objclien = new funcao();
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;

	}

	public function __get($atributo){
		return $this->$atributo;
	}

	public function querySeleciona($dado){
		try{
			$this->idcliente = $this->objclien->base64($dado, 2);
			$cst = $this->con->conectar()->prepare("SELECT idcliente, nomecliente, cpf, datanascimento, email, telefone, endereco, bairro, cidade, estado, data_cad FROM cliente WHERE idcliente = :idcli; ");
			$cst->bindParam(":idcli", $this->idcliente, PDO::PARAM_INT);
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
			$cst = $this->con->conectar()->prepare("SELECT idcliente, nomecliente, cpf, datanascimento, email, telefone, endereco, bairro, cidade, estado, data_cad FROM cliente WHERE nomecliente  LIKE :nomepesq or telefone like :nomepesq or cpf Like :nomepesq ");
			$cst->bindParam( ":nomepesq", $pesq, PDO::PARAM_STR );

			$cst->execute();
			return $cst->fetchAll();

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}


		public function querySelectPagi(){

		try{//pesquisa
			$pesq = isset($_GET['buscar']) ? $_GET['buscar'] : '';  
			$pesq = '%'.$pesq.'%';
            //paginação
            
            $limete = 6;
            /* Recebe o número da página via parâmetro na URL */  
            $pagina = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;   
    
			// VALOR INICIAL PARA CADA PÁGINA MOSTRAR O REGISTRO
			$inicio = ($limete*$pagina) - $limete;
			// BUSCANDO O TOTAL DE REGISTRO E DIVINDINDO PELO LIMITE DE REGISTRO POR PÁGINA PARA DAR O NÚMERO DE PÁGINAS 
			$total_pag = ceil(count($this->querySelect()) / $limete);
			
           
	        //Verificar a pagina anterior e posterior
	        $pagina_anterior = $pagina - 1;
	        $pagina_posterior = $pagina + 1;
     


			$cst = $this->con->conectar()->prepare("SELECT idcliente, nomecliente, cpf, datanascimento, email, telefone, endereco, bairro, cidade, estado, data_cad FROM cliente WHERE nomecliente  LIKE :nomepesq or telefone like :nomepesq or cpf Like :nomepesq LIMIT :inicio, :limite");
			$cst->bindParam( ":nomepesq", $pesq, PDO::PARAM_STR );
			$cst->bindParam(":inicio", $inicio, PDO::PARAM_INT);
			$cst->bindParam(":limite", $limete, PDO::PARAM_INT);


			$cst->execute();
			return $cst->fetchAll();

		}catch(PDOException $ex){
			return 'erro'.$ex->getMessage();
		}

	}





	public function queryInsert($dados){

		try{

			$this->nomecliente = $this->objclien->tratarCaracter($dados['nomecliente'], 1);
			$this->cpf= $dados['cpf'];
			$this->datanascimento= $dados['datanascimento'];
			$this->email= $dados['email'];
			$this->telefone= $dados['telefone'];
			$this->endereco= $dados['endereco'];
			$this->bairro= $dados['bairro'];
			$this->cidade= $dados['cidade'];
			$this->estado= $dados['estado'];
			$this->data_cad= $this->objclien->dataAtual(2);


			$cst = $this->con->conectar()->prepare("INSERT INTO cliente(nomecliente, cpf, datanascimento, email, telefone, endereco, bairro, cidade, estado, data_cad) VALUES(:nomecliente, :cpf, :datanascimento, :email, :telefone, :endereco, :bairro, :cidade, :estado, :data_cad)");
			$cst->bindParam(":nomecliente", $this->nomecliente, PDO::PARAM_STR);
			$cst->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
			$cst->bindParam(":datanascimento", $this->datanascimento, PDO::PARAM_STR);
			$cst->bindParam(":email", $this->email, PDO::PARAM_STR);
			$cst->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
			$cst->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
			$cst->bindParam(":bairro", $this->bairro, PDO::PARAM_STR);
			$cst->bindParam(":cidade", $this->cidade, PDO::PARAM_STR);
			$cst->bindParam(":estado", $this->estado, PDO::PARAM_STR);
			$cst->bindParam(":data_cad", $this->data_cad, PDO::PARAM_STR);
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


	public function queryUpdate($dados){

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

	}


	public function queryDelete($dado){

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
	}








}
?>