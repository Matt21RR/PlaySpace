<?php
    session_start();
        
    if(isset($_POST['editarProducto'])){        // EDITAR INFO_PRODUCTO
        $name_infoProducto = ['NOMBRE_PRODUCTO','PRECIO_PRODUCTO','URL_IMG_PRODUCTO','ID_PRODUCTO', 'NUM_FILA'];    // array nombres de valores en infoProducto
        for($i=0; $i<count($name_infoProducto); $i++){
            if($name_infoProducto[$i] != 'NUM_FILA'){
                $_SESSION['ACTUALIZAR_PRODUCTO'][$i] = $_POST[$name_infoProducto[$i]];
            } else{
                for($j=0; $j<count($_SESSION["INFO_PRODUCTOS"]); $j++){
                    if($_SESSION['ACTUALIZAR_PRODUCTO'][0] == $_SESSION["INFO_PRODUCTOS"][$j][0]){
                        $_SESSION['ACTUALIZAR_PRODUCTO'][$i] = $j;
                    }
                }
            }
        }
        // var_dump($_SESSION['ACTUALIZAR_PRODUCTO']);
        // unlink($_SESSION["ACTUALIZAR_PRODUCTO"][2]);   // Elimina la imagen del producto
        header('Location: ../vista/pTiendaEditarProductos.php');
    }else if(isset($_GET['noGuardarProductos'])){    // CANCELAR CREACIÓN PRODUCTOS
        $_SESSION['INFO_PRODUCTOS'] = $_SESSION['COPIA_SEGURIDAD_INFO_PRODUCTOS'];
        header("Location: ../vista/pTiendaEditar.php", false);
    } else{              // ELIMINAR PRODUCTO
        if(!isset($_SESSION['EliminarProductos_ID'])){
            $_SESSION['EliminarProductos_ID'][0] = $_REQUEST['ID_PRODUCTO'];
        } else{
            $_SESSION['EliminarProductos_ID'][count($_SESSION['EliminarProductos_ID'])] = $_REQUEST['ID_PRODUCTO'];
        }
        for($i=0; $i<count($_SESSION["INFO_PRODUCTOS"]); $i++){
            if(array_search($_REQUEST['ID_PRODUCTO'], $_SESSION["INFO_PRODUCTOS"][$i])){ // Busqueda de la fila en donde esta almacenada la info del producto
                unlink($_SESSION["INFO_PRODUCTOS"][$i][2]);   // Elimina la imagen del producto
                unset($_SESSION["INFO_PRODUCTOS"][$i]);   // Elimina toda la información del producto
                sort($_SESSION["INFO_PRODUCTOS"],1);  //  Ordena la lista que almacena todos los productos
            }
        }
    }