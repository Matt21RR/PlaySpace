<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

//----- CONEXIÓN al controlador de la BD Cuenta Recuperar
    include_once('../controlador/cCuentaRecuperar.php');

//----- VALIDAR Y SUBIR NUEVA CONTRASEÑA
    if(cCuentaRecuperar::introducirContraseñaNueva($_SESSION["ID_USUARIO"], $_POST["NEW_CONTRASENA"])==-1){
        header('Location: pCuentaRecuperarNewPass.php');    //----- CONTRASEÑA NO ACTUALIZADA - Recargar Ingresar NewPass
    } else{
        session_destroy();      //----- CANCELAR LA SESSION CREADA
        header('Location: pIniciarSesion.php');     //----- CONTRASEÑA ACTUALIZADA - Cargar Iniciar Sesión
    }