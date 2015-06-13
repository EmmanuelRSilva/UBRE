

var map;
var geocoder;
var bounds = new google.maps.LatLngBounds();
var markersArray = [];
var resultRaios = [];
var destinos = [];
var idDestinos = [];
var nomes = [];
var titulos = [];
var telefones = [];
var Idtiulos = [];
var latitudes = [];
var longitudes = [];
var instructions_rota = [];
var minhaLat;
var minhaLong;
var minhaLocalizacao;
var directionsDisplay;
var meuMarcador;
var directionsService = new google.maps.DirectionsService();
var tipoLocomocao = 1; // carro
var destinationIcon = 'img/icon-map.svg';
var originIcon = 'img/icon-map2.svg';

function initialize(){
	// INICIA O PROCESSO DE CARREGAMENTO DO MAPA
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(carregaMapa,error);
    } else { 
        x.innerHTML = "O Navegador não suporta a Geolocalização!.\n Informe sua loacalização no campo de texto!";
    }
}

function error(){
	alert("Houve um erro ao carregar a geolocalização!\n Informe seu endereço de partida para obter um melhor resultado!");
  carregaMapaRecife();
}



function calcRoute(destinoRota,item) {
  // ISSO AQUI SERVE PARA RETIRAR OS ITENS LISTADOS QUE NÃO FORAM ESCOLHIDOS
  
  for (var i = 0 ; i < 5; i++) {    
    if(i != item){
      $('.caixa'+i).remove();
    }else{
      $('.caixa'+i).css('display','block');
    }
  };

  $(".desc").css('display','block');
  $(".acoes").css('display','block');

  // DELETANDO O MAPA ATUAL
  deleteOverlays();  
  if(tipoLocomocao == 1){
    var request = {
        origin:minhaLocalizacao,
        destination:destinoRota,
        travelMode: google.maps.TravelMode.WALKING
    };
  }else if(tipoLocomocao == 2){
    var request = {
        origin:minhaLocalizacao,
        destination:destinoRota,
        travelMode: google.maps.TravelMode.BICYCLING
    };
  }else if(tipoLocomocao == 3){
    var request = {
        origin:minhaLocalizacao,
        destination:destinoRota,
        travelMode: google.maps.TravelMode.DRIVING
    };
  }

  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {      
      directionsDisplay.setDirections(response);
      var routess = response.routes[0].legs[0].steps;
      for (var i = 0; i < routess.length; i++) {
        //ARMAZENADO AS INSTRUCOES DE ROTA
        instructions_rota[i] = routess[i].instructions;
        //console.debug(routess[i].instructions);
      };   
     
    }
  });
  organizarCards();
}

function carregaMapa(position) {	 	
 	// CARREGA MINHA LOCALIZAÇÃO
 	minhaLat = position.coords.latitude;
 	minhaLong = position.coords.longitude;
 	minhaLocalizacao = new google.maps.LatLng(minhaLat,minhaLong);
    var mapOptions = {
      center: minhaLocalizacao,
      icon: originIcon,
      zoom: 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    // CARREGA O ICONE INDICADOR
    map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
    directionsDisplay = new google.maps.DirectionsRenderer();
    directionsDisplay.setMap(map);   
    
    geocoder = new google.maps.Geocoder();	   
    meuMarcador = new google.maps.Marker({
				      position: minhaLocalizacao,
              icon: originIcon,
				      map: map,
				      title: 'Estou aqui!!'
				  });

}

function carregaMapaRecife() {    
  // CARREGA O MAPA EM RECIFE
  minhaLat = '-8.0475458';
  minhaLong = '-34.876962100000014';
  minhaLocalizacao = new google.maps.LatLng(minhaLat,minhaLong);
    var mapOptions = {
      center: minhaLocalizacao,
      zoom: 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    // CARREGA O ICONE INDICADOR
    map = new google.maps.Map(document.getElementById("mapa"), mapOptions); 

    directionsDisplay = new google.maps.DirectionsRenderer();
    directionsDisplay.setMap(map);   

    geocoder = new google.maps.Geocoder(); 
   
    meuMarcador = new google.maps.Marker({
              position: minhaLocalizacao,
              icon: originIcon,
              map: map,
              title: 'Estou aqui!!'
          });

}

function carregarMeuEnderecoDePartida(endereco) {
  	// LIMPANDO A TELA DE RESULTADO
  	$('#list-result').html('');
    geocoder.geocode({ 'address': endereco + ', Brasil', 'region': 'BR' }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
               $('#endPart').val(results[0].formatted_address);          
                minhaLocalizacao = new google.maps.LatLng(minhaLat, minhaLong);                         
                meuMarcador.setPosition(minhaLocalizacao);
                map.setCenter(minhaLocalizacao);
                map.setZoom(16);
            }
        }
    });
}

