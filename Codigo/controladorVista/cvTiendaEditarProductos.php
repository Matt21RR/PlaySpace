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
// ------------------- CANCELAR LA CREACIÓN O ACTUALIZACIÓN DE UN NUEVO PRODUCTO --
    if(isset($_GET['cancelarProducto'])){
        if(isset($_SESSION['ACTUALIZAR_PRODUCTO'])){
            $_SESSION['ACTUALIZAR_PRODUCTO'] = null;
        }
        header('Location: ../vista/pTiendaEditarProducto_productosCreados.php', false);
        exit;
    }
// ------------------- VALIDAR LA INFORMACIÓN OBTENIDA (NOMBRE / PRECIO) -------------------
    $infoProducto = [$_POST['NOMBRE_PRODUCTO'], $_POST['PRECIO_PRODUCTO']];     // Array para los valores obtenidos (Excluyendo la IMG)
    $posicionValidar = [3,5];                   // Posición para validar adecuadamente la información del producto
    $crearProducto = 1;

    for($i=0; $i<count($infoProducto); $i++){   // Validar si el nombre es adecuado
        if(cTiendaCrear::validarDatosTienda($infoProducto[$i], $posicionValidar[$i]) == -1){
            $crearProducto = -1;
        }
    }
    
    if(isset($_SESSION['INFO_PRODUCTOS'])){   // Validar si otro producto ya posee ese nombre
        for($i=0; $i<count($_SESSION['INFO_PRODUCTOS']); $i++){
            if($_POST['NOMBRE_PRODUCTO'] == $_SESSION['INFO_PRODUCTOS'][$i][0]){
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
        $ruta_usuario_tienda = $ruta_usuario."/".$_SESSION['INFO_TIENDA_SELECCIONADA'][6];
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

        
// ------------------- ALMACENAR O REEMPLAZAR INFOR PRODUCTO EN $_SESSION['INFO_PRODUCTOS'] -------------------   
        if(isset($_SESSION['ACTUALIZAR_PRODUCTO'])){
            $ID_PRODUCTO = $_SESSION['ACTUALIZAR_PRODUCTO'][3];
        } else{ // Incrementa en 1 la ID del nuevoproducto tomando encuenta el ultimo producto creado
            $before_ID_PRODUCTO = $_SESSION['ID_USUARIO']."_".$_SESSION['INFO_TIENDA_SELECCIONADA'][6]."_";
            $ID_PRODUCTO = str_replace($before_ID_PRODUCTO, "", $_SESSION['INFO_PRODUCTOS'][(count($_SESSION['INFO_PRODUCTOS']))-1][3]);
            $ID_PRODUCTO += 1;
            $ID_PRODUCTO = $before_ID_PRODUCTO.$ID_PRODUCTO;
        }

        $infoProducto = [$infoProducto[0],$infoProducto[1],$ruta_final, $ID_PRODUCTO];

        if(isset($_SESSION['INFO_PRODUCTOS'])){
            for($i=0; $i<count($_SESSION['INFO_PRODUCTOS']); $i++){   // Comprobar si la imagen no esta siendo usada por otro producto
                if($ruta_final == $_SESSION['INFO_PRODUCTOS'][$i][2]){
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
                for($i=0; $i<count($_SESSION['INFO_PRODUCTOS']); $i++){   // Busqueda de la información del producto
                    if(array_search($ID_PRODUCTO, $_SESSION["INFO_PRODUCTOS"][$i])){ // Busqueda de la fila en donde esta almacenada la info del producto
                        for($j=0; $j<count($infoProducto); $j++){   // Repetidor para reescribir la información almacenada
                            $_SESSION['INFO_PRODUCTOS'][$i][$j] = $infoProducto[$j];
                        }
                    }
                }
                $_SESSION['ACTUALIZAR_PRODUCTO'] = null;    // Eliminar la información almacenada
            } else if(isset($_SESSION['INFO_PRODUCTOS'])){   // Comprueba si posee un producto
                $i = count($_SESSION['INFO_PRODUCTOS']);  // Indica la fila en donde sera almacenado el nuevo producto
    
                for($j=0; $j<count($infoProducto); $j++){   // Repetidor para almacenar la información del producto en la fila idicada
                    $_SESSION['INFO_PRODUCTOS'][$i][$j] = $infoProducto[$j];
                }
            } else{
                for($j=0; $j<count($infoProducto); $j++){   // Repetidor para almacenar la información del producto en la fila 0
                    $_SESSION['INFO_PRODUCTOS'][0][$j] = $infoProducto[$j];
                }
            }
        }
        // echo cTiendaCrear::crearIDProducto((cTiendaCrear::crearIDTienda($_SESSION['ID_USUARIO'])), $_SESSION['ID_USUARIO']);
    }
    if($crearProducto == 1){
        header('Location: ../vista/pTiendaEditarProducto_productosCreados.php', false);
    } else{
        header('Location: ../vista/pTiendaEditarProductos.php', false);
    }