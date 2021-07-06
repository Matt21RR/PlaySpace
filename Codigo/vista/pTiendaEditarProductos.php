<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrearTiendaProductos</title>
    <link rel="stylesheet" href="css/normalize.css">
    <?php 
        session_start();
    ?>
</head>
<body>
<!--------- TEXTO GUIA DE CREACIÓN ---------->
    <p>Por favor introduzca la información básica que poseerá el producto de la tienda virtual</p>
<!--------- CONTENEDOR TEXTO BASICO ---------->
    <div>
        <p>Agregar producto</p>
    </div>
<!--------- INGRESO DE VALORES ---------->
    <div>
        <form action="../controladorVista/cvTiendaEditarProductos.php" method="POST" enctype="multipart/form-data">

            <input type="file" name="img_producto" accept="image/png,image/jpeg" required>  <!-- INSERTAR IMAGEN -->

            <label>Nombre: 
                <input type="text" name="NOMBRE_PRODUCTO" placeholder="Nombre del producto*"
                    <?php 
                        if(isset($_SESSION['ACTUALIZAR_PRODUCTO']))
                        echo 'value="'.$_SESSION['ACTUALIZAR_PRODUCTO'][0].'"'; 
                    ?> required>
            </label>   <!--- NOMBRE_PRODUCTO -->

            <label>Precio:  
                <input type="number" name="PRECIO_PRODUCTO" placeholder="Precio del producto"
                    <?php 
                        if(isset($_SESSION['ACTUALIZAR_PRODUCTO'])){
                            echo 'value="'.$_SESSION['ACTUALIZAR_PRODUCTO'][1].'"'; 
                        }
                        echo 'required>';
                        echo ' '.$_SESSION['monedaLocal'];
                    ?>
            </label>    <!--- PRECIO_PRODUCTO -->
    <!--------- BOTÓN AGREGAR ---------->
            <?php 
                if(isset($_SESSION['ACTUALIZAR_PRODUCTO'])){
                    echo '<input type="submit" value="Actualizar" name="actualizarProducto">';
                } else{
                    echo '<input type="submit" value="Agregar">';
                }
            ?>
        </form>
        <a href="../controladorVista/cvTiendaEditarProductos.php?cancelarProducto=1">Cancelar</a>
    </div>
</body>
</html>