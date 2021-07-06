<?php
    $seccion = $_GET['seccion'];
    if(!isset($_SESSION))session_start();
    switch ($seccion) {
        case '-1'://cerrar sesion
            session_unset();
            session_register_shutdown();
            header("location: ../vista");
            break;
        case '1'://Perfil
            header("location: ../vista/pPerfil.php");
            break;
        case '2'://Amigos
            header("location: ../vista/pListaAmigos.php");
            break;
        case '3'://Eventos
            header("location: ../vista/pListaEventosInscritos.php");
            break;
        case '4'://Busqueda
            header("location: ../vista/pBusqueda.php");
            break;

        case '5'://Eventos Creados
            header("location: ../vista/pListaEventosCreados.php");
            break;
        case '6'://Tiendas Creadas
            header("location: ../vista/pTienda.php");
            break;
    }