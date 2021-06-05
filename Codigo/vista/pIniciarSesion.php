<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
?> 
    <title>Iniciar Sesión</title>
</head>
    <?php
        startBody();
    //----- TITULO (IMG) -->
        img_titulo();
//------ FORMULARIO ------------------------------->
        echo '<form action="cvIniciarSesion.php" method="POST">';       //----- Enviado para confirmar con la BD -->
        //----- NOMBRE_USUARIO -->
            input_nombre_usuario();
        //----- CONTRASEÑA -->
            input_contrasena();
        //----- INICIAR SESION (ENVIAR) -->
            input_btn_iniciar_sesion();
        echo '</form>';
//------ ENLACES ------------------------------->
    //----- Link (Olvido los Datos de la Cuenta) -->
        link_OlvCuenta();
    //----- Link (Crear Cuenta) -->
        link_CrearCuenta();

        endBody();
    ?>
</html>