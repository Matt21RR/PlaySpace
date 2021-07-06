<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

//----- CONEXIÓN al controlador de la BD Crear Tienda
    include_once('../controlador/cTiendaCrear.php');

//----- COMPROBAR SI LE DA A CANCELAR CREACIÓN O CONTINUAR
    if(isset($_POST['cancelarCreacion'])){
        header('Location: ../vista/pTienda.php');
    } else{
    //----- ALMACENAJE DE INFO BASICA DE LA TIENDA
    /**
     * $_SESSION['INFO_TIENDA'][0] = Nombre Tienda
     * $_SESSION['INFO_TIENDA'][1] = Tiempo de publicación de la tienda
     *                                  0 = 7 días
     *                                  1 = 30 días
     *                                  2 = 60 días
     *                                  3 = 90 días
     *                                  4 = 120 días
     * $_SESSION['INFO_TIENDA'][2] = Telefono Tienda
     * $_SESSION['INFO_TIENDA'][3] = Correo Tienda
     * $_SESSION['INFO_TIENDA'][4] = Dirección Tienda
     * $_SESSION['INFO_TIENDA'][5] = Descripción Tienda
     */
        $_SESSION["INFO_TIENDA"] = [$_POST["NOMBRE_TIENDA"],$_POST["TIEMPO_TIENDA"],$_POST["TELEFONO_TIENDA"],
                                    $_POST["CORREO_TIENDA"],$_POST["DIRECCION_TIENDA"], $POST['DESCRIPCION_TIENDA']];
        $posicionValidar = [0,-1,4,6,-1,1];    //Posición requerida para validar adecuadamente los valores ingresados
                                            // -1 = No requiere validación
        $crearTienda = 1;

    //----- VALIDAR INFO TIENDA
        for($i=0; $i<count($_SESSION["INFO_TIENDA"]); $i++){
            if($posicionValidar[$i] != -1){
                if(cTiendaCrear::validarDatosTienda($_SESSION["INFO_TIENDA"][$i], $posicionValidar[$i]) == -1){
                    $crearTienda = -1;
                    break;
                }
            }
        }
        if($crearTienda == -1){
        //----- REGRESAR PANTALLA crearTienda
            header('Location: ../vista/pTiendaCrear.php');
        } else {
        //----- CARGAR PANTALLA crearTiendaUbicacion
            header('Location: ../vista/pTiendaCrearTipo.php');
        }
    }