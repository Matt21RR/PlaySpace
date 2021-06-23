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
    <div class="container">
        <div class="formBox">
            <form action="../controladorVista/cvCuentaCrear.php" method="get"> 
                <br>
                <div class="title"></div>
                <br>
                <a href="./pSeleccionarFotoPerfil.php"><img src="./png/foto_perfil/<?php
                if(!isset($_SESSION))session_start();
                if(isset($_SESSION['id_foto_perfil'])){
                    echo $_SESSION['id_foto_perfil'];
                }else{
                    echo "0";
                }
                ?>.png" style="width:80px; height:80px;"></a>
                <input placeholder="Nombre de Usuario" type="text" name='nombre_usuario' required="required">
                <input placeholder="Contraseña" type="text" name='contrasena' required="required">
                <input placeholder="Correo Electronico" type="text" name='correo' required="required">
                <br>
                <input type="checkbox" id="terminos" required="required">
                <label for="terminos">Acepto los <b>términos y condiciones de uso</b></label>
                <br>
                <input type="submit" value="Crear Cuenta">
                <br>
                <br>
                <br>
                <div class="bottomBox"><a href=#>Olvidaste los datos de tu cuenta?</a></div>
            </form>
        </div>
    </div>

</body>
</html>