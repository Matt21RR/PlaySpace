<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();
    
// Recargar la página (pTiendaCrearTipo) si su opción es cancelar
    if(isset($_POST['cancelar'])) header('Location: ../Vista/pTiendaCrearTipo.php');

    $value_deportesTipoDeportivo = ["Futbol", "Voleibol", "Baloncesto"];
    for($i=0; $i<count($value_deportesTipoDeportivo); $i++){
        if(isset($_POST["option_sport_".$value_deportesTipoDeportivo[$i]])) {
            $_SESSION['opcionesTipoDeportivo'][$i] = $_POST["option_sport_".$value_deportesTipoDeportivo[$i]];
        }
    };  //Almacena en $_SESSION['opcionesTipoDeportivo'] el nombre de los tipos deportivos seleccionados

    $value_deportesTipoOcio = ["Ajedrez", "Parquez", "Damas_Chinas"];
    for($i=0; $i<count($value_deportesTipoOcio); $i++){
        if(isset($_POST["option_sport_".$value_deportesTipoOcio[$i]])) {
            $_SESSION['opcionesTipoOcio'][$i] = $_POST["option_sport_".$value_deportesTipoOcio[$i]];
        }
    };  //Almacena en $_SESSION['opcionesTipoOcio'] el nombre de los tipos ocio seleccionados

// Cargar la selección de ubicación
    header("Location: ../Vista/pTiendaCrearUbicacion.php");
