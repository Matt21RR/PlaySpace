function enviarMensaje(){
    mensajeEnviar = document.getElementById("mensajeUsuario").value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            respuesta = JSON.parse(borrarSalidaConsola(this.responseText));

            switch (respuesta) {
                case 1:
                    window.alert("mensaje enviado correctamente");
                    break;
                case 0:
                    window.alert("Error de conexión");
                    break;
                case -1:
                    window.alert("No se pueden enviar palabras malsonantes o con caracteres no permitidos");
                    break;
            }
        }
    };
    xmlhttp.open("GET", "../controladorVista/cvChatAmigo.php?mensaje="+mensajeEnviar,true);
    xmlhttp.send();
}
window.onload = recibirMensajes();//* PARA PEDIR LOS MENSAJES APENAS SE CARGUE LA PAGINA;
setTimeout(recibirMensajes,30000);//*refrescar los mensajes cada 15 seg

function recibirMensajes(){
    var xmlhttp = new XMLHttpRequest();//si o si toca ponerlo
    xmlhttp.onreadystatechange = function() {//si o si toca ponerlo
        if (this.readyState == 4 && this.status == 200) {//lo pone si necesita pedir informacion com php
            respuesta = JSON.parse(borrarSalidaConsola(this.responseText));//aqui almacena la respuesta a la peticion
            var listaMensajes = [0];
            for (let mensaje = 0; mensaje < respuesta.length; mensaje++) {
                listaMensajes[mensaje] = respuesta[mensaje][1];//para dejar solo los mensajes
            }
            document.getElementById("misMensajes").textContent = listaMensajes;//esto le vale pito a usted
        }
    };
    xmlhttp.open("GET", "../controladorVista/cvChatAmigo.php?pedirMensajes="+1,true);//el cuerpo de la peticion, siempre va get de primero
    //no olvidar el true al final
    xmlhttp.send();//si o si toca ponerlo
}


/**
 * Funcion que borra las salidas por consola, para poder usar ajax
 * @param   texto   texto de salida de una operacion
 * @param   texto   el mismo texto pero sin salidas por consola
 */
 function borrarSalidaConsola(texto){
    inicioSalidaConsola = 1;
    while (inicioSalidaConsola != -1) {
        inicioSalidaConsola = (texto.indexOf("<script>"));
        if(inicioSalidaConsola != (-1)){
            finSalidaConsola = (texto.indexOf("</script>") + 9);//para que borre toda el termino y no solo el "<"
            //TODO: LO QUE QUITA LAS CADENAS DE TEXTO
            texto = texto.substring(0,inicioSalidaConsola) + texto.substring(finSalidaConsola);
       }
   }
   return texto;
}