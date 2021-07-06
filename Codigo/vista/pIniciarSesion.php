<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
?> 
    <title>Iniciar Sesión</title>
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
//------ FORMULARIO ------------------------------->
        echo '<form action="../controladorVista/cvIniciarSesion.php" method="POST">';       //----- Enviado para confirmar con la BD -->
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

        end_alertBody();
    ?>
</html>