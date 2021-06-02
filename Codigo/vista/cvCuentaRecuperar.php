<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

//----- CONEXIÓN al controlador de la BD Cuenta Recuperar
    include_once('../controlador/cCuentaRecuperar.php');

//----- BUSCAR CUENTA
    $VariableObtenida = cCuentaRecuperar::buscarCuenta($_POST["CORREO"]);

//----- COMPROBACIÓN de la variable obtenida tomando encuenta si se encontro la cuenta
if( $VariableObtenida > 0 ){
    $_SESSION["ID_USUARIO"] = $VariableObtenida;
    header('Location: pCuentaRecuperarPIN.php');          //----- CARGAR la pantalla para insertar el PIN enviado
} else{             
    header('Location: pCuentaRecuperar.php');            //----- REGRESO a CuentaCrear ya que no se creo la cuenta
}