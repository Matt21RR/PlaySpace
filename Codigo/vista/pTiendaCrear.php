<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
//----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
?> 
    <title>CrearTienda</title>
</head>
<body class="justify-content-center align-items-center text-center">
<!----- CONTENEDOR MENU -->
    <div class="container-menu w-100"></div>
<!----- Texto PROGRESO -->
    <div class="guia-text my-3">
        <p>Progreso</p>
    </div>
<!----- BARRA PROGRESO -->
    <div class="container-progress-bar mx-auto">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" rol="progressbar"
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
        </div>
    </div>
<!----- LINEA DIVISORA -->
    <div class="linea-divisora mx-auto my-3"></div>
<!----- TEXTO GUIA -->
    <div class="guia-text-crear-tienda mx-auto">
        <p>Introduzca la información basica de la tienda</p>
    </div>
<!----- FORM CREAR TIENDA -->
    <form action="../controladorVista/cvTiendaCrear.php" method="post">
        <input type="text" name="NOMBRE_TIENDA" placeholder="Nombre Tienda*" required>
        
        <input type="text" name="TELEFONO_TIENDA" placeholder="Telefono Tienda">
        <input type="text" name="CORREO_TIENDA" placeholder="Correo Tienda">
        <input type="text" name="DESCRIPCION_TIENDA" placeholder="Descripción">

<!----- LINEA DIVISORA -->
<div class="linea-divisora mx-auto my-3"></div>

        <input type="submit" value="Cancelar" name="cancelar">
        <input type="submit" value="Continuar" name="continuar">
    </form>
</body>
</html>