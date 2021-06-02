<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecuperarCuenta (CORREO)</title>
</head>
<body>
<!------ TITULO(IMG) ------------------------------>
    <img src="svg/title.png">
<!------ FORMULARIO ------------------------------->
    <form action="cvCuentaRecuperar.php" method="POST">             <!----- Enviado para confirmar con la BD -->
        <input type="email" name="CORREO" placeholder="Correo Electrónico" required><br>         <!----- CORREO ELECTRONICO -->
        <input type="submit" value="Continuar">           <!------ BUSCAR CUENTA -->
    </form>
<!------ ENLACES --------------------------------->
    <a href="cvCuentaCrear.php">Crear una cuenta</a>            <!----- Link (Crear Cuenta) -->
</body>
</html>