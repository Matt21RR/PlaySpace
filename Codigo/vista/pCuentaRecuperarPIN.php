<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
    //----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
    //----- CONTEO DE TIEMPO PARA BORRAR LA CLAVE DE VALIDACIÓN (PIN) -->
    comprobarTiempo($_SESSION['ID_USUARIO']);
?> 
    <title>RecuperarCuenta (PIN)</title>
</head>
    <?php
        start_alertBody();
        // ALERTA
            echo '<div id="alertaPerfilEditar" style="display:none;">';
            if(isset($_SESSION['TIEMPO_LIMITE'])){  // ALERTA - TIEMPO SUPERADO
                $_SESSION['ALERTA'] = 'TIEMPO DE ESPERA SUPERADO -- pulsa el botón "Enviar otro código" para obtener un nuevo PIN';     // -- Mensaje de alerta -- TIEMPO LIMITE SUPERADO
                $_SESSION['TIEMPO_LIMITE'] = null; 
            }
            if(isset($_SESSION['ALERTA'])){ // ASIGNACIÓN DE LA ALERTA
                $alerta = $_SESSION['ALERTA'];
                $_SESSION['ALERTA'] = null; 
            }
            if(isset($alerta)){
                echo $alerta;   
            }
            echo '</div>';
    //----- TITULO (IMG) -->
        img_titulo();
    //------ PARRAFO GUIA ----------------------------->
        echo '
            <div class="guia-text">
                <p>Te enviamos un código para restablecer la contraseña de tu cuenta</p>
            </div>
            ';
    //------ FORMULARIO ------------------------------->
        echo ' <form action="../controladorVista/cvCuentaRecuperarPIN.php" method="POST">';             //----- Enviado para confirmar con la BD -->
        //----- CLAVE DE VERIFICACIÓN (PIN) -->
            input_pin();
        //------ ENVIAR OTRO PIN -->
            input_btn_EnviarOtroPIN();
        //------ VALIDAR PIN -->
            input_btn_Continuar();
        echo '</form>';
        end_alertBody();
    ?>
</html>