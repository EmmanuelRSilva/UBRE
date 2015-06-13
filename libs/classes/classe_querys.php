<?php

class Query{

	private $conecta;
	private $conexao;	

	function logar(){
		if(!defined("HOST")){
		define('HOST','localhost');		
		}
		if(!defined("DB")){
		//define('DB','projeto');
		define('DB','projeto');
		}
		if(!defined("USER")){
		define('USER','root');
		//define('USER','root');
		}
		if(!defined("PASS")){
		define('PASS','');
		//define('PASS','');
		}			
		$this->conexao = 'mysql:host='.HOST.';dbname='.DB;									
		try{
			$this->conecta = new PDO($this->conexao,USER,PASS);
			$this->conecta->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				
		} catch (PDOexception $error_conecta) {
			echo htmlentities('Erro ao conectar'.$error_conecta->getMessage());
		}		
	}


	function inserir($tabela, $dados){

		// pega campos da array
		$arrCampo = array_keys($dados);		
		// pega valores da array
		$arrValores = array_values($dados);
		// conta campos da array
		$numCampo = count($dados);
		//conta valores array
		$numValores = count($dados);

		if ($numCampo == $numValores){
			$sql_inserir = "INSERT INTO ".$tabela." (";
			foreach($arrCampo as $campo){
				$sql_inserir.="$campo,";	
			}
			$sql_inserir = substr_replace($sql_inserir, ")", -1, 1);
			$sql_inserir.= "VALUES (";
			foreach($arrValores as $valores){
				$sql_inserir.="'".$valores."',";	
			}
			$sql_inserir = substr_replace($sql_inserir, ")", -1, 1);
			
			//die($sql_inserir)	;

		}
				
		try{
			$query_inserir = $this->conecta->prepare($sql_inserir);
			for($cont = 0;$cont < $numCampo; $cont++ ){				
				$query_inserir->bindValue("'".$arrCampo[$cont]."'",$arrValores[$cont],PDO::PARAM_STR);
			}
			$query_inserir->execute();						
			return(true);		
		} catch (PDOexception $error_insert){
			$erro = 'Erro ao Cadastrar'.$error_insert->getMessage();
			return($erro);
		}
	
		

	}

	function excluir($tabela,$id){

		$sql_excluir = 'DELETE FROM '.$tabela.' WHERE id = '.$id;
		// die($sql_excluir);						
		try{
			$query_excluir= $this->conecta->prepare($sql_excluir);
			$query_excluir->bindValue('id',$id,PDO::PARAM_INT);			
			$query_excluir->execute();
			$erro = "00";			
			return($erro);
		} catch (PDOexception $error_insert){
			$erro ='Erro ao Editar'.$error_insert->getMessage();
			return($erro);
		}
	

	}

	function procurarComentario($latitude,$longitude){		
	
		$sql_select = "SELECT * FROM comentario WHERE latitude='".$latitude."' AND longitude='".$longitude."' ;";

		try{
			$query_select = $this->conecta->prepare($sql_select);
			$query_select->execute();
			$resultado_query = $query_select->fetchALL(PDO::FETCH_ASSOC);
			$count = $query_select->rowCount(PDO::FETCH_ASSOC);	
			if($count != 0){
				return($resultado_query);
			}else{
				return(false);
			}	
		} catch (PDOexception $error_select){
			die('Erro ao selecionar'.$error_select->getMessage());
		}		

	}

	function procurarUsuario($email,$senha){		
	
		$sql_select = "SELECT * FROM usuario WHERE email='".$email."' AND senha='".$senha."' ;";
		
				
		try{
			$query_select = $this->conecta->prepare($sql_select);
			$query_select->execute();
			$resultado_query = $query_select->fetchALL(PDO::FETCH_ASSOC);
			$count = $query_select->rowCount(PDO::FETCH_ASSOC);	
			if($count != 0){
				return($resultado_query);
			}else{
				return(false);
			}	
		} catch (PDOexception $error_select){
			die('Erro ao selecionar'.$error_select->getMessage());
		}		

	}

	function procurarUsuarioEmail($email){		
	
		$sql_select = "SELECT * FROM usuario WHERE email='".$email."';";		
				
		try{
			$query_select = $this->conecta->prepare($sql_select);
			$query_select->execute();
			$resultado_query = $query_select->fetchALL(PDO::FETCH_ASSOC);
			$count = $query_select->rowCount(PDO::FETCH_ASSOC);	
			if($count != 0){
				return($resultado_query);
			}else{
				return(false);
			}	
		} catch (PDOexception $error_select){
			die('Erro ao selecionar'.$error_select->getMessage());
		}		

	}


	
	
	function procurarUsuarioId($id){		
	
		$sql_select = 'SELECT * FROM usuario where id='.$id;			
		try{
			$query_select = $this->conecta->prepare($sql_select);
			$query_select->execute();
			$resultado_query = $query_select->fetchALL(PDO::FETCH_ASSOC);
			$count = $query_select->rowCount(PDO::FETCH_ASSOC);	
			if($count == 0){
				return(false);
			}else{
				return($resultado_query);
			}	
		} catch (PDOexception $error_select){
			echo $sql_select;
			echo 'Erro ao selecionar'.$error_select->getMessage();
		}


	}
	
} // fim classe



?>
