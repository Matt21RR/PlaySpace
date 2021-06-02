<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecuperarCuenta (RenovarContraseña)</title>
<!----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    <?php include_once('comprobarSesiones.php') ?>
</head>
<body>
<!------ TITULO(IMG) ------------------------------>
    <img src="svg/title.png">
<!------ PARRAFO GUIA ----------------------------->
    <h3>Crea una contraseña nueva</h3>
    <p>Ingresa una combinación de al menos 8 letras, números o signos de puntuación</p>
<!------ FORMULARIO ------------------------------->
    <form action="cvCuentaRecuperarNewPass.php" method="POST">             <!----- Enviado para confirmar con la BD -->
        <input type="password" name="NEW_CONTRASENA" placeholder="Nueva Contraseña" required><br>         <!----- NUEVA CONTRASENA -->
        <input type="submit" name="Continuar" value="Continuar">           <!------ VALIDAR NUEVA CONTRASEÑA -->
    </form>
</body>
</html>