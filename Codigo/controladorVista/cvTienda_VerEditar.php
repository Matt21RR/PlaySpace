<?php
    session_start();

// inclusión de cTiendas
    include_once('../controlador/cTiendas.php');

    // Almacena la info de la tienda que usara
        // [0] = Nombre Tienda
        // [1] = telefono Tienda
        // [2] = Correo Tienda
        // [3] = Fin publicación Tienda
        // [4] = Descripción Tienda
        // [5] = Dirección Tienda
        // [6] = ID Tienda
    for($i=0; $i<count($_SESSION['INFO_TIENDAS'][$_POST['posicionTienda']]); $i++){
        $_SESSION['INFO_TIENDA_SELECCIONADA'][$i] = $_SESSION['INFO_TIENDAS'][$_POST['posicionTienda']][$i];
    }

    // Almacena la info de la tienda que usara
        // [7] = TIPOS_PRODUCTOS
    if(isset($_POST['editarTienda'])){
        $_SESSION['INFO_TIENDA_SELECCIONADA'][7] = cTiendas::busquedaTiposProductos($_SESSION['INFO_TIENDA_SELECCIONADA'][6]);
        header('Location: ../vista/pTiendaEditar.php');
    } else{
        header('Location: ../vista/pTiendaVer.php');
    }