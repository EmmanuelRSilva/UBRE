<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PUBLICAR NO MURAL</title>
<script language="JavaScript" src="scripts/jquery.js" type="text/javascript"></script>
<script language="JavaScript" src="scripts/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript">
$(document).ready( function() {
$("#mural").validate({
	// Define as regras
	rules:{
		nome:{
		// campoNome será obrigatorio (required) e terá tamanho minimo (minLength)
		required: true, minlength: 4
	},
		email:{
		// campoEmail será obrigatorio (required) e precisará ser um e-mail válido (email)
		required: true, email: true
	},
		msg:{
		// campoMensagem será obrigatorio (required) e terá tamanho minimo (minLength)
		required: true, minlength: 10
		}
	},
	// Define as mensagens de erro para cada regra
		messages:{
		nome:{
		required: "Digite o seu nome",
		minlength: "O seu nome deve conter, no mínimo, 4 caracteres"
	},
		email:{
		required: "Digite o seu e-mail para contato",
		email: "Digite um e-mail válido"
	},
		msg:{
		required: "Digite a sua mensagem",
		minlength: "A sua mensagem deve conter, no mínimo, 10 caracteres"
	}
	}
});
});
</script>

</head>
<div id="main">
<div id="geral">
<?php
if(isset($_POST['cadastra'])){

include "conexao.php";

$nome  = $_POST['nome'];
$email = $_POST['email'];
$msg   = $_POST['msg'];
$adiciona = mysql_query("INSERT INTO recados (nome, email, mensagem) VALUES ('$nome', '$email', '$msg')") or die ("Erro ao inserir dados na tabela".mysql_error());

}
?>

<div id="header">
	<h1>Mural de Recados</h1>
    
</div><!--header-->

<div id="formulario_mural">
<form name="mural" id="mural" method="post" enctype="multipart/form-data">
	<label for="cname">Nome:</label>
    <input id="cname" type="text" name="nome" />
    <br />
	<label>Email:</label>
    <input type="text" name="email" /><br />
	<label>Mensagem</label>
    <textarea name="msg"></textarea><br />
    <input type="submit" value="Publicar no Mural" name="cadastra" class="btn" />
</form>
</div><!--formulario_mural-->

<?php
include "conexao.php";
	$seleciona = mysql_query("SELECT * FROM recados ORDER BY id DESC");
	while($res = mysql_fetch_array($seleciona)){
		$id    = $res[0];
		$nome  = $res[1];
		$email = $res[2];
		$msg   = $res[3];
?>
<ul class="recados">
    <li><strong>ID:</strong> <?php echo $id; ?></li>
    <li><strong>Nome:</strong></li>
    <li><?php echo $nome; ?></li>
    <li><strong>Email:</strong></li>
    <li><?php echo $email; ?></li>
    <li><strong>Mensagem:</strong></li>
    <li><?php echo $msg; ?></li>
</ul>
<?php
}
?>
<div id="footer">
	
</div><!--footer-->
</div><!--geral-->
</div><!--main-->
</body>
</html>