<?php
    include_once("../controlador/cEventoInicio.php");

    
    if(!isset($_SESSION))session_start();
    $ID_EVENTO =  $_SESSION['ID_EVENTO'];

    if(isset($_REQUEST['idParticipante'])){
        $idParticipante = $_REQUEST['idParticipante'];
        echo json_encode(cEventoInicio::pedirListaPresentes($ID_EVENTO,$idParticipante));
    }