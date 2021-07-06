<?php
    session_start();        // Inicio de sesiones

    $arrayNoCozco = ['zonaHoraria', 'NOMBRE_USUARIO', 'ID_FOTO_PERFIL'];
    for($i=0; $i<count($arrayNoCozco); $i++){
        if(!isset($_SESSION[$arrayNoCozco[$i]])){
            $_SESSION[$arrayNoCozco[$i]] = 0;
        }
    }

    $ID_USUARIO = $_SESSION['ID_USUARIO'];  // Almacenar la ID del usuario
    $CONTRASENA = $_SESSION['CONTRASENA'];  // Almacenar Contraseña del usuario
    $zonaHoraria = $_SESSION['zonaHoraria'];     //Almacena la zona horaria del usuario
    $monedaLocal = "COP";    //Almacenar info Local
    $NOMBRE_USUARIO = $_SESSION['NOMBRE_USUARIO'];
    $ID_FOTO_PERFIL = $_SESSION['ID_FOTO_PERFIL'];

    session_unset();    // Eliminar todas las sessiones

    $_SESSION['ID_USUARIO'] = $ID_USUARIO;  // Establecer nuevamente la sesión ID_USUARIO
    $_SESSION['CONTRASENA'] = $CONTRASENA;  // Establecer nuevamente la sesión CONTRASENA
    $_SESSION['monedaLocal'] = $monedaLocal;    // Almacenar info Local
    $_SESSION['zonaHoraria'] = $zonaHoraria;    // Zona Horaria
    $_SESSION['NOMBRE_USUARIO'] = $NOMBRE_USUARIO;
    $_SESSION['ID_FOTO_PERFIL'] = $ID_FOTO_PERFIL;