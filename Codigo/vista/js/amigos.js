//* VISTA
function listaAmigos(){
    document.getElementById("amigos").style.display = "block";
    document.getElementById("solicitudes").style.display = "none";
    document.getElementById("buscar").style.display = "none";
}
function listaSolicitudes(){
    document.getElementById("amigos").style.display = "none";
    document.getElementById("solicitudes").style.display = "block";
    document.getElementById("buscar").style.display = "none";
}
function busquedaAmigo(){
    document.getElementById("amigos").style.display = "none";
    document.getElementById("solicitudes").style.display = "none";
    document.getElementById("buscar").style.display = "block";
}

function mostrarOpciones(idAmigo){
    document.getElementById("opcionesAmigos").style.display = "block";
    document.getElementById("botonEventos").setAttribute('href',"./pListaEventosCreados.php?ID_AMIGO="+idAmigo);//link para la lista e eventos
    document.getElementById("botonChat").setAttribute('href',"./pChatAmigo.php?ID_AMIGO="+idAmigo);//link para la lista e eventos
    document.getElementById("botonFinalizar").setAttribute( 'onclick',"eliminarAmigo('"+idAmigo+"')");;//link eliminar un amigo
}
//*FIN VISTA-----

//*AJAX
function eliminarAmigo(idAmigo){
    var xmlhttp = new XMLHttpRequest();
    console.log(idAmigo);
    xmlhttp.onreadystatechange = function (){
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cajaAmigo"+idAmigo).style.display = "none";
            resultado = JSON.parse(borrarSalidaConsola(this.responseText));
            console.warn(resultado);
        }
    };
    xmlhttp.open("GET","../controladorVista/cvListaAmigos.php?finalizarAmistad="+idAmigo,true);
    xmlhttp.send();
}
function buscarUsuario(){
    id_usuario_buscar = document.getElementById("id_usuario_buscar").value

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            infoUsuarioBuscado = JSON.parse(borrarSalidaConsola(this.responseText));
            if(infoUsuarioBuscado[0] == -2){//-2 significa que la id buscada es igual a la id de usuario
                window.alert('Encerio intentas buscarte a ti mismo ???');
            }else if(infoUsuarioBuscado[0] != -1){//MOSTRAR LA INFO DEL USUARIO ENCONTRADO
                document.getElementById('nombre_amigo_buscado').textContent = infoUsuarioBuscado[1];
                document.getElementById('id_amigo_buscado').textContent = infoUsuarioBuscado[0];
                document.getElementById('foto_perfil_amigo_buscado').src = "./png/foto_perfil/"+infoUsuarioBuscado[2]+".png";

                document.getElementById("resultado_busqueda").style.display = "block";
            }else{//..SI NO SE ENCONTRÓ INFORMACIÓN
                document.getElementById("resultado_busqueda").style.display = "none";
            }
        }
    };
    xmlhttp.open("GET", "../controladorVista/cvBusquedaAmigos.php?id_usuario_buscar="+id_usuario_buscar,true);
    xmlhttp.send();

}
function enviarSolicitudAmistad(){
    idUsuarioEnviarSolicitud = document.getElementById('id_amigo_buscado').textContent
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            respuesta = JSON.parse(borrarSalidaConsola(this.responseText));
            switch (respuesta) {
                case 1:
                    window.alert('Solicitud de amista enviada correctamente.'); 
                break;
                case 0:
                    window.alert('Tienes una solicitud de amistad pendiente de aceptar con esta persona.'); 
                break;
                case -1:
                    window.alert('Tu y esta persona ya son amigos.'); 
                break;
                case -2:
                    window.alert('La otra persona te ha rechazado una solicitud de amisstad recientemente, pidele que te envie la solicitud a ti o espera un tiempo');
                break;
                case -3:
                    window.alert('No se como has llegado hasta aquí, pero porque intentas ser tu propio amigo?, esta todo bien en casa?');
                break;
            }
        }
    };
    xmlhttp.open("GET", "../controladorVista/cvBusquedaAmigos.php?idUsuarioEnviarSolicitud="+idUsuarioEnviarSolicitud,true);
    xmlhttp.send();
}
function aceptarSolicitudAmistad(idSolicitante){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            respuesta = JSON.parse(borrarSalidaConsola(this.responseText));
            if( respuesta == 1){
                window.alert("solicitud aceptada exitosamente!!");
            }else{
                window.alert("error al intentar aceptar la solicitud");
            }
            
            document.getElementById
            //respuesta
        }
    };
    xmlhttp.open("GET","../controladorVista/cvBusquedaAmigos.php?idSolicitanteAceptar="+idSolicitante,true);
    xmlhttp.send();
}
function denegarSolicitudAmistad(idSolicitante){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            respuesta = JSON.parse(borrarSalidaConsola(this.responseText));
            console.log("solicitud denegada"+respuesta);
            document.getElementById
            //respuesta
        }
    };
    xmlhttp.open("GET","../controladorVista/cvBusquedaAmigos.php?idSolicitanteDenegar="+idSolicitante,true);
    xmlhttp.send();
}
/**
 * Funcion que borra las salidas por consola, para poder usar ajax
 * @param   texto   texto de salida de una operacion
 * @param   texto   el mismo texto pero sin salidas por consola
 */
 function borrarSalidaConsola(texto){
    console.log(texto)
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

