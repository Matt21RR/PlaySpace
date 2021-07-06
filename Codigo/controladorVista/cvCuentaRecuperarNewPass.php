<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    if(!isset($_SESSION)){
        session_start();
    }

//----- CONEXIÓN al controlador de la BD Cuenta Recuperar
    include_once('../controlador/cCuentaRecuperar.php');
// -- ALERTAS
    $alertas = [
        'Contraseña inválida'
    ];
//----- VALIDAR Y SUBIR NUEVA CONTRASEÑA
    if(cCuentaRecuperar::introducirContraseñaNueva($_SESSION["ID_USUARIO"], $_POST["NEW_CONTRASENA"])==-1){
        $_SESSION['ALERTA'] = $alertas[0];        // ALERTA - contraseña incorrecta
        header('Location: ../vista/pCuentaRecuperarNewPass.php', false);    //----- CONTRASEÑA NO ACTUALIZADA - Recargar Ingresar NewPass
    } else{
        session_destroy();      // ---- ELIMINAR LA INFORMACIÓN DE LA SESSION CREADA
        session_start();        // ---- INICIAR UNA NUEVA SESIÓN
        $_SESSION['ALERTA'] = 'Contraseña actualizada';
        header('Location: ../vista/pIniciarSesion.php', false);     //----- CONTRASEÑA ACTUALIZADA - Cargar Iniciar Sesión
    }