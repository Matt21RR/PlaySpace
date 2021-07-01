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
<!--------- TEXTO GUIA DE CREACIÓN ---------->
    <p>Por favor introduzca la información básica que poseerá el producto de la tienda virtual</p>
<!--------- CONTENEDOR TEXTO BASICO ---------->
    <div>
        <p>Agregar producto</p>
    </div>
<!--------- INGRESO DE VALORES ---------->
    <?php
        if(!isset($_GET['editarTienda'])){  // Si no se esta editando la tienda seguira
            ?>
                <div>
                    <form action="../controladorVista/cvTiendaCrearProducto.php" method="POST" enctype="multipart/form-data">

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
                                    if(isset($_SESSION['ACTUALIZAR_PRODUCTO']))
                                    echo 'value="'.$_SESSION['ACTUALIZAR_PRODUCTO'][1].'"'; 
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
                </div>
            <?php  
        } else{ // Agregar información desde editar tienda
            ?>
                <div>
                    <form action="../controladorVista/cvTiendaCrearProducto.php" method="POST" enctype="multipart/form-data">

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
                                    if(isset($_SESSION['ACTUALIZAR_PRODUCTO']))
                                    echo 'value="'.$_SESSION['ACTUALIZAR_PRODUCTO'][1].'"'; 
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
                </div>
            <?php
        }
    ?>

    
</body>
</html>