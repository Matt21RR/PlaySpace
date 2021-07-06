<?php
    include_once("../controlador/cAmigosChat.php");
    include_once("../controlador/cAmigos.php");

    if(!isset($_SESSION))session_start();

    if(isset($_REQUEST['mensaje'])){
        $id_usuario= $_SESSION['ID_USUARIO'];
        $id_amigo= $_SESSION['ID_AMIGO'];
        $id_chat = cAmigos::solicitarInfoAmigo($id_usuario,$id_amigo)[0];
        $mensaje = $_REQUEST['mensaje'];
        $contrasenaUsr = $_SESSION['CONTRASENA'];//Contrasena del usuario en claro para poder desencriptar la clave de encriptado
        //cAmigosChat::enviarMensaje($id_chat,$mensaje,$id_usuario,$contrasenaUsr);
        echo json_encode(cAmigosChat::enviarMensaje($id_chat,$mensaje,$id_usuario,$contrasenaUsr));
    }
    if(isset($_REQUEST['pedirMensajes'])){//Apesar de que se envia como GET, el valor enviado por AJAX se debe de obtener usando $_REQUEST
        $id_usuario= $_SESSION['ID_USUARIO'];//LE VALE PITO
        $id_amigo= $_SESSION['ID_AMIGO'];//LE VALE PITO
        $id_chat = cAmigos::solicitarInfoAmigo($id_usuario,$id_amigo)[0];//LE VALE PITO
        $contrasenaUsr = $_SESSION['CONTRASENA'];//Contrasena del usuario en claro para poder desencriptar la clave de encriptado //LE VALE PITO
        //*IMPORTANTE
        //*PARA ENVIAR EL RESULTADO DE LA PETICION HECHA CON AJAX SE DEBE DE IMPRIMIR EL VALOR ENVIADO
        //*COMO echo json_encode("el resultado de lo que sea que usted quiera hacer");
        // ! EXCEPTUANDO LOS CONSOLE.LOG, NADA MAS DEBE DE SER IMPRESO SINO GENERARÁ ERROR
        echo json_encode(cAmigosChat::recibirMensajes($id_chat,$id_usuario,$contrasenaUsr));
        
    }