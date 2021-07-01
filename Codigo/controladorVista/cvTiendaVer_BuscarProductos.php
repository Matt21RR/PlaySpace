<?php
    if(!isset($_SESSION)){
        session_start();
    }
// Inclusión de cTiendas
    include_once('../controlador/cTiendas.php');
    // Obtención del caracter a buscar y Busqueda del caracter segun la tienda
    // [][0] = NOMBRE_PRODUCTO 
    // [][1] = PRECIO_PRODUCTO 
    // [][2] = URL_IMG_PRODUCTO 
    // [][3] = ID_PRODUCTO
    if(isset($_POST['busquedaProducto'])){
        $_SESSION['INFO_PRODUCTOS'] = cTiendas::busquedaProductos($_SESSION['INFO_TIENDA_SELECCIONADA'][6],$_POST['busquedaProducto']);
        header('Location: ../vista/pTiendaVer_BuscarProductos.php');
    } else{
        $_SESSION['INFO_PRODUCTOS'] = cTiendas::busquedaProductos($_SESSION['INFO_TIENDA_SELECCIONADA'][6]);
    }
        

    