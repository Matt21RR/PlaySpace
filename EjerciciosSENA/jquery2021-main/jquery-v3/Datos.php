<?php

    class Datos
    {
        /**
         * Retorna una conexión a la base de datos.
         * @return      Conexión            Conexión a la base de datos.
         */
        static function conexion()
        {
            return mysqli_connect( "localhost", "root", "", "bd_marcianitos" );
        }
        
        /**
         * Retorna la URL del avatar.
         * @param       Texto           Una cadena a buscar para retornar el avatar
         * @return      Recordset       Un arreglo con todo lo consultado en la BD.
         */
        static function avatar( $nombre = null )
        {
            $conexion = self::conexion();
            
            $sql  = " SELECT avatar as conteo FROM tb_usuarios ";
            if( $nombre != null ) $sql .= " WHERE correo LIKE '$nombre'";
            if( $nombre != null ) $sql .= " OR nickname LIKE '$nombre'";
            //echo $sql;
            
            return $conexion->query( $sql );
        }
    }
    