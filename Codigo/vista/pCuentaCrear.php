<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
?> 
    <title>Crear Cuenta</title>
</head>
<body>
<!------ FORMULARIO ------------------------------->
    <form action="../controladorVista/cvCuentaCrear.php" method="POST">             <!----- Enviado para confirmar con la BD -->
    <!----- Seleccionar Perfil (Temporal) -->
        <select name="ID_FOTO_PERFIL">
            <?php
                for($i=0; $i<=11; $i++){
                    echo "<option value='$i'>$i</option>";
                }
            ?>
        </select><br>
    <!----- NOMBRE_USUARIO / CONTRASENA / CORREO -->
        <input type="text" name="NOMBRE_USUARIO" placeholder="Nombre de Usuario" required><br>      <!----- NOMBRE_USUARIO -->
        <input type="password" name="CONTRASENA" placeholder="Contraseña" required><br>         <!----- CONTRASENA -->
        <input type="email" name="CORREO" placeholder="Correo Electrónico" required><br>         <!----- CORREO ELECTRONICO -->
    <!----- CREAR CUENTA / ACEPTAR TERMINOS -->
        <input type="submit" value="Crear Cuenta"><br>           <!------ CREAR CUENTA -->
        <input type="checkbox" required>Acepto los términos y condiciones de uso
    </form>
</body>
</html>