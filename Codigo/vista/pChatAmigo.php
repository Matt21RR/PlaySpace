<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="./css/bootstrap.css" rel="stylesheet">
            <title>Document</title>
            <link rel="stylesheet" href="./css/amigos.css">
        </head>
        <body>
            <?php
                $titleSection = "Chat Amigo";
                include_once("./pPlantilla.php"); // EL MENU
            ?>
            <?php 
                $_SESSION['ID_AMIGO'] = $_GET['ID_AMIGO'];
            ?>
            <div class="container-fluid h-100 w-100" id="misMensajes" style="position:absolute; bottom:60px; padding-top:110px;">
                
            </div>
            <div class="cajaRecibirTexto footer">
                <input class="py-auto" type="text" name="" id="mensajeUsuario" placeholder="Mensaje...">
                <div class="botonEnviarMensaje" onclick="enviarMensaje()">
                </div>
            </div>
            <script src="./js/chatAmigo.js"></script>
        </body>