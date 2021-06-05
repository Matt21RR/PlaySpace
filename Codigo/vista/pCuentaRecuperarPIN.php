<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
    //----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
    //----- CONTEO DE TIEMPO PARA BORRAR LA CLAVE DE VALIDACIÓN (PIN) -->
    comprobarTiempo();
?> 
    <title>RecuperarCuenta (PIN)</title>
</head>
    <?php
        startBody();
    //----- TITULO (IMG) -->
        img_titulo();
    //------ PARRAFO GUIA ----------------------------->
        echo '
            <div class="my-5">
                Te enviamos un código para restablecer la contraseña de tu cuenta
            </div>
            ';
    //------ FORMULARIO ------------------------------->
        echo ' <form action="cvCuentaRecuperarPIN.php" method="POST">';             //----- Enviado para confirmar con la BD -->
        //----- CLAVE DE VERIFICACIÓN (PIN) -->
            input_pin();
        //------ ENVIAR OTRO PIN -->
            input_btn_EnviarOtroPIN();
        //------ VALIDAR PIN -->
            input_btn_Continuar();
        echo '</form>';
        endBody();
    ?>
</html>