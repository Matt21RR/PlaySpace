<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecuperarCuenta (PIN)</title>
    <?php 
        include_once('comprobarSesiones.php');
        include_once('comprobarTiempo.php');
//----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
        comprobarSesiones();
//----- CONTEO DE TIEMPO PARA BORRAR LA CLAVE DE VALIDACIÓN (PIN) -->
        comprobarTiempo();
    ?>
</head>
<body>
<!------ TITULO(IMG) ------------------------------>
    <img src="svg/title.png">
<!------ PARRAFO GUIA ----------------------------->
    <p>Te enviamos un código para restablecer la contraseña de tu cuenta</p>
<!------ FORMULARIO ------------------------------->
    <form action="cvCuentaRecuperarPIN.php" method="POST">             <!----- Enviado para confirmar con la BD -->
        <input type="text" name="PIN" placeholder="PIN" 
                pattern="[A-Z0-9]{8,8}"
                title="Se requiere de 8 carácteres"><br>         <!----- CLAVE DE VERIFICACIÓN (PIN) -->
        
        <input type="submit" name="enviarOtroPIN" value="Enviar otro código"><br>           <!------ ENVIAR OTRO PIN -->
        <input type="submit" name="Continuar" value="Continuar">           <!------ VALIDAR PIN -->
    </form>
</body>
</html>