<?php
    session_start();        // Inicio de sesiones
    $ID_USUARIO = $_SESSION['ID_USUARIO'];  // Almacenar la ID del usuario
    // $CONTRASENA = $_SESSION['CONTRASENA'];  // Almacenar Contraseña del usuario
    // $zonaHoraria = $_SESSION['zonaHoraria'];     //Almacena la zona horaria del usuario
    $monedaLocal = $_SESSION['monedaLocal'];    //Almacenar info Local

    session_unset();    // Eliminar todas las sessiones

    $_SESSION['ID_USUARIO'] = $ID_USUARIO;  // Establecer nuevamente la sesión ID_USUARIO
    // $_SESSION['CONTRASENA'] = $CONTRASENA;  // Establecer nuevamente la sesión CONTRASENA
    $_SESSION['monedaLocal'] = $monedaLocal;    // Almacenar info Local
    // $_SESSION['zonaHoraria'] = $zonaHoraria;    // Zona Horaria