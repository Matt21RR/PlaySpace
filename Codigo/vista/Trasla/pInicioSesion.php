<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style type="text/css">
      body {
        padding-top: 30px;
        padding-bottom: 40px;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="css/unlogged.css">
    <title>PlaySpace</title>
</head>
<body>
<?php
    if(!isset($_SESSION))session_start();
    if(isset($_SESSION['ID_USUARIO'])){ //si existe una sesion abierta
        if($_SESSION['ID_USUARIO']>0){
            header("location: ./pPlantilla.php");
            die;
        }
    }
?>
    <div class="container">
        <div class="formBox">
            <form action="../controladorVista/cvInicioSesion.php" method="get">
                <br>
                <div class="title"></div>
                <br>
                <input placeholder=" Nombre de Usuario" type="text" name="nombre_usuario" required="required">
                <input placeholder=" Contraseña" type="text" name="contrasena" required="required">
                <br>
                <input type="submit" value="Iniciar Sesión">
                <br>
                <a href=#>Olvidaste los datos de tu cuenta?</a>
                <br>
                <div class="bottomBox">
                    <a href="../controladorVista/cvInicioSesion.php?create=1">
                        <hr width=80%>Tambien puedes <b>crearte una cuenta</b>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>