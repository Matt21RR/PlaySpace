<?php
    include_once ("../controlador/cCuentaCrear.php");

    $nombre_usuario = $_GET['nombre_usuario'];
    $contrasena = $_GET['contrasena'];
    $correo = $_GET['correo'];

    if(!isset($_SESSION))session_start();
    $id_foto_perfil = $_SESSION['id_foto_perfil'];
    
    $id_usuario = cCuentaCrear::crearCuenta($nombre_usuario,$contrasena,$correo,$id_foto_perfil);
    //SI SE PUDO CREAR LA CUENTA
    if($id_usuario != -1){
        $_SESSION['ID_USUARIO'] = $id_usuario;
        $_SESSION['NOMBRE_USUARIO'] = $nombre_usuario;
        $_SESSION['ID_FOTO_PERFIL'] = $id_foto_perfil;
        header("location: ../vista/pPlantilla.php");
    }else{//SI NO SE PUDO CREAR LA CUENTA
        header("location: ../vista/pCuentaCrear.php");
    }