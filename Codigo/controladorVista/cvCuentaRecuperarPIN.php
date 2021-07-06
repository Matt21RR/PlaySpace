<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

//----- CONEXIÓN al controlador de la BD Cuenta Recuperar y comprobaciones
    include_once('../controlador/cCuentaRecuperar.php');
    include_once('../vista/comprobaciones.php');
//----- RECIBIR PIN
    $PIN = $_POST["PIN"];
// ---- ALERTAS
    $alertas = [
            'Ingresa el PIN enviado a tu correo',
            'PIN incorrecto',
            'PIN creado exitosamente'
        ];
//----- ENVIAR OTRO PIN
    if(isset($_POST["enviarOtroPIN"])){
        cAutenticacion::crearClaveVerificacion($_SESSION["ID_USUARIO"]);
        $_SESSION['fecha_maxima'] = null;
        $_SESSION['ALERTA'] = $alertas[2];     // -- Mensaje de alerta -- PIN ENVIADO
        header('Location: ../vista/pCuentaRecuperarPIN.php');
//----- COMPROBAR PIN
    } else{
        if($PIN == ""){         //----- PIN VACIO - Recargar pantalla para validar PIN
            $_SESSION['ALERTA'] = $alertas[0];     // -- Mensaje de alerta cuando se oprima el boton de continuar sin ingresar datos
            header('Location: ../vista/pCuentaRecuperarPIN.php', false);
        } else if(strlen($PIN) != 8){
            $_SESSION['ALERTA'] = $alertas[1];     // -- Mensaje de alerta cuando el pin ingresado sea incorrecto
            header('Location: ../vista/pCuentaRecuperarPIN.php', false);         //----- TAMAÑO PIN INVALIDO - Recargar pantalla para validar PIN
        } else if(cAutenticacion::verificarClaveVerificacion($_SESSION["ID_USUARIO"], $PIN)==1){
            cAutenticacion::eliminarClaveVerificacion($_SESSION["ID_USUARIO"]);
            header('Location: ../vista/pCuentaRecuperarNewPass.php', false);       //----- PIN VALIDO - Proceder renovación de contraseña
        } else{
            $_SESSION['ALERTA'] = $alertas[1];     // -- Mensaje de alerta cuando el pin ingresado sea incorrecto
            header('Location: ../vista/pCuentaRecuperarPIN.php', false);         //----- PIN INVALIDO - Recargar pantalla para validar PIN
        }
    }