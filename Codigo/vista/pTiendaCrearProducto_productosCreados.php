<?php
        session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrearTiendaProductos_Creados</title>
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
<!--------- TEXTO PROGRESO DE LA CREACIÓN ---------->
    <p>Progreso de creación</p>
<!--------- BARRA PROGRESO ---------->
    <!--<div class="container-progress-bar mx-auto">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" rol="progressbar"
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
        </div>
    </div>-->
    --------------------------------
<!--------- LINEA DIVISORA ---------->
    <div><hr></div>
<!--------- SUB-TITULO ---------->
    <div>
        <h3>Productos</h3>
    </div>
    <div>
        <?php
            $name_infoProducto = ['NOMBRE_PRODUCTO','PRECIO_PRODUCTO','URL_IMG_PRODUCTO','ID_PRODUCTO'];    // array nombres de valores en infoProducto
            for($i=0; $i<count($_SESSION['infoProducto']); $i++){
//--------- IMG_PRODUCTO --------->
                echo '<div id="_'.$_SESSION["infoProducto"][$i][3].'">
                        <img src="'.$_SESSION['infoProducto'][$i][2].'" width="100px" alt="No se encontro una imagen"';
//--------- INFO_PRODUCTO --------->
                echo '  <p>'.$_SESSION["infoProducto"][$i][0].' | '.$_SESSION["infoProducto"][$i][1].'</p>';
// -------- FORM_EDITAR_ELIMINAR -------->
                echo '  <form action="../controladorVista/cvTiendaCrearProducto_EditarEliminar.php" method="post">';
                for($j=0; $j<count($name_infoProducto); $j++){  // infoProducto para editar / eliminar
                    echo '  <input type="hidden" name="'.$name_infoProducto[$j].'" value="'.$_SESSION['infoProducto'][$i][$j].'">';
                }
                echo '      <input type="submit" value="Editar" name="editarProducto">';
// -------- BOTÓN_ELIMINAR -------->
                $ID_PRODUCTO = "'".$_SESSION["infoProducto"][$i][3]."'";
                echo '      <input type="button" value="Eliminar" onclick="elminarProducto('.$ID_PRODUCTO.')">
                        </form>
                      </div>';
            }
        ?>
    </div>
<!--------- AGREGAR OTRO PRODUCTO --------->    
    <div>
        <a href="pTiendaCrearProductos.php">Agregar</a>
    </div>
<!--------- FINALIZAR CREACIÓN ---------->
    <form action="../controladorVista/cvTiendaCrearProducto_EditarEliminar.php" method="post">
        <input type="submit" value="Finalizar" name="finalizarCreacionTienda">
    </form></div>
    <script src="js/eliminarProducto.js"></script>
</body>
</html>