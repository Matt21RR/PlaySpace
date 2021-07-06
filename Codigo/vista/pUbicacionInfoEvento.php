<head>
    <link rel="stylesheet" href="./css/map.css">
</head>
<body>
    <a href="./pInformacionEvento.php"><!--Boton para salir del mapa de localizacion del evento-->
        <div class="navbar navbar-fixed-top" style="position:fixed; top:0; z-index:1;">
            <div class="navbar-inner">
                <ul class="nav">
                    <img src="./png/menuIcons/Equis.svg" class="menuico" style="padding-left:10px; margin:2px; margin-left:2px;">
                    <div class="mainTitle">Volver</div>
                </ul>
            </div>
        </div>
    </a>
    <?php include_once("./pMapa.php"); ?>
</body>
