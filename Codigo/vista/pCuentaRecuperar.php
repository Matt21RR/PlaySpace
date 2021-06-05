<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
?> 
    <title>RecuperarCuenta (CORREO)</title>
</head>
    <?php
        startBody();
    //----- TITULO (IMG) -->
        img_titulo();    
    //------ PARRAFO GUIA ----------------------------->
        echo '
            <div class="my-5">
                Ingresa tu correo electrónico
            </div>
            ';
    //------ FORMULARIO ------------------------------->
        echo '<form action="cvCuentaRecuperar.php" method="POST">';             //----- Enviado para confirmar con la BD -->
        //----- CORREO ELECTRONICO -->
            input_correo();
            echo "<br>";
        //------ BUSCAR CUENTA -->
            input_btn_Continuar();
        echo '</form>';
    //------ ENLACES --------------------------------->
        //----- Link (Crear Cuenta) -->
        link_CrearCuenta();
        endBody();
    ?>
</html>