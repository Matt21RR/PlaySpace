<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

    // echo $_FILES['img_producto']['name']."<br>";    // Nombre de la imagen
    // echo $_FILES['img_producto']['tmp_name']."<br>";    // Nombre temporal del archivo
    // echo $_FILES['img_producto']['type']."<br>";    // Extención/tipo de imagen
    // echo $_FILES['img_producto']['size'];    // Tamaño de imagen en bytes
    // echo $_FILES['img_producto']['error'];  // Identificador si presenta errores 0 = 0 errores

    // echo $_POST['NOMBRE_PRODUCTO'];         // Nombre del Producto
    // echo $_POST['PRECIO_PRODUCTO'];         // Precio del Producto

// ------------------- INCLUIR CONTROLADOR CREAR TIENDA -------------------
    include_once('../controlador/cTiendaCrear.php');

// ------------------- VALIDAR LA INFORMACIÓN OBTENIDA (NOMBRE / PRECIO) -------------------
    $infoProducto = [$_POST['NOMBRE_PRODUCTO'], $_POST['PRECIO_PRODUCTO']];     // Array para los valores obtenidos (Excluyendo la IMG)
    $posicionValidar = [3,5];                   // Posición para validar adecuadamente la información del producto
    $crearProducto = 1;

    for($i=0; $i<count($infoProducto); $i++){   // Validar si el nombre es adecuado
        if(cTiendaCrear::validarDatosTienda($infoProducto[$i], $posicionValidar[$i]) == -1){
            $crearProducto = -1;
        }
    }
    
    if(isset($_SESSION['infoProducto'])){   // Validar si otro producto ya posee ese nombre
        for($i=0; $i<count($_SESSION['infoProducto']); $i++){
            if($_POST['NOMBRE_PRODUCTO'] == $_SESSION['infoProducto'][$i][0]){
                $crearProducto = -1;
                if(isset($_SESSION['ACTUALIZAR_PRODUCTO'])){    // Comprueba si se hace una actualización del producto y si el nombre que usa es nuevo o si no presenta cambios
                    if($_SESSION['ACTUALIZAR_PRODUCTO'][4] == $i){
                        $crearProducto = 1;
                    }
                }
            }
        }
    }
// ------------------- VALIDAR IMAGEN OBTENIDA (ERROR al mover el archivo) -------------------
    $max_tamano = 1024 * 1024 * 8 * 3;     // 3 MB = Tamaño maximo permitido

    if($_FILES['img_producto']['error'] != 0 or $_FILES['img_producto']['size'] > $max_tamano){ //Validar si existen errores o si la imagen supera el tamaño maximo eprmitido
        $crearProducto = -1;
    } else if ($crearProducto == 1){
    // Creación de una subcarpeta en donde se alamcenara la IMG del producto
        $ruta_usuario = "../vista/img_usuarios/".$_SESSION['ID_USUARIO'];
        $ruta_usuario_tienda = $ruta_usuario."/".cTiendaCrear::crearIDTienda($_SESSION['ID_USUARIO']);
        $ruta_usuario_producto = $ruta_usuario_tienda."/img_productos";

        if (!is_dir($ruta_usuario_producto)){   // Comprueba si ya existen las subcarpetas requeridas
            mkdir($ruta_usuario);   // Creación de la subcarpeta de un usuario cuyo caso aun no este creada
            mkdir($ruta_usuario_tienda);    // Creación de la subcarpeta de una tienda cuyo caso aun no este creada
            mkdir($ruta_usuario_producto);   // Creación de la subcarpeta productos cuyo caso aun no este creada
        }
        $ruta_usuario_producto = $ruta_usuario_producto."/"; 
    // Trasladar la Imagen del destino temporal a uno permanente
        $ruta_final = $ruta_usuario_producto.basename($_FILES['img_producto']['name']);
        move_uploaded_file($_FILES['img_producto']['tmp_name'], $ruta_final);

        if(!isset($_SESSION['ACTUALIZAR_PRODUCTO'])){
        // Creación de una fracción de la ID_PRODUCTO
            if(isset($_SESSION['ID_FRACCION_PRODUCTO'])){
                $_SESSION['ID_FRACCION_PRODUCTO'] += 1;
            } else{
                $_SESSION['ID_FRACCION_PRODUCTO'] = 0;
            }
// ------------------- ALMACENAR INFOR PRODUCTO EN $_SESSION['infoProducto'] -------------------
            $ID_PRODUCTO = $_SESSION['ID_USUARIO']."_".cTiendaCrear::crearIDTienda($_SESSION['ID_USUARIO'])."_".$_SESSION['ID_FRACCION_PRODUCTO'];
        } else{
            $ID_PRODUCTO = $_SESSION['ACTUALIZAR_PRODUCTO'][3];
        }
        $infoProducto = [$infoProducto[0],$infoProducto[1],$ruta_final, $ID_PRODUCTO];

        if(isset($_SESSION['infoProducto'])){
            for($i=0; $i<count($_SESSION['infoProducto']); $i++){   // Comprobar si la imagen no esta siendo usada por otro producto
                if($ruta_final == $_SESSION['infoProducto'][$i][2]){
                    $crearProducto = -1;
                    if(isset($_SESSION['ACTUALIZAR_PRODUCTO'])){    // Comprueba si se hace una actualización del producto y si el nombre que usa es nuevo o si no presenta cambios
                        if($_SESSION['ACTUALIZAR_PRODUCTO'][4] == $i){
                            $crearProducto = 1;
                        }
                    }
                }
            }
        }
    //  Almacena la información del producto en una lista
    //      [][0] = NOMBRE_PRODUCTO
    //      [][1] = PRECIO_PRODUCTO
    //      [][2] = RUTA_IMG_PRODUCTO
    //      [][3] = ID_PRODUCTO
        if($crearProducto == 1){
            if(isset($_SESSION['ACTUALIZAR_PRODUCTO'])){
                for($i=0; $i<count($_SESSION['infoProducto']); $i++){   // Busqueda de la información del producto
                    if(array_search($ID_PRODUCTO, $_SESSION["infoProducto"][$i])){ // Busqueda de la fila en donde esta almacenada la info del producto
                        for($j=0; $j<count($infoProducto); $j++){   // Repetidor para reescribir la información almacenada
                            $_SESSION['infoProducto'][$i][$j] = $infoProducto[$j];
                        }
                    }
                }
                $_SESSION['ACTUALIZAR_PRODUCTO'] = null;    // Eliminar la información almacenada
            } else if(isset($_SESSION['infoProducto'])){   // Comprueba si se ha creado anteriormente un producto
                $i = count($_SESSION['infoProducto']);  // Indica la fila en donde sera almacenado el nuevo producto
    
                for($j=0; $j<count($infoProducto); $j++){   // Repetidor para almacenar la información del producto en la fila idicada
                    $_SESSION['infoProducto'][$i][$j] = $infoProducto[$j];
                }
            } else{
                for($j=0; $j<count($infoProducto); $j++){   // Repetidor para almacenar la información del producto en la fila 0
                    $_SESSION['infoProducto'][0][$j] = $infoProducto[$j];
                }
            }
        }
        // echo cTiendaCrear::crearIDProducto((cTiendaCrear::crearIDTienda($_SESSION['ID_USUARIO'])), $_SESSION['ID_USUARIO']);
    }
    if($crearProducto == 1){
        header('Location: ../vista/pTiendaCrearProducto_productosCreados.php', false);
    } else{
        header('Location: ../vista/pTiendaCrearProductos.php', false);
    }