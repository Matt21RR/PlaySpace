<script src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="./css/bootstrap.css">
            <link rel="stylesheet" href="./css/style.css">
        </head>
        <body onLoad=localize(<?php if(isset($_GET['text']))echo $_GET['text'];?>)><!--Codigo para mostrar las ubis en el mapa-->
            <div id="map"></div>
            <script src="./js/ubicacion.js"></script>
        </body>
    </html>