$(document).ready(function () {

    $("#endPart").blur(function() {
      if($(this).val() != "")
        carregarMeuEnderecoDePartida($(this).val());
    })

  
    $("#endPart").autocomplete({
        source: function (request, response) {
            geocoder.geocode({ 'address': request.term + ', Brasil', 'region': 'BR' }, function (results, status) {
                response($.map(results, function (item) {
                    return {
                        label: item.formatted_address,
                        value: item.formatted_address,
                        latitude: item.geometry.location.lat(),
                        longitude: item.geometry.location.lng()
                    }
                }));
            })
        },
        select: function (event, ui) {
            minhaLat = ui.item.latitude;
            minhaLong = ui.item.longitude;
            minhaLocalizacao = new google.maps.LatLng(minhaLat, minhaLong);
            meuMarcador.setPosition(minhaLocalizacao);
            map.setCenter(minhaLocalizacao);
            map.setZoom(16);
        }
    });
});

function calculateDistances(origin) {
  //initialize();
  // ISSO AQUI SERVE DEFINIR O TIPO DE DESLOCAMENTO DESEJADO / CARRO / BICICLETA / 
  var exibir    = '<div style="text-align: center;" class="item tipoRota" onclick="calculateDistancesTipo(\''+origin+'\',1)"><img class="ico-percurso" src="img/walking.png" onload="organizarCards()"  alt="a pé" title="a pé" /></div>';
      exibir   += '<div style="text-align: center;" class="item tipoRota" onclick="calculateDistancesTipo(\''+origin+'\',3)"><img class="ico-percurso" src="img/car.png" onload="organizarCards()" alt="de carro" title="de carro" /></div>';
     // exibir   += '<div style"text-align: center;" class="item caixa11" onclick="calculateDistancesTipo(\''+origin+'\',2)"><h5>DE BICICLETA</h5></div>';     
     $("#list-result").append(exibir);  
}

function calculateDistancesTipo(origin,tipo) {  

   $('.tipoRota').remove();   
   tipoLocomocao = tipo;
   //console.debug(destinos);  
   //alert(tipoLocomocao);
	 // CARREGA OS DESTINOS E ORIGENS PARA MAPEAR  
  var service = new google.maps.DistanceMatrixService();
  if(tipo == 1){

    service.getDistanceMatrix(
      {
        origins: [origin],
        destinations: destinos,
        travelMode: google.maps.TravelMode.WALKING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
      }, callback);

  }else if(tipo == 2){

    service.getDistanceMatrix(
      {
        origins: [origin],
        destinations: destinos,
        travelMode: google.maps.TravelMode.BICYCLING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
      }, callback);

  }else if(tipo == 3){

    service.getDistanceMatrix(
      {
        origins: [origin],
        destinations: destinos,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
      }, callback);

  }


}

