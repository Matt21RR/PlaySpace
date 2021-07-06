<?php
    include_once('../controlador/cPerfil.php');

    /*
    * lista   Información basica del usuario
    *                      [0] = NOMBRE_USUARIO
    *                      [1] = CONTRASENA
    *                      [2] = CORREO
    *                      [3] = CALIFICACION_USUARIO
    *                      [4] = PARTICIPACIONES
    *                      [5] = CALIFICACION_EVENTOS
    *                      [6] = EVENTOS_REALIZADOS
    *                      [7] = FECHA_CLAVE_VERIFICACION
    *                      [8] = TIENDA_PRUEBA
    *                      [9] = ID_FOTO_PERFIL
    */
    $_SESSION['INFO_USUARIO'] = cPerfil::consultarPerfil($_SESSION['ID_USUARIO']);
    $_SESSION['COPIA_SEGURIDAD_INFO_USUARIO'] = $_SESSION['INFO_USUARIO'];