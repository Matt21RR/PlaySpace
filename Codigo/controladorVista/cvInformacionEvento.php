<?php
    if (isset($_GET['accion'])) {
        $lat = $_GET['lat'];
        $lon = $_GET['lon'];
        $title = $_GET['title'];
        $posiciones[0]=array($_GET[ 'lat' ],$_GET[ 'lon' ],$_GET[ 'title' ]);
        $text = "array=".json_encode($posiciones);
        header("location: ../vista/pUbicacionInfoEvento.php?text=".$text);
    }if (isset($_GET['inscrito'])){
        $inscrito = $_GET['inscrito'];
        include_once ("../controlador/cEventos.php");
        if(!isset($_SESSION))session_start();
        if ($inscrito == 0){
            cEventos::inscribirseEnEvento($_SESSION['ID_EVENTO'],$_SESSION['ID_USUARIO']);
        }elseif($inscrito == 1){
            cEventos::desinscribirseEnEvento($_SESSION['ID_EVENTO'],$_SESSION['ID_USUARIO']);
        }
        header("location: ../vista/pInformacionEvento.php");
    }