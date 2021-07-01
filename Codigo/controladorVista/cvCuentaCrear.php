<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

//----- CONEXIÓN al controlador de la BD Crear Cuenta
    include_once('../controlador/cCuentaCrear.php');

//----- CREACIÓN DE LA CUENTA
    $VariableObtenida = cCuentaCrear::crearCuenta($_POST["NOMBRE_USUARIO"],$_POST["CONTRASENA"],$_POST["CORREO"],$_POST["ID_FOTO_PERFIL"]);
    
//----- COMPROBACIÓN de la variable optenida tomando encuenta si se creo la cuenta
    session_unset();    // Eliminar toda la información obtenida almacenada
    if( $VariableObtenida > 0 ){
        $_SESSION["ID_USUARIO"] = $VariableObtenida;
        header('Location: ../vista/pMapa.php');          //----- CARGAR la pantalla principal (Mapa)
    } else{             
        header('Location: ../vista/pCuentacrear.php');            //----- REGRESO a CuentaCrear ya que no se creo la cuenta
    }