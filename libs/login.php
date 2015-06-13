<?php session_start();

// CASO SOLICITE CADASTRO
if(isset($_REQUEST['tipo']) && ($_REQUEST['tipo'] == "cadastro" || $_REQUEST['tipo'] == "face")){

	if(trim($_REQUEST['senha']) != trim($_REQUEST['conf-senha'])){
		die('Confirmação de senha não confere!');
	}

	include 'classes/classe_querys.php';
	include 'classes/classe.usuario.php';
	$conexao = new Query();
	$conexao->logar();
	$usuario = new Usuario($_REQUEST);	
	$dados['nome'] = $usuario->getNome();	
	$dados['email'] = $usuario->getEmail();	
	$dados['senha'] = $usuario->getSenha();	
	// VERIFICA SE EMAIL JÁ EXISTE
	$result = $conexao->procurarUsuarioEmail($usuario->getEmail());
	if(!is_array($result)){
		// CASO NÃO ENCONTRE FAZ O CADASTRO
		$resultcasdastro = $conexao->inserir($usuario->getTabela(), $dados);
		// SE CONFIRMADO ENTRA NA SESSAO
		if($resultcasdastro){
			// PROCURANDO O NOVO CADASTRO PARA INICIAR A SESSAP
			$result2 = $conexao->procurarUsuario($usuario->getEmail(), $usuario->getSenha());			
			if(is_array($result2)){

				$_SESSION["id"] = $result2[0]['id'];
				$_SESSION["nome"] = $result2[0]['nome'];
				$_SESSION["logado"] = "sim";
				$_SESSION["email"] = $result2[0]['email'];

				?>
			    <script type="text/javascript">  
					$(window.document.location).attr('href','principal.php');
				</script>
				<?php
				die();
			}else{
				die("Erro ao bucar usuario!");
			}
		}
	}else{

		if($_REQUEST['tipo'] == "face"){

			$result2 = $conexao->procurarUsuario($usuario->getEmail(), $usuario->getSenha());			
			if(is_array($result2)){

				$_SESSION["id"] = $result2[0]['id'];
				$_SESSION["nome"] = $result2[0]['nome'];
				$_SESSION["logado"] = "sim";
				$_SESSION["email"] = $result2[0]['email'];

				?>
			    <script type="text/javascript">  
					$(window.document.location).attr('href','principal.php');
				</script>
				<?php
				die();
			}else{
				die("Erro ao bucar usuario!");
			}

		}

		echo "Usuário Já existes!";
		die();
	}

// CASO SOLICITE APENAS ACESSO
}

if(isset($_REQUEST['tipo']) && $_REQUEST['tipo'] == "acesso"){

	include 'classes/classe_querys.php';
	include 'classes/classe.usuario.php';
	$conexao = new Query();
	$conexao->logar();
	$usuario = new Usuario($_REQUEST);	

	$result = $conexao->procurarUsuario($usuario->getEmail(), $usuario->getSenha());	

	if(is_array($result)){

		$_SESSION["id"] = $result[0]['id'];
		$_SESSION["nome"] = $result[0]['nome'];
		$_SESSION["logado"] = "sim";
		$_SESSION["email"] = $result[0]['email'];


		?>
	    <script type="text/javascript">  
			$(window.document.location).attr('href','principal.php');
		</script>
		<?php
	}else{
		echo "Login ou senha Incorreto!";
	}

// CASO SOLICITE APENAS VISITA
}else{

	$_SESSION["logado"] = "nao";
	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript">  
		$(window.document.location).attr('href','principal.php');
	</script>
	<?php

}

?>
