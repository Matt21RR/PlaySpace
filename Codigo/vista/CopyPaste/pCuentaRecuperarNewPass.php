<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
    //----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
?> 
    <title>RecuperarCuenta (RenovarContraseña)</title>
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