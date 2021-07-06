<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrearTienda_Resumen</title>
    <link rel="stylesheet" href="css/normalize.css">
    <?php
        session_start();
        include_once('lists/actividades.php')
    ?>
</head>
<body>
<!------ TEXTO GUIA -->
    <p>Selecciona el ítem que desees modificar, agregar o eliminar</p>
    <hr>
<!------ BARRA RESUMEN -->
    <div id="BARRA_RESUMEN">
        RESUMEN
        <div>
            <div>Nombre</div>
            <?php echo $_SESSION['INFO_TIENDA'][0]; ?>
        </div>  <!-- NOMBRE_TIENDA -->
        <div>
            <div>Ubicación</div>
            #####
        </div>  <!-- UBICACION -->
        <div>
            <div>Tipo de Productos</div>
            <?php 
                for($i=0; $i<count($_SESSION['opcionesTipoActividad']); $i++){
                    if(isset($_SESSION['opcionesTipoActividad'][$i])){
                        for($j=0; $j<count($_SESSION['opcionesTipoActividad'][$i]); $j++){
                            echo '<p>'.$posicionActividad[$i][$_SESSION['opcionesTipoActividad'][$i][$j]].'</p>';
                        }
                    }
                }
            ?>
        </div>  <!-- TIPOS_PRODUCTOS -->
        <div>
            <div>Descripción</div>
            <?php echo $_SESSION['INFO_TIENDA'][5]; ?>
        </div>  <!-- DESCRIPCIÓN -->
        <div>
            <div>Fin de publicación</div>
            <?php
                include_once('../controlador/cTiendaCrear.php');
                echo cTiendaCrear::ofrecerEspacioPublicitario($_SESSION['ID_USUARIO'], $_SESSION['INFO_TIENDA'][1], 1)  // Mostrar Fecha Límite de la tienda
            ?>
        </div>  <!-- FIN_PUBLICACIÓN -->
        <div>
            <div>Contacto</div>
            <?php echo $_SESSION['INFO_TIENDA'][2]; ?>
        </div>  <!-- CONTACTO -->
        <div>
            <div>Dirección</div>
            <?php echo $_SESSION['INFO_TIENDA'][4]; ?>
        </div>  <!-- DIRECCÓN -->
        <div>
            <div>Correo Electrónico</div>
            <?php echo $_SESSION['INFO_TIENDA'][3]; ?>
        </div>  <!-- EMAIL -->
    </div>
<!------ BARRA PRODUCTOS -->
    <hr>
    <div id="">
        PRODUCTOS
        <div>
            <?php
                for($i=0; $i<count($_SESSION['infoProducto']); $i++){
//--------- IMG_PRODUCTO --------->
                    echo '<div>
                            <img src="'.$_SESSION['infoProducto'][$i][2].'" width="100px" alt="No se encontro una imagen"';
//--------- INFO_PRODUCTO --------->
                    echo '  <p>'.$_SESSION["infoProducto"][$i][0].' | '.$_SESSION["infoProducto"][$i][1].'</p>
                        </div>';
                }
            ?>
        </div>
    </div>
<!------ BOTÓN EDITAR PRODUCTOS -->
    <a href="pTiendaCrearProducto_productosCreados.php">Editar Productos</a>
<!------ CANCELAR CREAR TIENDA  -->
    <a href="pTienda.php">Cancelar Creación</a>
<!------ BOTÓN CREAR TIENDA -->
    <a href="../controladorVista/cvTiendaCrear_Crear.php">Crear Tienda</a>
</body>
</html>