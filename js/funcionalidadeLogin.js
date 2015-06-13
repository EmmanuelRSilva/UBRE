
function carregaLogin(pagina,formulario,div){

  
  $.ajax({
       url:pagina,
       cache : false,
       type : "POST", 
       data : $(formulario).serialize(),
       beforeSend : function() {
          //  faz a animação                    
            $(div).html("<div class='carregando'><img src='img/carregando.gif' /></di>");
       },
       statusCode: {
          // identifica algum erro  e mostra como alerta ou dentro da div desejada                    
        404: function() { $(div).html("Arquivo nao foi encontrado!"); },
        500: function() { $(div).html("Falha de processamento!"); }
       },
       error : function(retorno) {
               //alert("erro:"+retorno);
       },
       success : function(retorno) { 
            // estando tudo ok mostra o resultado na div desejada              
            $(div).html(retorno);
       }
  });
}