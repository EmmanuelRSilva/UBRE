<?php session_start();

if($_SESSION['logado'] == "sim"){

	include 'libs/classes/classe_querys.php';
	include 'libs/classes/classe.comentario.php';
	$conexao = new Query();
	$conexao->logar();
	$result = $conexao->procurarComentario($_REQUEST['latitude'],$_REQUEST['longitude']);

	if($result == false){ ?>
		<div class="area-comentario">			
			<div><strong>Ainda não existe um comentario!</strong></div>			
			<form id="form-comentario">									
				<label>Seja o primeiro e escreva algo</label>
				<textarea name="comentario" maxlength="200" ></textarea>	
				<input type="hidden" name="latitude" value="<?=$_REQUEST['latitude']?>" />
				<input type="hidden" name="longitude" value="<?=$_REQUEST['longitude']?>" />
				<input type="hidden" name="id" value="<?=$_SESSION['id']?>" />			
				<input type="submit" value="POSTAR" />				
			</form>
		</div>		
		<?php
	}else{
		?>

		<div class="area-comentario">	
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
		</div>		
		<?php
	}

}else{

	?>
	<div>Desculpe, apenas usuários cadastrados podem acessar os comentários!</div>	
	<div><a href="index.php">Cadastre-se</a></div>
	<?php

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

<script type="text/javascript" src="js/funcionalidadeLogin.js"></script>
<script type="text/javascript">			
	$("#form-comentario").submit( function(){		
		carregaLogin("libs/funcoes_coment.php","#form-comentario",".area-comentario");
		return false;
	});		

</script>
