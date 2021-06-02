<?php
    /**
     * Comprueba e informa por CONSOLA si se han realizado cambios en la
     * base de datos cuando se intenta modificar o agregar informacion
     * en la misma.
     * @param   objeto  el objeto que se empleo para hacer la conexion
     *                  con la base de datos.
     */
    function comprobarDatosAfectados($connect){
        if($connect->affected_rows>0)
        {
            echo "<script>console.warn('mMaster::comprobarDatosAfectados->Cambios guardados. ;D')</script>";
        }else{
            echo "<script>console.error('mMaster::comprobarDatosAfectados->Error al guardar cambios. D:')</script>";
        }
    }
    /**
     * Muestra la hora y fecha del servidor
     * Para labores de busqueda de fallos
     * Desactivar si no es necesario
     * @param   texto   Zona horaria sobre la cual trabajara la funcion
     *                  Lista de zonas horarias: https://www.php.net/manual/es/timezones.php
     */
    function tiempo($zona_horaria = ''){
        //$zona_horaria = 'America/Bogota'
        if($usar==1){
            if($zona_horaria == ''){
                $zona_horaria = date_default_timezone_get();
            }else{
                date_default_timezone_set($zona_horaria);
            }
            $ano = date("Y");
            $mes = date("m");
            $dia = date("d");
            
            $hora = date("H");
            $min = date("i");
            $seg = date("s");
            $time = "$ano/$mes/$dia - $hora:$min:$seg";
            echo "<script>console.log('---------------------------------------')</script>";
            echo "<script>console.log('| Current time: $time |')</script>";
            echo "<script>console.log('| Current Time Zone: $zona_horaria')</script>";
            echo "<script>console.log('---------------------------------------')</script>";
        }   
    }

    class mMaster{
        /**
         * Convertidor de fecha con año-mes-día hora:minuto:segundo a año-mes-día
         * @param   texto   fecha de entrada
         * @return  texto   fecha convertida a Y-m-d
         */
        static function convertirTiempo($fecha){
            $diccionarioFecha = date_parse($fecha);
            $fechaObtenida = $diccionarioFecha['year']."-".$diccionarioFecha['month']."-".$diccionarioFecha['day'];
            return $fechaObtenida;
        }
    }
