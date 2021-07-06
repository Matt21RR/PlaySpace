<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
    //----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
?> 
    <title>RecuperarCuenta (RenovarContraseña)</title>
</head>
    <?php
        start_alertBody();
        // ALERTA
            echo '<div id="alertaPerfilEditar" style="display:none;">';
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
                <h5>Crea una contraseña nueva</h5>
                <p>Ingresa una combinación de al menos 7 letras y 3 números</p>
            </div>
            ';
    //------ FORMULARIO ------------------------------->
        echo '<form action="../controladorVista/cvCuentaRecuperarNewPass.php" method="POST">';             //----- Enviado para confirmar con la BD -->
        //----- NUEVA CONTRASEÑA (PIN) -->
            input_new_contrasena();
        //------ VALIDAR NUEVA CONTRASEÑA -->
            input_btn_Continuar();
        echo '</form>';
        end_alertBody();
    ?>
</html>