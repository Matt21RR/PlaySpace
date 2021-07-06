<?php
    /**
     * Comprueba e informa por CONSOLA si sehan realizado cambios en la
     * base de datos cuando se intenta modificar o agregar informacion
     * en la misma.
     * @param   objeto  el objeto que se empleo para hacer la conexion
     *                  con la base de datos.
     * @return  numero  1 = cambios exitosos | 0 = Error al realizar cambios
     */
    function comprobarDatosAfectados($connect){
        if($connect->affected_rows>0)
        {
            echo "<script>console.warn('mMaster::comprobarDatosAfectados->Cambios guardados. ;D')</script>";
            $cambiosExitosos = 1;
        }else{
            echo "<script>console.error('mMaster::comprobarDatosAfectados->Error al guardar cambios. D:')</script>";
            $cambiosExitosos = 0;
        }
        return $cambiosExitosos;
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
                if(!isset($_SESSION))session_start();
                if($zona_horaria == ''){
                    date_default_timezone_set($_SESSION['zonaHoraria']);
                    $zona_horaria = $_SESSION['zonaHoraria'];
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
         * Configurar la zona horaria
         * @param   texto   Zona horaria
         */
        static function configurarZonaHoraria($zona_horaria){
            $_SESSION['zonaHoraria'] = $zona_horaria;
            
            echo "<script>console.log('Zona horaria de la sesion configurada en ".$_SESSION['zonaHoraria']."')</script>";
        }
        /**
         * Transforma una fecha a el formato ej. (4 de Octubre - 5:18PM).
         * @param   texto   Fecha en formato ('Y-m-d H:i').
         * @return  texto   Fecha en formato nuevo.
         */
        static function tiempoTexto($date){
            $arrayDate = (date_parse($date));
            switch ($arrayDate['month']) {
                case 1:
                    $month = "Enero";
                    break;
                case 2:
                    $month = "Febrero";
                    break;
                case 3:
                    $month = "Marzo";
                    break;
                case 4:
                    $month = "Abril";
                    break;
                case 5:
                    $month = "Mayo";
                    break;
                case 6:
                    $month = "Junio";
                    break;
                case 7:
                    $month = "Julio";
                    break;
                case 8:
                    $month = "Agosto";
                    break;
                case 9:
                    $month = "Septiembre";
                    break;
                case 10:
                    $month = "Octubre";
                    break;
                case 11:
                    $month = "Noviembre";
                    break;
                case 12:
                    $month = "Diciembre";
                    break;
            }
            $dia = date_create($date)->format('d');
            $ampm = date_create($date)->format('A');
            $hora12 = date_create($date)->format('g');
            $minuto = date_create($date)->format('i');
            $fechaNew = "".$dia." de ".$month." - ".$hora12.":".$minuto." ".$ampm."";
            echo "<script>console.warn(' ".$fechaNew." ')</script>";
            return $fechaNew;
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
    