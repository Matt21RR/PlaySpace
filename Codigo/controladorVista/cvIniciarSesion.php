<?php
//----- SESSION_START (¡¡NO MOVER DE AQUÍ!!)
    session_start();
    include_once ("../controlador/cPerfil.php");
    include_once ("../controladorVista/cvTiendaCrear_ObtenerMoneda.php");
//-------OBTENER LA ZONA HORARIA-----
if(isset($_REQUEST['zonaHoraria'])){
    include_once("../mMaster.php");
    //$_SESSION['ERROR']=11;
    mMaster::configurarZonaHoraria($_REQUEST['zonaHoraria']);
    die;
}

//----- CONEXIÓN al controlador de la BD Iniciar Sesión 
    include_once('../controlador/cInicioSesion.php');

//----- OPTENCIÓN de los parametros (NOMBRE_USUARIO / CONTRASENA)
//----- BUSQUEDA de la cuenta
    $VariableObtenida = cInicioSesion::buscarCuenta($_POST["NOMBRE_USUARIO"],$_POST["CONTRASENA"]);
    
//----- COMPROBACIÓN de la variable optenida tomando encuenta si se encontro una cuenta    
    session_unset();    // Eliminar toda la información obtenida almacenada
    if( $VariableObtenida > 0 ){
        $_SESSION["ID_USUARIO"] = $VariableObtenida;
        $_SESSION['CONTRASENA'] = $_POST["CONTRASENA"];
        $info_usuario = cPerfil::consultarPerfil($_SESSION['ID_USUARIO']);
        $_SESSION['NOMBRE_USUARIO'] = $info_usuario[0];
        $_SESSION['ID_FOTO_PERFIL'] = $info_usuario[9];
        header('Location: ../vista/pBusqueda.php');          //----- CARGAR la pantalla principal (Mapa)
    } else{
        $_SESSION['ALERTA'] = 'No se encontro la cuenta';        // ALERTA - Error al iniciar sesión
        header('Location: ../vista/pIniciarSesion.php');            //----- REGRESO a IniciarSesion ya que no se inicio sesión
    }