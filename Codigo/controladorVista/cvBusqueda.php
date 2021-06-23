<?php
    include_once("../controlador/cBusqueda.php");
    include_once("../mMaster.php");
    $latitud = $_REQUEST['latitud'];
    $longitud = $_REQUEST['longitud'];
    //TODO: Para conexiones lentas revisar si las coordenadas no estan vacias
    if (($latitud != "") && ($longitud != "")) {
        echo json_encode(cBusqueda::realizarBusqueda($latitud,$longitud));
    }
    