function callback(response, status) {
  if (status != google.maps.DistanceMatrixStatus.OK) {
    alert('Error was: ' + status);
  } else {
    var origins = response.originAddresses;
    var destinations = response.destinationAddresses;	   
    deleteOverlays();
   // console.debug(destinations); 
    for (var i = 0; i < origins.length; i++) {
      var results = response.rows[i].elements;
      // ADICIONAND O MARCADOR DE ORIGEM
      addMarker(origins[i], false);
      for (var j = 0; j < results.length; j++) {
      	// ADICIONANDO O MARCADOR DE DESTINOS
        addMarker(destinations[j],titulos[idDestinos[j]-1],true,j+1);
        var rota = latitudes[idDestinos[j]-1]+','+longitudes[idDestinos[j]-1];
        // EXIBI OS RESULTADOS NA TELA
        var exibir  = '<div class="item caixa'+j+'" onclick="calcRoute(\''+rota+'\',\''+j+'\')">';
        	  exibir += '<h5>'+titulos[idDestinos[j]-1]+' - '+results[j].duration.text+'</h5>';
        	  destinations[j] = destinations[j].replace('República Federativa do Brasil', '');
            exibir += '<div class="desc">'+destinations[j]+' - Telefone: '+telefones[idDestinos[j]-1]+ '</div>';
            exibir += '<div class="acoes" style="display:none">'
            exibir += '<div class="instrucoes"><a href="instrucoes_rota.php" class="fancybox fancybox.ajax"><img class="ico-chat" src="img/map_route.svg" alt="comentario" title="Detalhe da Rota" /></a></div>';
            exibir += '<div class="coments"><a href="comentario.php?latitude='+latitudes[idDestinos[j]-1]+'&longitude='+longitudes[idDestinos[j]-1]+'" class="fancybox fancybox.ajax"><img class="ico-chat" src="img/chat.svg" alt="comentario" title="Comentario" /></a></div>';
            exibir += '</div>';
            exibir += '</div>';
        $('#list-result').append(exibir);	                
      }
      $(".desc").css('display','none');
      organizarCards();
    }
  }
}

function addMarker(location,titulo,isDestination,num) {	 
	  var icon;
	  var titulo;
	  if (isDestination) {
	    //icon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld='+num+'|006400|000';
      icon = 'img/icon-map.svg';
	    titulo = titulo;
	  } else {
	    icon = originIcon;
	    titulo = 'Estou aqui!';
	  }
	  
	  geocoder.geocode({'address': location}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      bounds.extend(results[0].geometry.location);
	      map.fitBounds(bounds);
	      var marker = new google.maps.Marker({
		        map: map,
		        position: results[0].geometry.location,
		        icon: icon,
		        title: titulo
		      });
	      markersArray.push(marker);
	    } else {
	      alert('Geocode was not successful for the following reason: '+ status);
	    }
	  });
}

function deleteOverlays() {
  for (var i = 0; i < markersArray.length; i++) {
    markersArray[i].setMap(null);
  }
  markersArray = [];
}


