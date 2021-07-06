<?php
//------ SESSION_START (¡¡NO MOVER!!)
    if(!isset($_SESSION)){
        session_start();
    }
/**
 * Comprueba que el usuario no se haya saltado unos pasos al iniciar sesión
 */
    function comprobarSesiones(){
//----- COMPROBACIÓN SESSION["ID_USUARIO"]
        if(!isset($_SESSION["ID_USUARIO"])){
            header('Location: pIniciarSesion.php', false);
            exit;
        }
    }
//------ INCLUIR MODULO PARA LA FUNCIÓN BORRAR PIN
    include_once('../controlador/cAutenticacion.php');  //Por si las moscas
    /**
     * Comprueba la margen de tiempo que posee el PIN antes de ser invalido
     * @param   entero  ID_USUARIO
     */
    function comprobarTiempo($ID_USUARIO){
        if(cAutenticacion::comprobarTiempoClaveVerificacion($ID_USUARIO) == -1){
            cAutenticacion::eliminarClaveVerificacion($ID_USUARIO); // Elimina la clave de verificacion si ha superado el tiempo maximo
            $_SESSION['TIEMPO_LIMITE'] = -1;
        }
    }