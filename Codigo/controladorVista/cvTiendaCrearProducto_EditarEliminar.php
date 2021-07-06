<?php
    session_start();
        
    if(isset($_POST['editarProducto'])){        // EDITAR INFO_PRODUCTO
        $name_infoProducto = ['NOMBRE_PRODUCTO','PRECIO_PRODUCTO','URL_IMG_PRODUCTO','ID_PRODUCTO', 'NUM_FILA'];    // array nombres de valores en infoProducto
        for($i=0; $i<count($name_infoProducto); $i++){
            if($name_infoProducto[$i] != 'NUM_FILA'){
                $_SESSION['ACTUALIZAR_PRODUCTO'][$i] = $_POST[$name_infoProducto[$i]];
            } else{
                for($j=0; $j<count($_SESSION["infoProducto"]); $j++){
                    if($_SESSION['ACTUALIZAR_PRODUCTO'][0] == $_SESSION["infoProducto"][$j][0]){
                        $_SESSION['ACTUALIZAR_PRODUCTO'][$i] = $j;
                    }
                }
            }
        }
        unlink($_SESSION["ACTUALIZAR_PRODUCTO"][2]);   // Elimina la imagen del producto
        header('Location: ../vista/pTiendaCrearProductos.php');
    }else if(isset($_POST['finalizarCreacionTienda'])){    // FINALIZAR CREACIÓN
        header('Location: ../vista/pTiendaCrear_Resumen.php');
    } else{              // ELIMINAR PRODUCTO
        for($i=0; $i<count($_SESSION["infoProducto"]); $i++){
            if(array_search($_REQUEST['ID_PRODUCTO'], $_SESSION["infoProducto"][$i])){ // Busqueda de la fila en donde esta almacenada la info del producto
                unlink($_SESSION["infoProducto"][$i][2]);   // Elimina la imagen del producto
                unset($_SESSION["infoProducto"][$i]);   // Elimina toda la información del producto
                sort($_SESSION["infoProducto"],1);  //  Ordena la lista que almacena todos los productos
            }
        }
    }