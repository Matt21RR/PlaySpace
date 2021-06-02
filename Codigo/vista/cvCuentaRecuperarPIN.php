<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

//----- CONEXIÓN al controlador de la BD Cuenta Recuperar
    include_once('../controlador/cCuentaRecuperar.php');

//----- RECIBIR PIN
    $PIN = $_POST["PIN"];

//----- ENVIAR OTRO PIN
    if(isset($_POST["enviarOtroPIN"])){
        cAutenticacion::crearClaveVerificacion($_SESSION["ID_USUARIO"]);
        header('Location: pCUentaRecuperarPIN.php');
//----- COMPROBAR PIN
    } else{
        if($PIN == "") header('Location: pCuentaRecuperarPIN.php');
        if(cAutenticacion::verificarClaveVerificacion($_SESSION["ID_USUARIO"], $PIN)==1){
            header('Location: pCuentaRecuperarNewPass.php');       //----- PIN VALIDO - Proceder renovación de contraseña
        } else{
            header('Location: pCuentaRecuperarPIN.php');         //----- PIN INVALIDO - Recargar pantalla para validar PIN
        }
    }