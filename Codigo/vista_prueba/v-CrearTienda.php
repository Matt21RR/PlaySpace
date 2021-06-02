<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tienda</title>
</head>
<body>
    <h1>Crear Tienda</h1>
<!-- CREAR TIENDA ESCRIBIR NOMBRE ------->
        <!-- Relación con la tabla padre por medio de ESCRIBIR el nombre de usuario ---->
    <!--
    <form action="c-CrearTienda.php" method="POST">
        <input type="text" placeholder="Nombre de Usuario" name="NOMBRE_USUARIO" required><br>
    -->
<!-- CREAR TIENDA SELECCIONAR NOMBRE ---->
        <!-- Relación con la tabla padre por medio de la SELECCION del nombre de usuario ---->
    <?php
        include_once('m-Perfil.php');       //llamado a las funciones de moledo
        $info_usuarios = pedirInfoUsuarios();       //almacenar las ID y nombres de los usuarios
                                                        //[][0] = ID_USUARIO
                                                        //[][1] = NOMBRE_USUARIO
    ?>                                                     
    <form action="c-CrearTienda.php" method="POST">

        <select name="ID_USUARIO">          <!-- Lista de nombres de usuarios con valor a sus ID -->
            <?php
                for($i=0; $i<(count($info_usuarios)); $i++){
                        echo "<option value='".$info_usuarios[$i][0]."'>".$info_usuarios[$i][1]."</option>";
                }                              // ID_USUARIO = [][0]        NOMBRE_USUARIO[][1]
            ?>
        </select><br>
<!-- CUERPO DE CREAR TIENDA ------------->

        <input type="text" placeholder="Nombre Tienda" name="nombreTienda" required><br>    <!-- Recuadro Nombre Tienda -->
        <input type="text" placeholder="Descripción" name="descripcionTienda"><br>          <!-- Recuadro Descripción de la Tienda -->
        <input type="text" placeholder="Dirección" name="direccionTienda"><br>              <!-- Recuadro Dirección Tineda -->
        <input type="tel" placeholder="Telefono" name="contactoTienda"><br>                 <!-- Recuadro Telefono Tienda -->
        <input type="email" placeholder="Correo Electrónico" name="correoTienda" required><br>  <!-- Recuadro Correo Tienda -->

        <select name="tiempoCompra">        <!-- Lista de los paquetes de publicación -->
            <?php
                for($i=0; $i<5; $i++){          
                    echo "<option value='$i'>Paquete $i</option>";
                }           //  paquete seleccionado que durara la tienda
                            //      0 = 7 días      1 = 30 días     2 = 60 días
                            //      3 = 90 días     4 = 120 días
            ?>
        </select><br>

        <input type="submit" value="Crear Tienda">
    </form>
</body>
</html>