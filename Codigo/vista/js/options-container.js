function optionsTypeSport(options_type_sport){
    disabled_optionsTypeSport(options_type_sport);
    // disabled_btn_option_sport();  //Desabilita la opacidad y la opción anteriormente seleccionada
    var options_type_sport = document.getElementById(options_type_sport);   //se almacena el div#options_type_ocio o div#options_type_deportivo en una variable

    options_type_sport.style.visibility = (options_type_sport.style.visibility == 'hidden') ? 'visible' : 'hidden';
    /* 
     Estilo de visibility: hidden para ocultar
     Estilo de visibility: visible para mostrar
     Tomando en cuenta si el usuario ha seleccionado el botón(div) mostrara u ocultara las opciones
     (Se debe tomar encuenta que el objeto sigue ahi solo que esta oculto ante la vista,
     por ende el espacio de dicho objeto permanece activo)
     */
}
window.onload = function(){
    disabled_optionsTypeSport();
    // Se llama a la función para que oculte las opciones de ocio y deportivo
}

function disabled_optionsTypeSport(options_type_sport=0){
    
    if(options_type_sport == 0){    //Oculta las opciones de ambos tipos de tienda
        document.getElementById('options_type_ocio').style.visibility = 'hidden';
        document.getElementById('options_type_deportivo').style.visibility = 'hidden';
    } else{             
        if(options_type_sport.search("ocio") != -1){    //Oculta las opciones del tipo de tienda deportivo
            document.getElementById('options_type_deportivo').style.visibility = 'hidden';
        } else{                     //Oculta las opciones del tipo de tienda ocio
            document.getElementById('options_type_ocio').style.visibility = 'hidden';
        }
    }
}

function btn_opacity(btn_opacity){ //almacena en btn_opacity el id del elemento que la este llamando
    if(btn_opacity.search("ocio") != -1){   //Si se pulsa el botón del tipo ocio la opacidad del deportivo sera del 100%
        document.getElementById('btn_container_type_deportivo').style.opacity = 1;
    } else if(btn_opacity.search("deportivo") != -1){                                 //Si se pulsa el botón del tipo deportivo la opacidad del ocio sera del 100%
        document.getElementById('btn_container_type_ocio').style.opacity = 1;
    }
    var btn_opacity = document.getElementById(btn_opacity);
    // disabled_btn_option_sport(btn_opacity);  //Desabilita la opacidad y la opción anteriormente seleccionada

    btn_opacity.style.opacity = (btn_opacity.style.opacity == '0.8') ? '1' : '0.8';
        // Tomando encuenta si la opacidad actual es de 1 pasara a ser 0.8 y viceversa
    
}

function disabled_btn_option_sport(btn_opacity=0){
        var option_sport = document.getElementsByClassName('option_sport');// Se obtienen todos los elementos con las clase (option_ocio) y los almacena en un Array
    var value_option_sport = document.getElementsByClassName('value_option_sport');// Se obtienen todos los elementos con las clase (value_option_ocio) y los almacena en un Array
    for(var i=0; i<option_sport.length; i++){    //Condicional para desabilidar las opciones una por una
        if(btn_opacity != option_sport[i]){
            option_sport[i].style.opacity = 1;
            value_option_sport[i].disabled = true;
        }
    }
}

function send_value_option(id_value_option){
    var id_value_option = document.getElementById(id_value_option);
    id_value_option.disabled = (id_value_option.disabled == true) ? false : true;
    /* 
     disabled = true : Desabilida el valor
     disabled = false : Habilita el valor
     Tomando en cuenta si el usuario ha seleccionado el botón(div) habilitara o desabilitara las opciones
     (Una vez desactivado, el valor que posea no sera tomado en cuenta en el envio de parametros)
     */
}