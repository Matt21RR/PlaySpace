<?php

    $salida = "";
    //$numero = $_POST[ 'numFactorial' ];
    $nombre = $_POST[ 'nombre' ];
    //echo "Tu número nuevo es ".( $numero * 1 + 1 )."  ".$nombre;
            
    $conexion = mysqli_connect( "localhost", "root", "", "bd_marcianitos" );
    $resultado = $conexion->query( "SELECT nickname as conteo FROM tb_usuarios WHERE correo LIKE '".$nombre."'" );
    
    while( $fila = mysqli_fetch_array( $resultado ) )
    {
        $salida = $fila[ 0 ];
    }
    
    echo $salida;