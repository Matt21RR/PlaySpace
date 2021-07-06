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
<!--------- SUB-TITULO ---------->
    <div>
        <h3>Productos</h3>
    </div>
    <div>
        <?php
// -------- PRODUCTO -->
            $name_infoProducto = ['NOMBRE_PRODUCTO','PRECIO_PRODUCTO','URL_IMG_PRODUCTO','ID_PRODUCTO'];    // array nombres de valores en INFO_PRODUCTOS
            
            for($i=0; $i<count($_SESSION['INFO_PRODUCTOS']); $i++){
                echo '<div id="_'.$_SESSION['INFO_PRODUCTOS'][$i][3].'">';
    // -------- IMG_PRODUCTO -->
                echo '  <img src="'.$_SESSION['INFO_PRODUCTOS'][$i][2].'" alt="No se encontro una imagen" width="100px">';
    // -------- INFO_PRODUCTO -->
                echo '  <p>'.$_SESSION['INFO_PRODUCTOS'][$i][0].' | '.$_SESSION['INFO_PRODUCTOS'][$i][1].' '.$_SESSION['monedaLocal'].'</p>';
    // -------- FORM_EDITAR_ELIMINAR -------->
                echo '  <form action="../controladorVista/cvTiendaEditarProducto_EditarEliminar.php" method="post">';
                for($j=0; $j<count($name_infoProducto); $j++){  // envio de valores para editar / eliminar
                    echo '  <input type="hidden" name="'.$name_infoProducto[$j].'" value="'.$_SESSION['INFO_PRODUCTOS'][$i][$j].'">';
                }
        // -------- BOTÓN_EDITAR -------->
                echo '      <input type="submit" value="Editar" name="editarProducto">';
        // -------- BOTÓN_ELIMINAR -------->
                $ID_PRODUCTO = "'".$_SESSION["INFO_PRODUCTOS"][$i][3]."'";
                echo   '    <input type="button" value="Eliminar" name="eliminarProductos" onclick="elminarProductoEditar('.$ID_PRODUCTO.')">
                        </form>
                      </div>';
            }
        ?>
    </div>
<!--------- AGREGAR OTRO PRODUCTO --------->    
    <div>
        <a href="pTiendaEditarProductos.php">Agregar</a>
    </div>
<!--------- NO GUARDAR / GUARDAR CAMBIOS ---------->
    <a href="../controladorVista/cvTiendaEditarProducto_EditarEliminar.php?noGuardarProductos=1">Cancelar</a>
    <a href="pTiendaEditar.php">Guardar Productos</a>
    <script src="js/eliminarProducto.js"></script>
</body>
</html>