function carrega(chave,nome){

  meuMarcador.setMap(null);
  deleteOverlays();

  var data = {resource_id: chave,limit:100};	  
  $.ajax({
    url: 'http://dados.recife.pe.gov.br/api/action/datastore_search',
    data: data,
    dataType: 'jsonp',
    beforeSend : function() {
      $("#list-result").html("<div class='carregando'>CARREGANDO...</div>");
   },
   statusCode: {
      // identifica algum erro  e mostra como alerta ou dentro da div desejada                    
      404: function() {$("#list-result").html("Arquivo nao foi encontrado!");},
      500: function() {$("#list-result").html("Falha de processamento!");}
   },
    success: function(data) {

       // LIMPANDO A TELA DE RESULTADOS      
       $("#list-result").html("");

       // CRIA UM PARÂMETRO PARA SER ENVIADO VIA GET
       var arrayDistancias = "minhaLat="+minhaLat+"&";
       	   arrayDistancias += "minhaLong="+minhaLong+"&";
       	    console.debug(data.result);
        for (var i = 0; i < data.result.total; i++) {
        	// FIZ ISSO PQ O JSOM ESTA MENTINDO: O RESULTADO ESTA DIFERENTE DO TOTAL
        	if(data.result.records[i] != undefined){
	        	// console.debug(i+':'+data.result.records[i].unidade);
	        	 nomes[i] = data.result.records[i][nome];
	        	 arrayDistancias += "_id"+i+"="+data.result.records[i]._id+"&";
	        	 arrayDistancias += "latitude"+i+"="+data.result.records[i].latitude+"&";
	        	 arrayDistancias += "longitude"+i+"="+data.result.records[i].longitude+"&";
	        	 // ARMAZENANDO OS TITULOS
	        	 titulos[i] = data.result.records[i][nome];
	        	  // ARMAZENANDO OS TELEFONE OU FONE POIS VAI DEPENDER DA BASE DE DADOS POR ISTO ESTOU CONCATENANDO
	        	 telefones[i] = data.result.records[i].fone+' '+data.result.records[i].telefone;
	        	 // RETIRANDO O TEXTO UNDEFINED
	        	 telefones[i] = telefones[i].replace('undefined', '');
	        	 // ARMAZENANDO AS IDS
	        	 Idtiulos[i] = data.result.records[i]._id;
	        	 // ARMAZENANDO AS LATITUDES
	        	 latitudes[i] = data.result.records[i].latitude;
	        	 // ARMAZENANDO AS LONGITUDES
	        	 longitudes[i] = data.result.records[i].longitude;
        	}

        	 //destinos[i] = data.result.records[i].latitude+','+data.result.records[i].longitude; 
        };
        // RETIRA O ULTIMO CARACTER
        arrayDistancias = arrayDistancias.substring(0,(arrayDistancias.length - 1));
        // AQUI CHAMA A FUNÇÃO QUE FAZ TODA A MÁGICA
        // LEVA MEU PARAMETRO GET PARA PROCURAR OS 5 LOCALIZAÇÕES MAIS PROXIMAS
        buscarRaios(arrayDistancias);
         //console.debug(Idtiulos[0]);     
         //calculateDistances(minhaLocalizacao,destinos);
         //console.debug(minhaLocalizacao);	      
    }

  });
}

function buscarRaios(distancias){	    
  $.ajax({
    url: 'libs/calcularDistancia.php?'+distancias,	   
    type : "POST",
    beforeSend : function() {
      $("#list-result").html("<div class='carregando'>CALCULANDO TRAGETÓRIAS...</div>");
   },
   statusCode: {
      // identifica algum erro  e mostra como alerta ou dentro da div desejada                    
      404: function() {$("#list-result").html("Arquivo nao foi encontrado!");},
      500: function() {$("#list-result").html("Falha de processamento!");}
   },
    success: function(data) {
       $("#list-result").html("");
       resultRaios = data.split("/");
       // PEGANDO O ARRAY DE DESTINOS
       destinos = resultRaios[0].split(";");
       // PEGANDO OS ARRAYS DE IDS ORDENADAS POR PROXIMIDADES
       idDestinos = resultRaios[1].split(";");
       //console.debug(destinos);	      
       //$("#list-result").html(data);	       
       // APOS RECEBER MINHAS 5 MELHORES POSIÇÕES EU ENVIO PARA MAPS PARA SER MOSTARDO NA TELA
       calculateDistances(minhaLocalizacao);
       
    },
    complete:function(){
      organizarCards();
      //organizarCards();
    }

  });
}


function organizarCards(){
  var topo = $(window).height();
  $("#list-result .item").each(function(){
    var alturaCard = $(this).height();
    console.debug(alturaCard);
    topo = topo-(alturaCard+20);
    //Ajustar Posição do Topo
    //console.debug($(this).html());
    $(this).css("top", topo+"px");
  });
}

$(window).resize( function(){
  organizarCards();
});