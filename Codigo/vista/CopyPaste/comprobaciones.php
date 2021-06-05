<?php
//------ SESSION_START (¡¡NO MOVER!!)
    session_start();
/**
 * Comprueba que el usuario no se haya saltado unos pasos al iniciar sesión
 */
    function comprobarSesiones(){
//----- COMPROBACIÓN SESSION["ID_USUARIO"]
        if(!isset($_SESSION["ID_USUARIO"])){
            header('Location: pIniciarSesion.php');
        }
    }
//------ INCLUIR MODULO PARA LA FUNCIÓN BORRAR PIN
include_once('../controlador/cAutenticacion.php');  //Por si las moscas
/**
 * Comprueba la margen de tiempo que posee el PIN antes de ser invalido
 * @return  entero    1 = Margen de tiempo no superada
 *                   -1 = Margen de tiempo superada
 */
function comprobarTiempo(){
//----- COMPROBACIÓN SESSION["tiempoActual"]
    return cAutenticacion::comprobarTiempoClaveVerificacion($_SESSION["ID_USUARIO"], tiempo()); 
}