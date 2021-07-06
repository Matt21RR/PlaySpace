<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="css/normalize.css">
    <?php
        session_start();
    ?>
</head>
<body onload="alerta()">
<!-- ALERTAS -->
    <?php
        echo '<div id="alertaPerfilEditar" style="display:none;">';
        if(isset($_SESSION['ALERTA'])){
            $alerta = $_SESSION['ALERTA'];
            $_SESSION['ALERTA'] = null; 
        }
        if(isset($alerta)){
            echo $alerta;   
        }
        echo '</div>';
    ?>
<!----- BARRA DE NAVEGACIÓN (MENU) ----->
    <?php
        $titleSection = "Perfil";   // Titulo en el menú
        include_once('./pPlantilla.php');
        echo '<br><br>';    // Espaciado temporal
    ?>
<!-- FORM EDITAR_PERFIL -->
    <form action="../controladorVista/cvPerfilEditar.php" method="post" autocomplete="off">
    <!-- IMG_USUARIO -->
        <select name="ID_FOTO_PERFIL">
            <?php
                for($i=0; $i<=11; $i++){
                    if($_SESSION['INFO_USUARIO'][9] == $i){
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    } else{
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                }
            ?>
        </select>
    <!-- BORRAR CUENTA -->
        <a href="../controladorVista/cvPerfilEditar.php?DELETE_USUARIO=1">
            <img src="png/menuIcons/eliminar.png" alt="No se encontro el icono">
        </a>
    <!-- LINEA_DIVISORA -->
        <hr>
    <!-- NOMBRE_USUARIO -->
        <label>Nombre de usuario
            <input type="text" name="NOMBRE_USUARIO" <?php echo 'value="'.$_SESSION['INFO_USUARIO'][0].'"'; ?>>
        </label>
    <!-- CORREO_USUARIO -->
        <label>Correo Electrónico
            <input type="email" name="CORREO_USUARIO" <?php echo 'value="'.$_SESSION['INFO_USUARIO'][2].'"'; ?>>
        </label>
    <!-- CONTRASEÑA_USUARIO -->
        <label>Contraseña
            <input type="password" name="CONTRASENA_USUARIO">
        </label>
    <!-- LINEA_DIVISORA -->
        <hr>
    <!-- BOTONES CANCELAR / APLICAR CAMBIOS -->
        <a href="pPerfil.php?COPY=1">Cancelar</a>
        <input type="submit" value="Aplicar Cambios">
    </form>
    <script src="js/perfilEditar_alertas.js"></script>
</body>
</html>