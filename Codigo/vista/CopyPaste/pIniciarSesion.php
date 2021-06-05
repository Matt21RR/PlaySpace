<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
?> 
    <title>Iniciar Sesión</title>
</head>
<body class="m-0 vh-100 row justify-content-center align-items-center text-center bg-secondary text-white">
    <div class="container col-auto">
            <div class="bg-white border border-dark border-2 rounded p-5">

            <!------ TITULO (IMG) ------------------------------->
            <img src="svg/title.png" class="img-fluid mb-4 mx-auto d-block">

            <!------ FORMULARIO ------------------------------->
                <form action="cvIniciarSesion.php" method="POST">       <!----- Enviado para confirmar con la BD -->
                <!----- NOMBRE_USUARIO -->
                    <div class="input-group p-2">
                        <input type="text" class="form-control" name="NOMBRE_USUARIO" placeholder="Nombre de Usuario" required>
                    </div>
                <!----- CONTRASEÑA -->
                    <div class="input-group p-2">
                        <input type="password" class="form-control" name="CONTRASENA" placeholder="Contraseña" required>
                    </div>
                <!----- INICIAR SESION (ENVIAR) -->
                    <input type="submit" class="btn btn-success w-100 mt-3" value="Iniciar Sesión">
                </form>
            <!------ ENLACES ------------------------------->
                <!----- Link (Olvido los Datos de la Cuenta) -->
                <div class="mt-2">
                    <a href="pCuentaRecuperar.php">¿Olvidaste la contraseña?</a><br>             
                </div>
                <!----- Link (Crear Cuenta) -->
                <div class="mt-5">
                    <a href="pCuentaCrear.php">Crear Cuenta</a>            
                </div>
            </div>
    </div>
</body>
</html>