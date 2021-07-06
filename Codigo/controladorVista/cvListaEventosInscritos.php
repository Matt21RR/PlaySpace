<?php
    if(!isset($_SESSION))session_start();

    if(isset($_GET['ID_EVENTO'])){
        $id_evento = $_GET['ID_EVENTO'];//id del evento a consultar

        if(is_numeric($id_evento)){
            $_SESSION['ID_EVENTO'] = $id_evento;
            header("location: ../vista/pInformacionEvento.php");
        }
    }

    if(isset($_GET['CREAR_EVENTO'])){
        //Variables necesarias para crear evento
        $_SESSION['data'] = 0;
        $_SESSION['ajuste'] = 0;
        
        header("location: ../controladorVista/cvEventoCrear.php?info=1");
    }
    