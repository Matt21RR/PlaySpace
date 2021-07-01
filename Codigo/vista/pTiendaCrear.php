<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrearTienda</title>
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
<!--------- TEXTO PROGRESO DE LA CREACIÓN ---------->
    <p>Progreso de creación</p>
<!--------- BARRA PROGRESO ---------->
    <!--<div class="container-progress-bar mx-auto">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" rol="progressbar"
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
        </div>
    </div>-->
    --------------------------------
<!--------- LINEA DIVISORA ---------->
    <div><hr></div>
<!--------- TEXTO GUIA DE CREACIÓN ---------->
    <p>Por favor introduzca la información básica que poseerá la tienda virtual</p>
<!--------- INGRESO DE VALORES ---------->
    <form action="../controladorVista/cvTiendaCrear.php" method="POST">

        <label>Nombre: 
            <input type="text" name="NOMBRE_TIENDA" pattern="[A-Za-z]{5,30}"
                title="Caracteres alfabéticos entre 5 y 30" placeholder="Nombre de la tienda*">
        </label>   <!--- NOMBRE_TIENDA -->

        <label>Tiempo de publicación:
            <select name="TIEMPO_TIENDA">
            <?php
                include_once('../controladorVista/cvTiendaCrear_TiempoPublicacion.php');

                if($tiempoTienda[0] == '7'){ // CON VERSIÓN GRATUITA
                    for($i=0; $i<count($tiempoTienda); $i++){
                        echo '<option value="'.$i.'">'.$tiempoTienda[$i].' días | '.$precio_tiempoTienda[$i].' '.$_SESSION['monedaLocal'].'</option>';
                    }
                }else{  // SIN VERSIÓN GRATUITA
                    for($i=0; $i<count($tiempoTienda); $i++){
                        $j = $i + 1;
                        echo '<option value="'.$j.'">'.$tiempoTienda[$i].' días | '.$precio_tiempoTienda[$i].' '.$_SESSION['monedaLocal'].'</option>';
                    }
                }
            ?>
            <select>
        </label>    <!-- TIEMPO PUBLICACIÓN -->

        <label>Teléfono:  
            <input type="tel" name="TELEFONO_TIENDA" pattern="[0-9]{5,15}"
                title="Dígito entre 5 y 15 caracteres" placeholder="Número telefónico">    
        </label>    <!--- TELEFONO_TIENDA -->

        <label>Correo:  
            <input type="email" name="CORREO_TIENDA" pattern="{15,45}"
                title="Correo válido entre 15 y 45 caracteres" placeholder="Correo electrónico">
        </label>    <!--- CORREO_TIENDA -->
        
        <label>Dirección:  
            <input type="text" name="DIRECCION_TIENDA" placeholder="Dirección de la tienda">
        </label>    <!--- DIRECCION_TIENDA -->

        <label>Descripción de la tienda: 
            <input type="text" name="DESCRIPCION_TIENDA" 
                placeholder="...">
        </label> <!--- DESCRIPCION_TIENDA -->
<!--------- LINEA DIVISORA ---------->
        <div><hr></div>
<!--------- BOTÓN CANCELAR / CONTINUAR ---------->
        <input type="submit" value="Cancelar creación" name="cancelarCreacion">
        <input type="submit" value="Continuar">
    </form>
</body>
</html>