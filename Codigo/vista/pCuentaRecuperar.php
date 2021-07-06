<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
?> 
    <title>RecuperarCuenta (CORREO)</title>
</head>
    <?php
        start_alertBody();
    // ALERTA
        echo '<div id="alertaPerfilEditar" style="display:none;">';
        if(isset($_SESSION['ALERTA'])){
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
                <p>Ingresa tu correo electrónico</p>
            </div>
            ';
    //------ FORMULARIO ------------------------------->
        echo '<form action="../controladorVista/cvCuentaRecuperar.php" method="POST">';             //----- Enviado para confirmar con la BD -->
        //----- CORREO ELECTRONICO -->
            input_correo();
            echo "<br>";
        //------ BUSCAR CUENTA -->
            input_btn_Continuar();
        echo '</form>';
    //------ ENLACES --------------------------------->
        //----- Link (Crear Cuenta) -->
        link_CrearCuenta();
        end_alertBody();
    ?>
</html>