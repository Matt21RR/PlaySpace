<?php
    include_once ("../controlador/cInicioSesion.php");
    $nick = $_GET['nombre_usuario'];
    $pass = $_GET['contrasena'];
    if(!isset($_SESSION))session_start();
    $_SESSION['id_usuario'] = cInicioSesion::buscarCuenta($nick,$pass);
    //SI LA ID_USUARIO ES DIFERENTE DE -1 Y DE 0
    if(($_SESSION['id_usuario'] != -1) && $_SESSION['id_usuario']){
        header("location: ../vista/pPlantilla.php");
    }else{
        header("location: ../vista/pInicioSesion.php");
    }