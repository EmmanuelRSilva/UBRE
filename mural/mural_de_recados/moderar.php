<?php
include "conexao.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MODERAR COMENTÁRIOS</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="main">
<div id="geral">
<div id="header">
	<h1>Mural de Recados</h1>
   
</div><!--header-->

<?php
if(isset($_POST['atualiza'])){
	$idatualiza = $_POST['id'];
	$nome       = $_POST['nome'];
	$email      = $_POST['email'];
	$msg        = $_POST['msg'];
	
	$atualiza_sql = mysql_query("UPDATE recados SET id = '$idatualiza', nome = '$nome', email = '$email', mensagem = '$msg' WHERE id = '$idatualiza'") or die('Erro ao atualizar dados'.mysql_error());
	echo $idatualiza;
	

}
?>

<?php
if($_GET['acao']== 'editar'){
	$id = $_GET['id'];
	$seleciona = $recados = mysql_query("SELECT * FROM recados WHERE id=$id;");
	while($res = mysql_fetch_array($seleciona)){
		$id    = $res[0];
		$nome  = $res[1];
		$email = $res[2];
		$msg   = $res[3];
}
?>
<div id="formulario_mural">
<form name="mural" id="mural" method="post" enctype="multipart/form-data">
	<label for="cname">Nome:</label>
    <input id="cname" type="text" name="nome" value="<?php echo $nome; ?>" />
    <br />
	<label>Email:</label>
    <input type="text" name="email" value="<?php echo $email; ?>" /><br />
	<label>Mensagem</label>
    <textarea name="msg"><?php echo $msg; ?></textarea><br />
    <input type="hidden" name="id" value="<?php echo $id;?>" />
    <input type="submit" value="Modificar Recado" name="atualiza" class="btn" />
</form>
</div><!--formulario_mural-->
<?php
 }
?>
<!--deleta inicio-->
<?php
	if(isset($_GET['acao']) && $_GET['acao'] == 'excluir'){
	$remove = $_GET['acao'];
	$id = $_GET['id'];
	$deleta = mysql_query("DELETE FROM recados  WHERE id = $id") or die ("Erro ao deletar tados da tabela".mysql_error());
	echo $id."Recado removido!";
	
	}
?>

<?php
	$seleciona = $recados = mysql_query("SELECT * FROM recados ORDER BY id DESC");
	$contar_recados = mysql_num_rows($recados);
	if($contar_recados <= '0'){
	echo "Nenhum recado no mural!";
	}else{
	while($res = mysql_fetch_array($seleciona)){
		$id = $res[0];
		$nome = $res[1];
		$email = $res[2];
		$msg = $res[3];
?>
<ul class="recados">
<li><strong>ID do Recado: </strong><?php echo $id; ?> | <a href="moderar.php?acao=excluir&id=<?php echo $id; ?>">Remover Recado</a> | <a href="moderar.php?acao=editar&id=<?php echo $id; ?>">Modificar</a></li>
	<li><strong>NOME:</strong></li>
	<li><?php echo $nome; ?></li>
    <li><strong>EMAIL:</strong></li>
	<li><?php echo $email; ?></li>
    <li><strong>MENSAGEM:</strong></li>
	<li><?php echo $msg; ?></li>
</ul>
<?php
}
}
?>
<div id="footer">
	
</div><!--footer-->
</div><!--geral-->
</div><!--main-->
</body>
</html>
