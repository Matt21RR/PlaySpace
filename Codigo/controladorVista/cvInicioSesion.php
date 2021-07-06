<?php
    include_once ("../controlador/cInicioSesion.php");
    include_once ("../controlador/cPerfil.php");

    if(!isset($_SESSION))session_start();
    // ? HACER ESTO PRIMERO
    if(isset($_REQUEST['zonaHoraria'])){
        include_once("../mMaster.php");
        //$_SESSION['ERROR']=11;
        mMaster::configurarZonaHoraria($_REQUEST['zonaHoraria']);
        die;
    }

    $nick = $_GET['nombre_usuario'];
    $pass = $_GET['contrasena'];
    $crearCuenta = $_GET['create'];
    
    if($crearCuenta == 1){
        header("location: ../vista/pCuentaCrear.php");
        $_SESSION['err'] = 400;
        die;
    }
    
    $_SESSION['ID_USUARIO'] = cInicioSesion::buscarCuenta($nick,$pass);
    //SI LA ID_USUARIO ES MAYOR A 0
    if($_SESSION['ID_USUARIO'] > 0){
        $info_usuario = cPerfil::consultarPerfil($_SESSION['ID_USUARIO']);
        $_SESSION['NOMBRE_USUARIO'] = $info_usuario[0];
        $_SESSION['ID_FOTO_PERFIL'] = $info_usuario[7];
        $_SESSION['CONTRASENA'] = $pass;//* IMPORTANTE PARA LA DESENCRIPTACIÓN
        header("location: ../vista/pPlantilla.php");
        $_SESSION['err'] = 500;
        die;
    }else{
        header("location: ../vista/pInicioSesion.php");
        $_SESSION['err'] = 600;
        die;
    }