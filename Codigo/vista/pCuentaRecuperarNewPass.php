<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
    //----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
?> 
    <title>RecuperarCuenta (RenovarContraseña)</title>
</head>
    <?php
        startBody();
    //----- TITULO (IMG) -->
        img_titulo();
    //------ PARRAFO GUIA ----------------------------->
        echo '
            <div class="guia-text">
                <h5>Crea una contraseña nueva</h5>
                <p>Ingresa una combinación de al menos 8 letras, números o signos de puntuación</p>
            </div>
            ';
    //------ FORMULARIO ------------------------------->
        echo '<form action="../controladorVista/cvCuentaRecuperarNewPass.php" method="POST">';             //----- Enviado para confirmar con la BD -->
        //----- NUEVA CONTRASEÑA (PIN) -->
            input_new_contrasena();
        //------ VALIDAR NUEVA CONTRASEÑA -->
            input_btn_Continuar();
        echo '</form>';
        endBody();
    ?>
</html>