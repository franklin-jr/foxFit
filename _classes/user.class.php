<?php

require_once "_classes/conexao.class.php";
require_once "_classes/funcao.class.php";

class user{

	private $con;
	private $objuser;
	private $iduser;
	private $nomeuser;
	private $senhauser;
	


	public function __construct() {

		$this->con = new conexao();
		$this->objuser = new funcao();
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;

	}

	public function __get($atributo){
		return $this->$atributo;
	}

	

                //inseri usuario----------------------------------------------------------------
	public function queryInsert($dados){

		try{

			
			$this->nomeuser= $dados['nomeuser'];
			$this->senha= sha1($dados['senha']);
			
			$cst = $this->con->conectar()->prepare("INSERT INTO usuario(nomeuser, senha) VALUES(:nomeuser, :senha)");
			$cst->bindParam(":nomeuser", $this->nomeuser, PDO::PARAM_STR);
			$cst->bindParam(":senha", $this->senha, PDO::PARAM_STR);

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


	





//loga o usuario------------------------------------------------------------------------------------------
	public function logarUsuario($dados){
		
		$this->iduser= $dados['iduser'];
		$this->nomeuser= $dados['nomeuser'];
		$this->senha= sha1($dados['senha']);

		try{
			$cst = $this->con->conectar()->prepare("SELECT iduser, nomeuser, senha FROM usuario WHERE nomeuser = :nomeuser AND senha = :senha;");
			$cst->bindParam(':nomeuser', $this->nomeuser, PDO::PARAM_STR);
			$cst->bindParam(':senha', $this->senha, PDO::PARAM_STR);
			$cst->execute();
			if($cst->rowCount() == 0){
				header('location: /sistemafox/?login=error');
			}else{
				session_start();
				$rst = $cst->fetch();
				$_SESSION['logado'] = "sim";
				$_SESSION['user'] = $rst['iduser'];
				header('location: /sistemafox/index2.php');
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMassage();
		}
	}

//reconhece o usuario
	public function usuarioLogado($dado){
		$cst = $this->con->conectar()->prepare("SELECT iduser, nomeuser, senha FROM usuario  WHERE iduser = :iduser;");
		$cst->bindParam(':iduser', $dado, PDO::PARAM_INT);
		$cst->execute();
		$rst = $cst->fetch();
		$_SESSION['nomeuser'] = $rst['nomeuser'];
	}



	public function sairUsuario(){
		session_destroy();
		header ('location: http://localhost/sistemafox');
	}




}
?>