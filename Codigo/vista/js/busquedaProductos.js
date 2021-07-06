//============JAVASCRIPT=============
function buscarProductos(){
    var xmlhttp = new XMLHttpRequest();//si o si toca ponerlo
    xmlhttp.onreadystatechange = function() {//si o si toca ponerlo
        if (this.readyState == 4 && this.status == 200) {//lo pone si necesita pedir informacion com php
            respuesta = JSON.parse(borrarSalidaConsola(this.responseText));//aqui almacena la respuesta a la peticion
            document.getElementById("misMensajes").textContent = respuesta;//esto le vale pito a usted
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
//==============PHP==================
// if(isset($_REQUEST['pedirMensajes'])){//Apesar de que se envia como GET, el valor enviado por AJAX se debe de obtener usando $_REQUEST
//         $id_usuario= $_SESSION['ID_USUARIO'];//LE VALE PITO
//         $id_amigo= $_SESSION['ID_AMIGO'];//LE VALE PITO
//         $id_chat = cAmigos::solicitarInfoAmigo($id_usuario,$id_amigo)[0];//LE VALE PITO
//         $contrasenaUsr = $_SESSION['CONTRASENA'];//Contrasena del usuario en claro para poder desencriptar la clave de encriptado //LE VALE PITO
//         //*IMPORTANTE
//         //*PARA ENVIAR EL RESULTADO DE LA PETICION HECHA CON AJAX SE DEBE DE IMPRIMIR EL VALOR ENVIADO
//         //*COMO echo json_encode("el resultado de lo que sea que usted quiera hacer");
//         // ! EXCEPTUANDO LOS CONSOLE.LOG, NADA MAS DEBE DE SER IMPRESO SINO GENERARÁ ERROR
//         echo json_encode(cAmigosChat::recibirMensajes($id_chat,$id_usuario,$contrasenaUsr));
        
//     }