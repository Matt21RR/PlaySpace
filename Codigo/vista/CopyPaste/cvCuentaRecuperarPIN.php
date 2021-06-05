<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

//----- CONEXIÓN al controlador de la BD Cuenta Recuperar y comprobaciones
    include_once('../controlador/cCuentaRecuperar.php');
    include_once('comprobaciones.php');

//----- RECIBIR PIN
    $PIN = $_POST["PIN"];

//----- ENVIAR OTRO PIN
    if(isset($_POST["enviarOtroPIN"])){
        cAutenticacion::crearClaveVerificacion($_SESSION["ID_USUARIO"]);
        header('Location: pCuentaRecuperarPIN.php');
//----- COMPROBAR PIN
    } else{
        if($PIN == ""){
            header('Location: pCuentaRecuperarPIN.php');
        } else if(cAutenticacion::verificarClaveVerificacion($_SESSION["ID_USUARIO"], $PIN)==1 && comprobarTiempo()==1){
            cAutenticacion::borrarClaveVerificacion($_SESSION["ID_USUARIO"]);
            header('Location: pCuentaRecuperarNewPass.php');       //----- PIN VALIDO - Proceder renovación de contraseña
        } else{
            header('Location: pCuentaRecuperarPIN.php');         //----- PIN INVALIDO - Recargar pantalla para validar PIN
        }
    }