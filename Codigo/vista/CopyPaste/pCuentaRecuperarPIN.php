<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
    //----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
    //----- CONTEO DE TIEMPO PARA BORRAR LA CLAVE DE VALIDACIÓN (PIN) -->
    comprobarTiempo();
?> 
    <title>RecuperarCuenta (PIN)</title>
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