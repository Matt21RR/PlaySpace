<?php
    $seccion = $_GET['seccion'];

    switch ($seccion) {
        case '1'://Perfil
            header("location: ../vista/vPantallasPerfil/pInformacionPerfil.php");
            break;
        case '2'://Amigos
            header("location: ../vista/vPantallasAmigos/pListaAmigos.php");
            break;
        case '3'://Eventos
            header("location: ../vista/vPantallasEventos/pListaEventosInscritos.php");
            break;
        case '4'://Busqueda
            header("location: ../vista/vPantallasBusqueda/pMenuBusqueda.php");
            break;

        case '5'://Eventos Creados
            header("location: ../vista/vPantallasEventos/pListaEventosCreados.php");
            break;
        case '6'://Tiendas Creadas
            header("location: ../vista/vPantallasTiendas/pListaTiendasCreadas.php");
            break;
    }