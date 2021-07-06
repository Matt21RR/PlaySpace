<?php
    function startBody(){
        echo '
            <body class="m-0 vh-100 row justify-content-center align-items-center text-center">
                <div class="container p-0">
                    <div class="container container-form">
            ';
    }
    function endBody(){
        echo '
                    </div>
                </div>
		    <script src="./js/timezone.js"></script>
            </body>
            ';
    }
    function start_alertBody(){
        echo '<body onload="alerta()" class="m-0 vh-100 row justify-content-center align-items-center text-center">';
            echo '<div class="container p-0">
                    <div class="container container-form">';
    }
    function end_alertBody(){
        echo '
                    </div>
                </div>
		    <script src="./js/timezone.js"></script>
		    <script src="js/perfilEditar_alertas.js"></script>
            </body>
            ';
    }

    function img_titulo(){
        //------ TITULO (IMG) ------------------------------->
        echo "<img src='svg/title.png' class='img-fluid mx-auto my-5 d-block'>";
    }

    function input_nombre_usuario(){
        echo '
                <input type="text" class="form-control" name="NOMBRE_USUARIO" placeholder="Nombre de Usuario" required>
            ';
    }
    function input_contrasena(){
        echo '
                <input type="password" class="form-control my-3" name="CONTRASENA" placeholder="Contraseña" required>
            ';
    }
    function input_new_contrasena(){
        echo '
                <input type="password" class="form-control my-3" name="NEW_CONTRASENA" placeholder="Nueva Contraseña" required>
            ';
    }


    function input_correo(){
        echo '
            <input type="email" class="form-control" name="CORREO" placeholder="Correo Electrónico" required>
            ';
    }
    function input_pin(){
        echo '
                <input type="text" name="PIN" class="form-control mb-2"
                        placeholder="PIN">
            ';
    }

    function input_btn_iniciar_sesion(){
        echo '
            <input type="submit" class="btn btn-form w-100 my-3" value="Iniciar Sesión">
            ';
    }
    function input_btn_Continuar(){
        echo '
            <input type="submit" class="btn btn-form w-100" value="Continuar">
            ';
    }
    function input_btn_EnviarOtroPIN(){
        echo '
            <input type="submit" class="btn btn-form w-100 my-3" 
            name="enviarOtroPIN" value="Enviar otro código">
            ';
    }

    function link_OlvCuenta(){
        echo '
            <div>
                <a href="pCuentaRecuperar.php">¿Olvidaste la contraseña?</a><br>             
            </div>
            ';
    }
    function link_CrearCuenta(){
        echo '
            <div class="linkCrearCuenta">
                <a href="pCuentaCrear.php">Crear Cuenta</a>            
            </div>
            ';
    }
?>