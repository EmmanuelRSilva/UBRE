<?php session_start(); 

if(isset($_SESSION['logado'])){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="author" content="EMMANUEL RODRIGUES" />
	<title>UBRE - Unidade de busca em Recife</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="language" content="pt-BR" />
	<meta name="robots" content="All" />
	<link href="css/estilo.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet"  type="text/css" href="css/estiloLogin.css" />
	<link href="css/jquery-ui.min.css" type="text/css" rel="stylesheet"/>
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="apple-touch-icon" sizes="57x57" href="icons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="icons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="icons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="icons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="icons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="icons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="icons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="icons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="icons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="icons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="icons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="icons/favicon-16x16.png">
	<link rel="manifest" href="icons/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

	<script type="text/javascript" src="js/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- MENUS MOBILE -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
	<link rel="stylesheet" href="js/menu/slicknav.css">
	<!-- FIM MENU -->
</head>


<body style="margin:0">
	<div id="mapa" style="width:100%; height:100%; position: absolute; margin:0"></div>
	
	<div id="container-menu">
		
		<ul id="menu">
			<li onclick="carrega('2db3a931-7cf2-4974-9c06-c9fc99b5f5af','unidade')"><img id="item-hospital" src="img/icon-hospital.png" alt="icone-hospital" title="Hospitais" /></li>
			<li onclick="carrega('33949d08-58db-49d7-a39b-dd8e465a8a4e','unidade')"><img src="img/icon-dentista.png" alt="icone-odontologico" title="Especialidades Odontológicas" /></li>
			<li onclick="carrega('17d66828-956b-4a12-942f-95ab3593377e','unidade')"><img src="img/icon-farmacia.png" alt="icone-farmacia" title="Farmacia da Família" /></li>
			<li onclick="carrega('d9af0982-f694-48e4-8ca0-afb184ce7f05','unidade')"><img src="img/icon-clinica.png" alt="icone-clinicas" title="Policlínicas" /></li>
			<li onclick="carrega('3390a4cc-1ae6-42b0-8ff7-02f07547eece','unidade')"><img src="img/icon-vacinas.png" alt="icone-clinicas" title="Unidades de vacinação" /></li>	
			<li onclick="carrega('874379d1-470f-40bb-a469-fe0228c62d09','academia_nome')"><img src="img/icon-academia.png" alt="icone-clinicas" title="Academia da Cidade" /></li>
			<li><a href="info.php"class="fancybox fancybox.ajax"><img src="img/info.png" alt="Sobre o sistema" title="Sobre o sistema" /></a></li>				
		</ul>
		<ul id="menu2">
			<li onclick="carrega('2db3a931-7cf2-4974-9c06-c9fc99b5f5af','unidade')"><a href="#"><img id="item-hospital" src="img/icon-hospital.png" width="20px" alt="icone-hospital" title="Hospitais" /> Hospitais</a></li>
			<li onclick="carrega('33949d08-58db-49d7-a39b-dd8e465a8a4e','unidade')"><a href="#"><img src="img/icon-dentista.png" width="20px" alt="icone-odontologico" title="Especialidades Odontológicas" /> Especialidades Odontológicas</a></li>
			<li onclick="carrega('17d66828-956b-4a12-942f-95ab3593377e','unidade')"><a href="#"><img src="img/icon-farmacia.png" width="20px" alt="icone-farmacia" title="Farmacia da Família" /> Farmacia da Família</a></li>
			<li onclick="carrega('d9af0982-f694-48e4-8ca0-afb184ce7f05','unidade')"><a href="#"><img src="img/icon-clinica.png" width="20px" alt="icone-clinicas" title="Policlínicas" /> Policlínicas</a></li>
			<li onclick="carrega('3390a4cc-1ae6-42b0-8ff7-02f07547eece','unidade')"><a href="#"><img src="img/icon-vacinas.png" width="20px" alt="icone-clinicas" title="Unidades de vacinação" /> Unidades de vacinação</a></li>	
			<li onclick="carrega('874379d1-470f-40bb-a469-fe0228c62d09','academia_nome')"><a href="#"><img src="img/icon-academia.png" width="20px" alt="icone-clinicas" title="Academia da Cidade" /> Academia da Cidade</a></li>
			<li><a href="info.php" class="fancybox fancybox.ajax"><img src="img/info.png" width="20px" alt="Sobre o sistema" title="Sobre o sistema" /> Sobre o sistema</a></li>							
		</ul>
	</div>	
	
	<div id="containerList">
		<div id="list-result"></div>
	</div>
	<div id="containerBusca">
		<form id="forma-partida">
			<label><strong>Endereço de Partida</strong></label>
			<div>
			<input type="" name="" id="endPart" placeholder=" ONDE VOCÊ ESTA?"  required />
			<button>OK</button>
			</div>
		</form>
	</div>	
	<script type="text/javascript" src="js/funcionalidade.js"></script>
	<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
	<script src="js/menu/jquery.slicknav.js"></script>
	<script type="text/javascript">
		initialize();
		$('#forma-partida').submit( function(){
			carregarMeuEnderecoDePartida($('#endPart').val());
			return false;
		});  
		$('.fancybox').fancybox();

		$(document).ready(function(){
			$('#menu2').slicknav();
		});
	</script>

</body>
</html>

<?php

}else{

	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript">  
		$(window.document.location).attr('href','index.php');
	</script>
	<?php

}

