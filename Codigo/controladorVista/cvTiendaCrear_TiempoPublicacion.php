<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

// Incluir obtener información del usuario
    include_once('../controlador/cPerfil.php');

//      Si el usuario ha creado tiendas anteriormente la opción gratuita sera desabilitada
//      Opción 0 = 7 días solo sera valido para la primera vez que se cree una tienda
//      Información del usuario
//          [8] = TIEMPO_PRUEBA
    $info_usuario = cPerfil::consultarPerfil($_SESSION['ID_USUARIO']);
    if( $info_usuario[8] == 1){
        $tiempoTienda = ['7','30','60','90','120'];
        $precio_tiempoTienda = ['0','2000','4000','6000','7500'];
    } else{
        $tiempoTienda = ['30','60','90','120'];
        $precio_tiempoTienda = ['2000','4000','6000','7500'];
    }

    