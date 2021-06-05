<?php
//------ SESSION_START (¡¡NO MOVER!!)
    session_start();
//----- COMPROBACIÓN SESSION["ID_USUARIO"]
    if(!isset($_SESSION["ID_USUARIO"])){
        header('Location: pIniciarSesion.php');
    }