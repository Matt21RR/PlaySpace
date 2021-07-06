<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ver_tienda</title>
    <link rel="stylesheet" href="css/normalize.css">
    <?php 
        session_start(); 
        include_once('../mMaster.php');
        include_once('../controlador/cTiendas.php');
    ?>
</head>
<body>
<!----- BARRA DE NAVEGACIÓN (MENU) ----->
    <?php
        include_once('pBarraNav.php');
    ?>
    <h1>INFORMACIÓN TIENDA</h1>
    <div>
    <!-- IMAGEN TIENDA -->
        <!-- <img src="" alt=""> -->
        <?php
            echo '  <p>'.$_SESSION['INFO_TIENDA_SELECCIONADA'][0].'</p>';  // Nombre Tienda
            echo '  <p>Fin Publicación: '.mMaster::tiempoTexto($_SESSION['INFO_TIENDA_SELECCIONADA'][3],1).'</p>';  // Telefono Tienda
            
            if($_SESSION['INFO_TIENDA_SELECCIONADA'][1] != 0){
                echo '  <p>Tel: '.$_SESSION['INFO_TIENDA_SELECCIONADA'][1].'</p>';
            }   // Comprobar si se registro un npumero tel
            if($_SESSION['INFO_TIENDA_SELECCIONADA'][2] != ''){
                echo '  <p>Email: '.$_SESSION['INFO_TIENDA_SELECCIONADA'][2].'</p>';
            }   // Comprobar si se registro un email
        // Linea divisora
            echo '  <hr>';
            if($_SESSION['INFO_TIENDA_SELECCIONADA'][4] != ''){
                echo '  <p>'.$_SESSION['INFO_TIENDA_SELECCIONADA'][4].'</p>';
            }   // Comprobar si se registro una descripción
        // Linea divisora
            echo '  <hr>';
        // ICON BUSQUEDA
            echo '  <div>
                        Productos
                        <a href="pTiendaVer_BuscarProductos.php"><img src="png/menuIcons/lupa.png" alt="No se encontro una imagen"></a>
                    </div>';
                // [][0] = NOMBRE_PRODUCTO
                // [][1] = PRECIO_PRODUCTO
                // [][2] = URL_IMG_PRODUCTO
            $INFO_PRODUCTOS = cTiendas::consultarInfoProductos($_SESSION['INFO_TIENDA_SELECCIONADA'][6]);
            for($i=0; $i<count($INFO_PRODUCTOS); $i++){
                echo '  <div>
                            <img src="'.$INFO_PRODUCTOS[$i][2].'" width="100px" alt="No se encontro una imagen">
                            <p>'.$INFO_PRODUCTOS[$i][0].'</p>
                            <p>'.$INFO_PRODUCTOS[$i][1].' '.$_SESSION['monedaLocal'].'</p>
                        </div>';
            }
        ?>
    <!-- Linea divisora -->
        <hr>
    <!-- BOTÓN MENSAJES -->
        <a href="#">Mensajes y/o preguntas</a>
    </div>
</body>
</html>