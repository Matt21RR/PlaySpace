<?php
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');
    /**
     * Consulta la lista de participantes inscritos en un evento
     * @param   numero  id del evento
     * @return  lista   lista de las id de los participantes
     */
    function pedirListaParticipantes($ID_EVENTO){
        $connect=conexionBaseDatos();
        $sql="select ID_PARTICIPANTE from PARTICIPANTES_EVENTO where ID_EVENTO = '$ID_EVENTO'";
        $result = $connect->query($sql);
        $posicion = 0;
        while ($fila = mysqli_fetch_assoc($result)){
            $lista_participantes[$posicion] = $fila ['ID_EVENTO'];
            $posicion++;
        }
        echo "<script>console.log('mInicioEvento::pedirListaParticipantes-> Cantidad de participantes: $posicion')</script>";
        $connect->close();
        return $lista_participantes;
    }
    /**
     * Esta funcion actualiza la cantidad de veces que una persona ha participado en eventos.
     * @param   numero  id del usuario que participo en el evento.
     */
    function actualizarAsistenciaParticipantes($ID_USUARIO,$ID_EVENTO){
        $connect = conexionBaseDatos();
        $sql = "UPDATE PARTICIPANTES_EVENTO 
                SET ASISTIO = 1 
                WHERE ID_EVENTO='$ID_EVENTO' AND ID_PARTICIPANTE='$ID_USUARIO'";
        $result = $connect->query($sql);
        comprobarDatosAfectados($connect);
        echo "<script>console.log('mInicioEvento::actualizarAsistenciaParticipantes')</script>";
        $connect->close();
    }



    