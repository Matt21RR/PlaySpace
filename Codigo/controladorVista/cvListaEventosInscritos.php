<?php
    if(!isset($_SESSION))session_start();
    $id_evento = $_GET['ID_EVENTO'];//id del evento a consultar

    if(is_numeric($id_evento)){
        $_SESSION['ID_EVENTO'] = $id_evento;
        header("location: ../vista/pInformacionEvento.php");
    }