<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ver_tienda_buscar</title>
    <link rel="stylesheet" href="css/normalize.css">
    <?php 
        session_start();
    ?>
</head>
<body>
<!----- BARRA DE NAVEGACIÓN (MENU) ----->
    <?php
        include_once('pBarraNav.php');
    ?>
<!-- FORM BUSQUEDA_PRODCUTOS -->
    <form action="../controladorVista/cvTiendaVer_BuscarProductos.php" method="post">
        <input type="search" name="busquedaProducto" placeholder="Buscar">
        <input type="image" src="png/menuIcons/lupa.png">
    </form> 
    <?php
        if(!isset($_SESSION['INFO_PRODUCTOS'])){
            include_once('../controladorVista/cvTiendaVer_BuscarProductos.php');
        }
        if($_SESSION['INFO_PRODUCTOS']!=''){
            echo '  <div>';
            for($i=0; $i<count($_SESSION['INFO_PRODUCTOS']); $i++){
                echo '  <div>
                            <img src="'.$_SESSION['INFO_PRODUCTOS'][$i][2].'" alt="No se encuentra una imagen" width="100px">
                            <p>'.$_SESSION['INFO_PRODUCTOS'][$i][0].'</p>
                            <p>'.$_SESSION['INFO_PRODUCTOS'][$i][1].' '.$_SESSION['monedaLocal'].'</p>
                        </div>';
            }
            echo '  </div>';
            $_SESSION['INFO_PRODUCTOS'] = null; // Elimina la información almacenada
        } else{
            echo '<p>No se encontro el producto</p>';
        }
    ?>
</body>
</html>