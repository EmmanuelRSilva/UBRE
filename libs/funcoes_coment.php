<?php session_start();
if($_SESSION['logado'] == "sim"){

	include 'classes/classe_querys.php';
	include 'classes/classe.comentario.php';
	$conexao = new Query();
	$conexao->logar();
	$comentario = new Comentario($_REQUEST);
	$dados['latitude'] = $comentario->getLatitude();
	$dados['longitude'] = $comentario->getLongitude();
	$dados['comentario'] = $comentario->getComentario();
	$dados['id_usuario'] = $comentario->getIdUsuario();
	$result = $conexao->inserir($comentario->getTabela(), $dados);

	if($result){
		$result = $conexao->procurarComentario($comentario->getLatitude(),$comentario->getLongitude());
		?>
		
		<?php
		foreach ($result as $key => $value) {
			?>
			<div class="item-coments">
				<div class="nome"><strong><?=$conexao->procurarUsuarioId($value['id_usuario'])[0]['nome']?></strong> - <?=formaData($value['data'])?> - <?=formaHora($value['data'])?></div>
				<div class="coment"><?=$value['comentario']?></div>
			</div> 
			<?php 
		} 
		?>			
		<form id="form-comentario">									
			<label>Escreva algo</label>
			<textarea name="comentario"  maxlength="200" ></textarea>	
			<input type="hidden" name="latitude" value="<?=$_REQUEST['latitude']?>" />
			<input type="hidden" name="longitude" value="<?=$_REQUEST['longitude']?>" />
			<input type="hidden" name="id" value="<?=$_SESSION['id']?>" />			
			<input type="submit" value="POSTAR" />				
		</form>
		
		<?php
	}



}

function formaData($data){
	$d = new DateTime($data);
	$data = $d->format('d/m/Y');	 
    return $data;
}

function formaHora($hora){
	$d = new DateTime($hora);
	$hora = $d->format('H:i:s');	 
    return $hora;
}

	


?>
