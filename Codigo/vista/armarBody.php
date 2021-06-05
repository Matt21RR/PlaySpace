<?php
    function startBody(){
        echo '
            <body class="m-0 vh-100 row justify-content-center align-items-center text-center bg-secondary">
                <div class="container col-auto">
                    <div class="contenedor-form bg-white border border-dark border-2 rounded p-5">
            ';
    }
    function endBody(){
        echo '
                    </div>
                </div>
            </body>
            ';
    }

    function img_titulo(){
        //------ TITULO (IMG) ------------------------------->
        echo "<img src='svg/title.png' class='img-fluid mb-4 mx-auto d-block'>";
    }

    function input_nombre_usuario(){
        echo '
            <div class="input-group p-2">
                <input type="text" class="form-control" name="NOMBRE_USUARIO" placeholder="Nombre de Usuario" required>
            </div>
            ';
    }
    function input_contrasena(){
        echo '
            <div class="input-group p-2">
                <input type="password" class="form-control" name="CONTRASENA" placeholder="Contraseña" required>
            </div>
            ';
    }
    function input_correo(){
        echo '
            <input type="email" class="form-control" name="CORREO" placeholder="Correo Electrónico" required>
            ';
    }
    function input_pin(){
        echo '
                <input type="text" name="PIN" class="form-control mb-4"
                        placeholder="PIN" pattern="[A-Z0-9]{8,8}"
                        title="Se requiere de 8 carácteres">
            ';
    }

    function input_btn_iniciar_sesion(){
        echo '
            <input type="submit" class="btn btn-success w-100 mt-3" value="Iniciar Sesión">
            ';
    }
    function input_btn_Continuar(){
        echo '
            <input type="submit" class="btn btn-success w-100 mt-3" value="Continuar">
            ';
    }
    function input_btn_EnviarOtroPIN(){
        echo '
            <input type="submit" class="btn btn-success w-100 mt-3" 
            name="enviarOtroPIN" value="Enviar otro código">
            ';
    }

    function link_OlvCuenta(){
        echo '
            <div class="mt-2">
                <a href="pCuentaRecuperar.php">¿Olvidaste la contraseña?</a><br>             
            </div>
            ';
    }
    function link_CrearCuenta(){
        echo '
            <div class="mt-5">
                <a href="pCuentaCrear.php">Crear Cuenta</a>            
            </div>
            ';
    }
?>