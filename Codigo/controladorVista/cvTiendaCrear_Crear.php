<?php
// INICIAR SESIÓN
    session_start();
// Inclusión de crear Tienda y consultar perfil
    include_once('../controlador/cTiendaCrear.php');
// Creación Tienda
    $ID_TIENDA = cTiendaCrear::crearTienda($_SESSION['ID_USUARIO'], $_SESSION['INFO_TIENDA'][0], /*$ubicacionTienda,*/ 
                                $_SESSION['INFO_TIENDA'][4], '', $_SESSION['INFO_TIENDA'][2], 
                                $_SESSION['INFO_TIENDA'][3], $_SESSION['INFO_TIENDA'][1]);
// Crear Productos
    for($i=0; $i<count($_SESSION['infoProducto']); $i++){
        cTiendaCrear::crearProductos($ID_TIENDA,$_SESSION['infoProducto'][$i][0],$_SESSION['infoProducto'][$i][1],
                                    $_SESSION['infoProducto'][$i][2], $_SESSION['infoProducto'][$i][3]);
    }
    
// Comprobación de creación de la primera Tienda
    cTiendaCrear::primeraTienda($_SESSION['ID_USUARIO']);

// Establecer los tipos de actividades de la tienda
    for($i=0; $i<count($_SESSION['opcionesTipoActividad']); $i++){
        for($j=0; $j<count($_SESSION['opcionesTipoActividad'][$i]); $j++){
            cTiendaCrear::tipoProductosTienda($ID_TIENDA, $_SESSION['opcionesTipoActividad'][$i][$j]);
        }
    }    
    
    header('Location: ../vista/pTienda.php', false);