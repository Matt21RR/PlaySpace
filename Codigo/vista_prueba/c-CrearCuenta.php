<?php
    include_once('../controlador/cCuentaCrear.php');  //Se conecta al controlador que valida y sube la información a la BD

    $correoIngresado = $_POST["correo"];
    $nickIngresado = $_POST["usuario"];
    $contrasenaIngresada = $_POST["contrasena"];
    $fotoPerfilIngresada = $_POST["ID_foto"];

    cCuentaCrear::crearCuenta($correoIngresado, $nickIngresado, $contrasenaIngresada, $fotoPerfilIngresada);

    