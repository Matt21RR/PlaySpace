<?php
    include_once ("../controlador/cCuentaCrear.php");
    include_once ("../controlador/cUsuario.php");

    if(!isset($_SESSION))session_start();
    //SE ESRTA INTENTANDO CREAR CUENTA
    if((isset($_GET['nombre_usuario']))&&(isset($_GET['contrasena']))&&(isset($_GET['correo']))){
        $nombre_usuario = $_GET['nombre_usuario'];
        $contrasena = $_GET['contrasena'];
        $correo = $_GET['correo'];
        
        $id_foto_perfil = $_SESSION['id_foto_perfil'];
        if(is_numeric($id_foto_perfil)){
            $id_usuario = cCuentaCrear::crearCuenta($nombre_usuario,$contrasena,$correo,$id_foto_perfil);
        }else{
            $id_usuario == -1;
        }
        //SI SE PUDO CREAR LA CUENTA
        if($id_usuario > 0){
            $_SESSION['ID_USUARIO'] = $id_usuario;
            $_SESSION['NOMBRE_USUARIO'] = $nombre_usuario;
            $_SESSION['ID_FOTO_PERFIL'] = $id_foto_perfil;
            header("location: ../vista/pBusqueda.php");
        }else{//SI NO SE PUDO CREAR LA CUENTA
            header("location: ../vista/pCuentaCrear.php");
        }
    }
    //=============AJAX===========================
    //Revisar si ese nombre de usuario no se encuentra ya presente en la BD
    if(isset($_GET['nombreUsuarioBuscar'])){
        $nombreUsuarioBuscar = $_GET['nombreUsuarioBuscar'];
        $resultado =  cCuentaCrear::comprobarNickRepetido($nombreUsuarioBuscar);
        echo json_encode($resultado);
    }
    //Revisar si ese correo no se encuentra ya presente en la BD
    if(isset($_GET['correoBuscar'])){
        $nombreUsuarioBuscar = $_GET['correoBuscar'];
        $resultado = cCuentaCrear::comprobarCorreoRepetido($nombreUsuarioBuscar);
        echo json_encode($resultado);
    }
    if(isset($_GET['contrasenaComprobar'])){
        $contrasenaComprobar = $_GET['contrasenaComprobar'];
        $resultado = cUsuario::pedirDatos($contrasenaComprobar, 3);     // 3 = Evaluar contrasena
        echo json_encode($resultado);
    }
    