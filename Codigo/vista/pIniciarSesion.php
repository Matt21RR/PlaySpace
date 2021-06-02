<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
<!------ TITULO(IMG) ------------------------------>
    <img src="svg/title.png">
<!------ FORMULARIO ------------------------------->
    <form action="cvIniciarSesion.php" method="POST">             <!----- Enviado para confirmar con la BD -->
        <input type="text" name="NOMBRE_USUARIO" placeholder="Nombre de Usuario" required><br>      <!----- NOMBRE_USUARIO -->
        <input type="password" name="CONTRASENA" placeholder="Contraseña" required><br>         <!----- CONTRASENA -->
        <input type="submit" value="Iniciar Sesión">           <!------ INICIAR_SESION -->
    </form>
<!------ ENLACES --------------------------------->
    <a href="pCuentaRecuperar.php">¿Olvidaste los datos de tu cuenta?</a><br>             <!----- Link (Olvido los Datos de la Cuenta) -->
    <a href="pCuentaCrear.php">Crear una cuenta</a>            <!----- Link (Crear Cuenta) -->
<!------ MENSAJE SESIÓN NO INICIADA -->
</body>
</html>