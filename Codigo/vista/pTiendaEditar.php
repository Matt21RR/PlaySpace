<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda_Editar</title>
    <link rel="stylesheet" href="css/normalize.css">
    <?php
        session_start();
        include_once('../controlador/cTiendas.php');
    ?>
</head>
<body>
<!----- BARRA DE NAVEGACIÓN (MENU) ----->
    <?php
        include_once('pBarraNav.php');
    ?>
<!-- RESUMEN TIENDA -->
    <p>Selecciona el ítem que desees modificar, agregar o eliminar</p>
<!-- Linea Divisora -->
    <hr>
<!-- RESUMEN -->
    <div>RESUMEN</div>
    <div>
    <!-- NOMBRE TIENDA -->
        <div>NOMBRE</div>
        <div><?php echo $_SESSION['INFO_TIENDA_SELECCIONADA'][0]; ?></div>

        <div>Ubicacion</div>
        <div>
            <a href="#">Ver</a>
        </div>

        <div>Tipo de productos</div>
        <div>
            <?php
                include_once('lists/actividades.php');  // Incluir la información acerca de los tipos de productos

                for($i=0; $i<count($_SESSION['INFO_TIENDA_SELECCIONADA'][7]); $i++){
                    for($j=0; $j<count($_SESSION['INFO_TIENDA_SELECCIONADA'][7][$i]); $j++){
                        echo '<p>'.$posicionActividad[$i][$_SESSION['INFO_TIENDA_SELECCIONADA'][7][$i][$j]].'</p>';
                    }
                }
            ?>
        </div>

        <div>Descripción</div>
        <div><?php echo $_SESSION['INFO_TIENDA_SELECCIONADA'][5]; ?></div>

        <div>Fin de la Publicación</div>
        <div><?php echo $_SESSION['INFO_TIENDA_SELECCIONADA'][3]; ?></div>

        <div>Contacto</div>
        <div><?php echo $_SESSION['INFO_TIENDA_SELECCIONADA'][1] ?></div>
 
        <div>Email</div>
        <div><?php echo $_SESSION['INFO_TIENDA_SELECCIONADA'][2] ?></div>
    </div>
<!-- PRODUCTOS -->
    <div>PRODUCTOS</div>
    <div>
        <div>
            <?php
                $INFO_PRODUCTOS = cTiendas::consultarInfoProductos($_SESSION['INFO_TIENDA_SELECCIONADA'][6]);
                for($i=0; $i<count($INFO_PRODUCTOS); $i++){
                    echo '  <div>
                                <img src="'.$INFO_PRODUCTOS[$i][2].'" width="100px" alt="No se encontro una imagen">
                                <p>'.$INFO_PRODUCTOS[$i][0].'</p>
                                <p>'.$INFO_PRODUCTOS[$i][1].' '.$_SESSION['monedaLocal'].'</p>
                            </div>';
                }
            ?>
        </div>
    </div>

    <a href="pTiendaCrearProductos.php?editarTienda=1">Agregar Producto</a>
<!-- LINEA DIVISORA -->
    <hr>
<!-- BOTONES CANCELAR / GUARDAR -->
    <form action="#" method="post">
    <!-- CANCELAR -->
        <a href="pTienda.php">cancelar</a>
    <!-- GUARDAR -->
        <input type="submit" value="Guardar">
    </form>
</body>
</html>