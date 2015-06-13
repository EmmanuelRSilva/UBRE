<?php
//CONFIGURAÇÕES DO BANCO DE DADOS.
$host    = "localhost"; //SERVIDOR DO BANCO DE DADOS
$usuario = "root"; //USUARIO DO BANCO DE DADOS
$senha   = ""; //SENHA DO BANCO DE DADOS
$banco   = "mural"; //NOME DO BANCO DE DADOS

$conexao = mysql_connect($host, $usuario, $senha) or die("Erro ao logar no banco de dados".mysql_error());
$db = mysql_select_db($banco) or die ("Erro ao selecionar banco de dados".mysql_error());
?>