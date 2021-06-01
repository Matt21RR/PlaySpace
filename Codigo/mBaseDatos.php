<?php
    /**
     * Proporciona la configuracion para conectarse a la base de datos.
     * @return  lista  La configuracion para conectarse a la base de datos.
     */
    function conexionBaseDatos(){
        echo "<script>console.log('mBaseDatos::conexionBaseDatos')</script>";
        return (mysqli_connect("localhost","root","","playspace_web"));// Ruta|Nombre de usuario|Contraseña|Base de datos
    }