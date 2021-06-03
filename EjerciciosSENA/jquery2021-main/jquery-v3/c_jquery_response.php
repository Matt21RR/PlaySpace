<?php

    include( "Datos.php" );
    include( "Visual.php" );
    
    $nombre = "";        
    $salida = "";
    //$numero = $_POST[ 'numFactorial' ]; 
        
    if( isset( $_POST[ 'nombre' ] ) ) $nombre = $_POST[ 'nombre' ];
    if( isset( $_GET[ 'nombre' ] ) ) $nombre = $_GET[ 'nombre' ];
    
    $resultado = Datos::avatar( $nombre );
    $salida = Visual::dibujar_avatar( $resultado );

    echo $salida;