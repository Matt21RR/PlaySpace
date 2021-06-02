<?php
    include_once('../controlador/cTiendaCrear.php');
    include_once('m-Perfil.php');

//-- CREAR TIENDA ESCRIBIR NOMBRE -------
    /*      
    $NOMBRE_USUARIO = $_POST["NOMBRE_USUARIO"];
    $ID_USUARIO = pedirIDUsuario($NOMBRE_USUARIO);
    */
//-- CREAR TIENDA SELECCIONAR NOMBRE ----
    $ID_USUARIO = $_POST["ID_USUARIO"];
//-- CUERPO CREAR TIENDA ----------------
    $nombreTienda = $_POST["nombreTienda"];
    $descripcionTienda = $_POST["descripcionTienda"];
    $direccionTienda = $_POST["direccionTienda"];
    $contactoTienda = $_POST["contactoTienda"];
    $correoTienda = $_POST["correoTienda"];
    $tiempoCompra = $_POST["tiempoCompra"];

    cTiendaCrear::crearTienda($ID_USUARIO, $nombreTienda, $descripcionTienda, 
                                $direccionTienda, $contactoTienda, $correoTienda, 
                                $tiempoCompra);