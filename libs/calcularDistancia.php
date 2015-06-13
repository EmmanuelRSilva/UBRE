<?php

/*
Algoritimo copiado do site http://jf.eti.br/calculando-distancia-entre-dois-pontos-com-php/
e adapitado por Emmanuel Rodrigues.
utilizado para calcular as distancias de uma raio
*/
function distancia($lat1, $lon1, $lat2, $lon2,$id) {

	$result = "";
	$ids = "";
	for ($i=0; $i < count($lat2); $i++) { 

		$theta = $lon1 - $lon2[$i];
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2[$i])) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2[$i])) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper('K');
		$distancia = $miles * 1.609344;
		
		//ARMAZENA AS DISTANCIAS EM KILÔMETROS
		$arrayDistancia[$i] = $distancia;
		// if($distancia < 15){
		// 	$result .= $lat2[$i].",".$lon2[$i].";";			
		// 	//$dados[] = $distancia;
		// }		

	}
	retornoDeLog($arrayDistancia);
	// ORGANIZA A ARRAY POR ORDEM DE DISTANCIA CRESCENTE	
	asort($arrayDistancia);

	// REGISTRA UM LOG
	retornoDeLog($arrayDistancia);
	
	// PEGA OS PRIMEIROS 
	foreach ($arrayDistancia as $key => $value) {		
		if($key < 5){
			$result .= $lat2[$key].",".$lon2[$key].";";			
		}
	}

	// REFERENCIA AS DISTANCIAS ESCOLHIDAS AOS IDS
	foreach ($arrayDistancia as $key => $value) {
		if($key < 5){
			$ids .= $id[$key].";";			
		}
	}

	//retornoDeLog($arrayDistancia);
	//retornoDeLog($ids);


	$resultDist = substr($result, 0,-1);
	$resultIds = substr($ids, 0,-1);

	$resultado['distancias'] = $resultDist;
	$resultado['ids'] = $resultIds;

	return $resultado;
	
}

for ($i=1; $i < (count($_GET)/3)-1; $i++) { 
	$latitude[] = $_GET['latitude'.$i];
	$longitude[] = $_GET['longitude'.$i];
	$id[] = $_GET['_id'.$i];
}

//retornoDeLog($id);

 $res = distancia($_GET['minhaLat'],$_GET['minhaLong'], $latitude,$longitude,$id);

 echo $res['distancias']."/".$res['ids'];

// FUNÇÃO PARA ARMAZENAMENTO DE LOG
function retornoDeLog($texto,$titulo = "LogMonitoramento"){    
 
  date_default_timezone_set('America/Recife');
  $fp = fopen($titulo.".txt", "a");    
  $texto = print_r($texto,true);  
  $escreve = fwrite($fp,$texto);
  $linha  = "\n\n*-----------------------------------------------------------------------------------------------------------------------------------*\n";
  $linha .= "*-----------------------------------------".date("D M j G:i:s T Y")."----------------------------------------------------------";
  $linha .= "\n*-----------------------------------------------------------------------------------------------------------------------------------*\n \n";
  $escreve = fwrite($fp,$linha);                     
  fclose($fp);
 
}


?>