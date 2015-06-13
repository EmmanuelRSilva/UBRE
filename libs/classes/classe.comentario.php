<?php

class Comentario{

	private $tabela = "comentario";
	private $latitude;
	private $longitude;
	private $idUsuario;
	private $comentario;

	function __construct($post){

		$this->setLatitude($post);
		$this->setLongitude($post);
		$this->setIdUsuario($post);
		$this->setComentario($post);
	}

	function setLatitude($post){		
		if(isset($post['latitude'])){
			$this->latitude = trim(strip_tags($post['latitude']));
		}else{
			$this->latitude = "";
		}
	}

	function getLatitude(){		
		return $this->latitude;
	}

	function setLongitude($post){		
		if(isset($post['longitude'])){
			$this->longitude = trim(strip_tags($post['longitude']));
		}else{
			$this->longitude = "";
		}
	}

	function getLongitude(){		
		return $this->longitude;
	}

	function setIdUsuario($post){		
		if(isset($post['id'])){
			$this->idUsuario = trim(strip_tags($post['id']));
		}else{
			$this->idUsuario = "";
		}
	}

	function getIdUsuario(){		
		return $this->idUsuario;
	}

	function setComentario($post){		
		if(isset($post['comentario'])){
			$this->comentario = trim(strip_tags($post['comentario']));
		}else{
			$this->comentario = "";
		}
	}

	function getComentario(){		
		return $this->comentario;
	}


	function getTabela(){		
		return $this->tabela;
	}


}


?>