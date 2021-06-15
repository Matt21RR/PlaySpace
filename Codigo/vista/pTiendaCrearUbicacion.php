<?php 
    include_once('encabezadoHTML.php');   //----- ENCABEZADO HTML
//----- COMPROBACIÓN SESSION["ID_USUARIO"] -->
    comprobarSesiones();
?> 
    <title>CrearTiendaUbicacion</title>
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
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>
        </div>
    </div>
<!----- IR A pCrearTiendaProductos -->
    <h1>UBICACION</h1>
    <form action="pTiendaCrearTipo.php">
        <input type="submit" value="SELECCIONAR TIPO TIENDA">
    </form>
</body>
</html>