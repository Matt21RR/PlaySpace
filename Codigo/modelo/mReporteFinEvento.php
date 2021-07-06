<?php
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');
    /**
     * Envia la calificacion que el participante del evento le pone al evento.
     * @param   numero  id del evento a calificar
     * @param   numero  id del usuario que participo en el evento
     * @param   numero  calificacion que se le otorga al evento
     */
    function enviarCalificacionEvento($ID_EVENTO,$ID_PARTICITANTE,$CALIFICACION_EVENTO){
        $connect=conexionBaseDatos();
        $sql = "UPDATE PARTICIPARTES_EVENTO 
                SET CALIFICACION_EVENTO ='$CALIFICACION_EVENTO'
                WHERE ID_EVENTO = '$ID_EVENTO' && ID_PARTICIPANTE = '$ID_PARTICITANTE'";
        $result = $connect->query($sql);
        comprobarDatosAfectados($connect);
        echo "<script>console.log('mReporteFinEvento::enviarCalificacionEvento')</script>";
        $connect->close();
    }
    
