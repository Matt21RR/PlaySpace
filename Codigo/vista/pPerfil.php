<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
<!----- BARRA DE NAVEGACIÓN (MENU) ----->
    <?php
        $titleSection = "Perfil";   // Titulo en el menú
        include_once('./pPlantilla.php');
        echo '<br><br>';    // Espaciado temporal
        
// -- OBTENER INFO_USUARIO -->}
        if(!isset($_SESSION['INFO_USUARIO'])){
            include_once('../controladorVista/cvPerfil.php');   // INFO_USUARIO
        } else if(isset($_GET['COPY'])){
            $_SESSION['INFO_USUARIO'] = $_SESSION['COPIA_SEGURIDAD_INFO_USUARIO'];
        }
    ?>
<!-- IMG_USUARIO-->
    <img <?php echo "src='png/foto_perfil/".$_SESSION['INFO_USUARIO'][9].".png'"; ?> alt="No se encontro una imagen" width ="100px">
<!-- NOMBRE_USUARIO -->
    <div>
        <p><?php echo $_SESSION['INFO_USUARIO'][0]; ?></p>
<!-- ID_USUARIO -->
        <p>ID - <?php echo $_SESSION['ID_USUARIO']; ?></p>
    </div>
<!-- BOTON EDITAR_PERFIL -->
    <a href="pPerfilEditar.php">Editar Perfil</a>
<!-- LINEA DIVISORA -->
    <hr>
<!-- PARTICIPACIONES -->
    <ul>Participaciones
        <li>
            Calificación: <?php echo $_SESSION['INFO_USUARIO'][3]; ?>
            <!-- <img src="png/menuIcons/estrella.png" alt="No se encontro el icono"> -->
        </li>
        <li>Asistencias: <?php echo $_SESSION['INFO_USUARIO'][4]; ?></li>
        <li>Inasistencias: <?php echo '###' ?></li>
    </ul>
    
<!-- LINEA DIVISORA -->
    <hr>
<!-- EVENTOS CREADOS -->
    <ul>Tus eventos
        <li>
            Calificación: <?php echo $_SESSION['INFO_USUARIO'][5]; ?>
            <!-- <img src="png/menuIcons/estrella.png" alt="No se encontro el icono"> -->
        </li>
        <li>Eventos realizados: <?php echo $_SESSION['INFO_USUARIO'][6]; ?></li>
    </ul>
</body>
</html>