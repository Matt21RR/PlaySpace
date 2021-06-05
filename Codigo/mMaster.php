<?php
    /**
     * Comprueba e informa por CONSOLA si sehan realizado cambios en la
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



    class mMaster{
        /**
         * Muestra la hora y fecha del servidor
         * Para labores de busqueda de fallos
         * Desactivar si no es necesario
         * @param   texto   Zona horaria sobre la cual trabajara la funcion
         *                  Lista de zonas horarias: https://www.php.net/manual/es/timezones.php
         * @return  texto   Fecha actual en formato AAAA-MM-DD HH:MM:SS (Formato de 24 horas)
         */
        static function tiempo($zona_horaria = ''){
            // ? La ruta del archivo de javascript depende de donde se encuentre el archivo de vista donde se requiera usar
            // ! <script src="./js/timezone.js"></script>
            //TODO: Poner esto en la vista y enviar el resultado por medio del formulario de la pagina que
            //TODO: recibe la fecha como "hidden" con el nombre de "utc".
            // ! <input type="hidden" name="utc" id="utc">
            //TODO: En el archivo al cual estes enviando la informacion de la vista,
            //TODO: ejecutas esta funcion de la siguiente manera
            // ! mMaster::tiempo($_GET['utc']);
            //TODO: El $_GET es suponiendo que los parametros se han pasado usando el metodo $_GET;
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
                $time = "$ano-$mes-$dia $hora:$min:$seg";
                echo "<script>console.log('---------------------------------------')</script>";
                echo "<script>console.log('| Current time: $time |')</script>";
                echo "<script>console.log('| Current Time Zone: $zona_horaria')</script>";
                echo "<script>console.log('---------------------------------------')</script>";
                return $time;
        }

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