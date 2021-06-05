<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
//----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
?> 
    <title>Mapa</title>
</head>
<body>
    <h1>MAPA</h1>
<!----- DESTRUIR SESSION PRUEBAS PERRONAS -->
    <?php if(session_destroy()) echo "Al actualizar sera redirigido a IniciarSesion"; ?>
</body>
</html>