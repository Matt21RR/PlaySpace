<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();

//----- CONEXIÓN al controlador de la BD Cuenta Recuperar
    include_once('../controlador/cCuentaRecuperar.php');

//----- BUSCAR CUENTA
    $VariableObtenida = cCuentaRecuperar::buscarCuenta($_POST["CORREO"]);

//----- COMPROBACIÓN de la variable obtenida tomando encuenta si se encontro la cuenta
if( $VariableObtenida != -1 ){
    $_SESSION["ID_USUARIO"] = $VariableObtenida;
    header('Location: ../vista/pCuentaRecuperarPIN.php');          //----- CARGAR la pantalla para insertar el PIN enviado
} else{
    $_SESSION['ALERTA'] = 'No se encontro el usuario';     // -- Mensaje de alerta cuando no se encuentre un correo registrado
    header('Location: ../vista/pCuentaRecuperar.php');            //----- REGRESO a CuentaCrear ya que no se creo la cuenta
}