<?php

    class Visual
    {
        
        /**
         * Retorna un html que representa una galería de avatares.
         * @param       Recorset        Arreglo con resultados de una consulta a la BD.
         * @return      Texto           Html que representa una galería de imagenes.
         */
        static function dibujar_avatar( $resultado )
        {
            $salida = "";
            
            while( $fila = mysqli_fetch_array( $resultado ) )
            {
                $salida = $fila[ 0 ];
            }
            
            return $salida;
        }       
        
    }
    