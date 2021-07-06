<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css"><?php
        include_once('../controladorVista/cvBorrarSesiones.php');
    ?>
    <title>Tienda</title>
</head>
<body>
<!----- BARRA DE NAVEGACIÓN (MENU) ----->
    <?php
        include_once('./pPlantilla.php');
    ?>
<!----- TIENDAS CREADAS  -->
    <br>
    <br>
    <h1>TIENDAS</h1>
    <?php
        include_once('../controladorVista/cvTienda.php');
    ?>
<!----- CREAR TIENDAS -->
    <a href="pTiendaCrear.php">Crear Tienda</a>
</body>
</html>