<?php
//------ INCLUIR MODULO PARA LA FUNCIÓN BORRAR PIN
    include_once('../controlador/cAutenticacion.php');

    function comprobarTiempo(){
//----- COMPROBACIÓN SESSION["tiempoActual"]
        cAutenticacion::comprobarTiempoClaveVerificacion($_SESSION["ID_USUARIO"], $_SESSION["tiempoActual"]);
    }