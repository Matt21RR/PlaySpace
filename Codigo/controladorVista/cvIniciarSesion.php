<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

//----- CONEXIÓN al controlador de la BD Iniciar Sesión 
    include_once('../controlador/cInicioSesion.php');

//----- OPTENCIÓN de los parametros (NOMBRE_USUARIO / CONTRASENA)
//----- BUSQUEDA de la cuenta
    $VariableObtenida = cInicioSesion::buscarCuenta($_POST["NOMBRE_USUARIO"],$_POST["CONTRASENA"]);
    
//----- COMPROBACIÓN de la variable optenida tomando encuenta si se encontro una cuenta    
    session_unset();    // Eliminar toda la información obtenida almacenada
    if( $VariableObtenida > 0 ){
        $_SESSION["ID_USUARIO"] = $VariableObtenida;
        header('Location: ../vista/pMapa.php');          //----- CARGAR la pantalla principal (Mapa)
    } else{             
        header('Location: ../vista/pIniciarSesion.php');            //----- REGRESO a IniciarSesion ya que no se inicio sesión
    }