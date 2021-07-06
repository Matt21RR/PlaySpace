<?php
    include_once("../controlador/cBusqueda.php");
    include_once("../mMaster.php");

    if(!isset($_SESSION))session_start();
    
    if(isset($_GET['ID_EVENTO'])){//Para mostrar la informacion del evento
        $_SESSION['ID_EVENTO'] = $_GET['ID_EVENTO'];
        header("location: ../vista/pInformacionEvento.php");
    }

    if(isset($_GET['ID_TIENDA'])){//Para mostrar la información de la tienda
        $_SESSION['ID_TIENDA'] = $_GET['ID_TIENDA'];
        header("location: cvTienda_VerEditar.php");
    }

    // *PARA AJAX
    //TODO: Para conexiones lentas revisar si las coordenadas no estan vacias
    if(isset($_REQUEST['latitud']) && isset($_REQUEST['longitud'])){
        if (($_REQUEST['latitud'] != "") && ($_REQUEST['longitud'] != "")) {
            $latitud = $_REQUEST['latitud'];
            $longitud = $_REQUEST['longitud'];
            echo json_encode(cBusqueda::realizarBusqueda($latitud,$longitud));
        }
    }
    if(isset($_REQUEST['tipoEvento'])){//para consultar el nombre del tipo de evento
        include_once("../vista/lists/actividades.php");
        $tipoEvento = $_REQUEST['tipoEvento'];
        //en el caso de los eventos, pedir el nombre del tipo de evento
        if (($tipoEvento-200) > 0) {
            //buscar dentro de los masivos
            $nomTipoEvento = $masivos[$tipoEvento-201];
        }elseif(($tipoEvento-100) > 0){
            $nomTipoEvento = $ocio[$tipoEvento-101];
        }else{
            $nomTipoEvento = $deportes[$tipoEvento-1];
        }
        echo json_encode($nomTipoEvento);
        
    }
    