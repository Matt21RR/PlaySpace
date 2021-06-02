<?php
    include_once('../mBaseDatos.php');
    include_once("../mMaster.php");
    
    class mEventoCrear{
        /**
         * Se agrega la informacion ingresada por el usuario a la base de datos.
         * @param   numero  id del creador del evento
         * @param   numero  id del evento
         * @param   numero  cantidad de personas que participaran en el evento
         * @param   numero  tipo de evento
         * @param   texto   descripcion del evento
         * @param   numero  valor de la ubicacion en latitud del evento
         * @param   numero  valor de la ubicacion en longitud del evento
         * @param   datetime    fecha de inicio del evento
         * @param   datetime    fecha de fin del evento
         */
        static function enviarInformacionEvento($ID_USUARIO,
                                        $ID_EVENTO,
                                        $TAMANO_EVENTO,
                                        $CANTIDAD_PARTICIPANTES,
                                        $TIPO_EVENTO,
                                        $DESCRIPCION,
                                        $UBICACION_LAT,
                                        $UBICACION_LON,
                                        $FECHA_INICIO,
                                        $FECHA_FIN,
                                        $CHAT){
            $connect = conexionBaseDatos();
            $sql = "INSERT INTO EVENTOS (ID_USUARIO,
                                        ID_EVENTO,
                                        TAMANO_EVENTO,
                                        CANTIDAD_PARTICIPANTES,
                                        TIPO_EVENTO,
                                        DESCRIPCION,
                                        UBICACION_LAT,
                                        UBICACION_LON,
                                        FECHA_INICIO,
                                        FECHA_FIN,
                                        CHAT)VALUES('$ID_USUARIO',
                                                        '$ID_EVENTO',
                                                        '$TAMANO_EVENTO',
                                                        '$CANTIDAD_PARTICIPANTES',
                                                        '$TIPO_EVENTO',
                                                        '$DESCRIPCION',
                                                        '$UBICACION_LAT',
                                                        '$UBICACION_LON',
                                                        '$FECHA_INICIO',
                                                        '$FECHA_FIN',
                                                        '$CHAT')";
            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mCrearEvento::enviarInformacionEvento')</script>";
            $connect->close();
        }
    }
    