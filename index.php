<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<title>UBRE  - Unidade de busca em Recife</title>
		<meta name="description" content="Descrição do App" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<!--Layout-->
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/plugin_login_face.js"></script>
		<script type="text/javascript" src="js/funcionalidadeLogin.js"></script>	
		<link rel="stylesheet" href="css/estiloLogin.css"/>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<!-- http://www.favicon-generator.org/ -->
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

	</head>
	<body>
		<section class="area">
			<h1 class="titulo">UBRE - Unidade de busca em Recife</h1>
			<div class="logo"><img src="img/logo.png"  alt="UBRE" title="UBRE"></div>
			<article id="login" class="painel login">
				<form id="form-face">
					<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
					<div id="status"></div>
					<input type="hidden" name="tipo" value="face" />
					<input type="hidden" name="nome" id="nomeFace" value="" />
					<input type="hidden" name="senha" id="idFace" value="" />
					<input type="hidden" name="conf-senha" id="idFace2" value="" />
					<input type="hidden" name="email" id="emailFace" value="" />
				</form>
				<form id="form-visitante">					
					<input type="hidden" name="tipo" value="visitante" />					
					<button  type="submit">Entrar como Visitante</button>
				</form>
				<form id="form-login">
					<input type="text" name="email" placeholder="Email" required="true"/>
					<input type="password" name="senha" placeholder="Senha" required="true"/>
					<input type="hidden" name="tipo" value="acesso" />
					<button class="azul" type="submit">Entrar</button>
				</form>
				<button id="inscreverSe"  onclick="janelaCadastro(true)" class="verde">Inscrever-se</button>
				<div class="resultado-login"></div>
			</article>
			
			<article id="cadastro" class="painel cadastro">
				<form id="form-cadastro">
					<input type="text" name="nome" placeholder="Login" required="true"/>
					<input type="email" name="email" placeholder="E-mail" required="true"/>
					<input type="password" name="senha" placeholder="Senha" required="true"/>
					<input type="password" name="conf-senha" placeholder="Confirmar Senha" required="true"/>
					<input type="hidden" name="tipo" value="cadastro" />
					<button class="verde" type="submit">Cadastrar</button>
				</form>
				<button id="fazerLogin" onclick="janelaCadastro(false)" class="azul" >Fazer Login</button>
				<div class="resultado-cadastro"></div>
			</article>
			
		</section>
		
		
		<script type="text/javascript">
			function janelaCadastro(bool){
				if(bool){
					$("#cadastro").css("left","5%");
					$("#login").css("left","-200%");
				}else{
					$("#cadastro").css("left","200%");
					$("#login").css("left","5%");
				}
			}		
			// VALIDAÇÃO PARA FORMULARIO
			$("#form-login").submit( function(){		
				carregaLogin("libs/login.php","#form-login",".resultado-login");
				return false;
			});

			$("#form-cadastro").submit( function(){		
				carregaLogin("libs/login.php","#form-cadastro",".resultado-cadastro");
				return false;
			});	

			$("#form-visitante").submit( function(){		
				carregaLogin("libs/login.php","#form-visitante",".resultado-login");
				return false;
			});	
		
		</script>
	</body>
</html>
