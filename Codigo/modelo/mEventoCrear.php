<?php
    include_once('../mBaseDatos.php');
    include_once("../mMaster.php");
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
    function enviarInformacionEvento($ID_USUARIO,
                                    $ID_EVENTO,
                                    $TAMANO_EVENTO,
                                    $TIPO_EVENTO,
                                    $DESCRIPCION,
                                    $UBICACION_LAT,
                                    $UBICACION_LON,
                                    $FECHA_INICIO,
                                    $FECHA_FIN){
        $connect = conexionBaseDatos();
        $sql = "INSERT INTO EVENTOS (ID_USUARIO,
                                    ID_EVENTO,
                                    TAMANO_EVENTO,
                                    TIPO_EVENTO,
                                    DESCRIPCION,
                                    UBICACION_LAT,
                                    UBICACION_LON,
                                    FECHA_INICIO,
                                    FECHA_FIN)VALUES('$ID_USUARIO',
                                                    '$ID_EVENTO',
                                                    '$TAMANO_EVENTO',
                                                    '$TIPO_EVENTO',
                                                    '$DESCRIPCION',
                                                    '$UBICACION_LAT',
                                                    '$UBICACION_LON',
                                                    '$FECHA_INICIO',
                                                    '$FECHA_FIN')";
        $result = $connect -> query($sql);
        comprobarDatosAfectados($connect);
        echo "<script>console.log('mCrearEvento::enviarInformacionEvento')</script>";
        $connect->close();
    }
    enviarInformacionEvento($_GET['$ID_USUARIO'],
                            $_GET['$ID_EVENTO'],
                            $_GET['$TAMANO_EVENTO'],
                            $_GET['$TIPO_EVENTO'],
                            $_GET['$DESCRIPCION'],
                            $_GET['$UBICACION_LAT'],
                            $_GET['$UBICACION_LON'],
                            $_GET['$FECHA_INICIO'],
                            $_GET['$FECHA_FIN']);