function ingresarParticipante(){
    idParticipante = document.getElementById("id_participante").value;
    
    if(idParticipante > 0){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                respuesta = JSON.parse(borrarSalidaConsola(this.responseText));
                if(respuesta == 0){
                    window.alert('No se ha encontrado a ese usuario en la lista de participantes pendientes por chequeo');
                }else if(respuesta == 1){
                    window.alert('Participante chequeado');
                }else if(respuesta == -1){//Por si acaso no hay nadie inscrito
                    window.alert('No falta nadie mas por chequear');

                }
            }
        };
        xmlhttp.open("GET","../controladorVista/cvIngresarIDPresentes.php?idParticipante="+idParticipante);
        xmlhttp.send();
    }
}



/**
 * Funcion que borra las salidas por consola, para poder usar ajax
 * @param   texto   texto de salida de una operacion
 * @param   texto   el mismo texto pero sin salidas por consola
 */
 function borrarSalidaConsola(texto){
     console.log(texto);
    inicioSalidaConsola = 1;
    while (inicioSalidaConsola != -1) {
        inicioSalidaConsola = (texto.indexOf("<script>"));
        if(inicioSalidaConsola != (-1)){
            finSalidaConsola = (texto.indexOf("</script>") + 9);//para que borre toda el termino y no solo el "<"
            //TODO: LO QUE QUITA LAS CADENAS DE TEXTO
            texto = texto.substring(0,inicioSalidaConsola) + texto.substring(finSalidaConsola);
        }
    }
    console.warn(texto);
    return texto;
}