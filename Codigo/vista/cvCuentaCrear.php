<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

//----- CONEXIÓN al controlador de la BD Crear Cuenta
    include_once('../controlador/cCuentaCrear.php');

//----- CREACIÓN DE LA CUENTA
    $VariableObtenida = cCuentaCrear::crearCuenta($_POST["NOMBRE_USUARIO"],$_POST["CONTRASENA"],$_POST["CORREO"],$_POST["ID_FOTO_PERFIL"]);
    
//----- COMPROBACIÓN de la variable optenida tomando encuenta si se creo la cuenta
if( $VariableObtenida > 0 ){
    $_SESSION["ID_USUARIO"] = $VariableObtenida;
    header('Location: pMapa.php');          //----- CARGAR la pantalla principal (Mapa)
} else{             
    header('Location: pCuentacrear.php');            //----- REGRESO a CuentaCrear ya que no se creo la cuenta
}