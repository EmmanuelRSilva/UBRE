<?php session_start();

if($_SESSION['logado'] == "sim"){

	?><div id="instrucoes_comentario"></div><?php
	
}else{

	?>
	<div>Desculpe, apenas usuários cadastrados podem acessar estas funções!</div>	
	<div><a href="index.php">Cadastre-se</a></div>
	<?php

}

?>
<link rel="stylesheet" href="css/estilo_instrucoes_rota.css"/>
<script type="text/javascript">
	
	exibir = '<ul>';	

	for (var i = 0; i < instructions_rota.length; i++) {
	    exibir   += '<li>'+instructions_rota[i]+'</li>';          	    
  	};

  	exibir += '</ul>';	  	
  	$('#instrucoes_comentario').append(exibir); 

</script>
