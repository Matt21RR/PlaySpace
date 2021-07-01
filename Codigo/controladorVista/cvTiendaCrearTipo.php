<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();
// Recargar la página (pTiendaCrearTipo) si su opción es cancelar
    if(isset($_POST['cancelar'])) header('Location: ../Vista/pTiendaCrearTipo.php');
// LLamado de las listas de las actividades
    include_once('../vista/lists/actividades.php');
// Eliminar la información alamcenada anteriormente
    if(isset($_SESSION['opcionesTipoActividad'])){
        $_SESSION['opcionesTipoActividad'] = null;
    }
// Receptor de las actividades tipo Deportivo / Ocio
    for($i=0; $i<count($actividades); $i++){
    // Almacenar las actividades seleccionadas
        for($j=0; $j<count($actividades[$i]); $j++){
            if(isset($_POST["option_sport_".$sport_sinEspacio[$i][$j]])){
                $_SESSION['opcionesTipoActividad'][$i][$j] = $_POST["option_sport_".$sport_sinEspacio[$i][$j]];
            }
        }
    // Ordenar las actividades
        if(isset($_SESSION['opcionesTipoActividad'])){
            if(isset($_SESSION['opcionesTipoActividad'][$i])){
                sort($_SESSION['opcionesTipoActividad'][$i], 1);
            }
            sort($_SESSION['opcionesTipoActividad'], 1);
        }
    }
// Redirecciona la pagina
    if(!isset($_SESSION['opcionesTipoActividad'])){
        header("Location: ../vista/pTiendaCrearTipo.php");
    } else{
        header("Location: ../Vista/pTiendaCrearUbicacion.php");
    }

    
