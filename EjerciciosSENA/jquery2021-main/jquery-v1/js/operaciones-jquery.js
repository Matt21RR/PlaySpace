
window.onload = function()
{
    console.log( "Hola" );
    comunicar();
}

function comunicar()
{
	//jQuery("#calc").click( function() //Apertura jquery
    //{        
        //cogemos el valor del input
        //var num = jQuery("#numero").val();
        var num = 3;
    
        //creamos array de parámetros que mandaremos por POST
        var params = {
            "numFactorial" : num
        };
    
        //llamada al fichero PHP con AJAX
        $.ajax
        ({
            data:       params,
            url:        'c_jquery_response.php',
            dataType:   'html',
            type:       'post',
            beforeSend: function()
            {
                console.log( "Enviando........" );
                //mostramos gif "cargando"
                //jQuery('#loading_spinner').show();
                //antes de enviar la petición al fichero PHP, mostramos mensaje
                //jQuery("#resultado").html("Déjame pensar un poco...");
            },
            success: function( response )
            {
                //escondemos gif
                //jQuery('#loading_spinner').hide();
                //mostramos salida del PHP
                //jQuery("#resultado").html(response);
                
                console.log( response );
            }
        });
    //}); //Cierre jquery
}