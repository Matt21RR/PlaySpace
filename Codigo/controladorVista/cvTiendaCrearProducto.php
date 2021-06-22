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

    for($i=0; $i<count($infoProducto); $i++){
        if(cTiendaCrear::validarDatosTienda($infoProducto[$i], $posicionValidar[$i]) == -1){
            header('Location: ../vista/pTiendaCrearProductos.php');
        }
    }

// ------------------- VALIDAR IMAGEN OBTENIDA (ERROR al mover el archivo) -------------------
    $max_tamano = 1024 * 1024 * 8;     // 1 MB = Tamaño maximo permitido

    if($_FILES['img_producto']['error'] != 0 or $_FILES['img_producto']['size'] > $max_tamano){ //Validar si existen errores o si la imagen supera el tamaño maximo eprmitido
        header('Location: ../vista/pTiendaCrearProductos.php');
    } else{
    // Creación de una subcarpeta en donde se alamcenara la IMG del producto
    /*    $ruta_usuario = "../vista/img_usuarios/".$_SESSION['ID_USUARIO'];
        $ruta_usuario_producto = $ruta_usuario."/img_producto";

        if (!is_dir($ruta_usuario_producto)){   // Comprueba si ya existen las subcarpetas requeridas
            mkdir($ruta_usuario);   // Creación de la subcarpeta de un usuario cuyo caso aun no este creada
            mkdir($ruta_usuario_producto);   // Creación de la subcarpeta cuyo caso aun no este creada
        }
    // Trasladar la Imagen del destino temporal a uno permanente
        $ruta_img_origen = $_FILES['img_producto']['tmp_name'];

        if(move_uploaded_file($ruta_img_origen, $ruta_usuario_producto)) echo "Movimiento exitoso";
    */
// ------------------- ALMACENAR INFOR PRODUCTO EN $_SESSION['infoProducto'] -------------------
        $_SESSION['infoProducto'] = [$infoProducto[0],$infoProducto[1],
                                    $_FILES['img_producto']['name'],$_FILES['img_producto']['type']];
    }