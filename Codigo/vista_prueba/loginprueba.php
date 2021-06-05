<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Prueba Login</title>
</head>
<body class="m-0 vh-100 row justify-content-center align-items-center text-center bg-secondary text-white">
    <div class="container col-auto">
            <div class="bg-white border border-dark border-2 rounded p-5">
            <!----- TITULO (IMG) -->
            <img src="../vista/svg/title.png" class="img-fluid mb-4 mx-auto d-block">

            <!----- FORMULARIO -->
                <form action="#" method="POST">       <!----- LINK -->
                <!----- NOMBRE_USUARIO -->
                    <div class="input-group p-2">
                        <input type="text" class="form-control" placeholder="Nombre Usuario">
                    </div>
                <!----- CONTRASEÑA -->
                    <div class="input-group p-2">
                        <input type="password" class="form-control" placeholder="Contraseña">
                    </div>
                <!----- INICIAR SESION (ENVIAR) -->
                    <input type="submit" class="btn btn-success w-100 mt-3" value="Iniciar Sesión">
                </form>
        <!----- LINKS -->
            <!----- Link (Olvido los Datos de la Cuenta) -->
            <div class="mt-2">
                <a href="#">¿Olvidaste la contraseña?</a><br>             
            </div>
            <!----- Link (Crear Cuenta) -->
            <div class="mt-5">
                <a href="#">Crear Cuenta</a>            
            </div>
            </div>
    </div>
</body>
</html>