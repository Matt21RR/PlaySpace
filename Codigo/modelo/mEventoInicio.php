<?php
    //By Matt21RR
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');
    class mEventoInicio{
        /**
         * Consulta la lista de participantes inscritos en un evento
         * @param   numero  id del evento
         * @return  lista   lista de las id de los participantes
         *                  -1 en la primer posicion si no se encuentra ningun participante en el evento
         */
        static function pedirListaParticipantes($ID_EVENTO){
            $lista_participantes[0] = -1;
            $connect=conexionBaseDatos();
            $sql="SELECT ID_PARTICIPANTE from PARTICIPANTES_EVENTO where ID_EVENTO = '$ID_EVENTO'";
            $result = $connect->query($sql);
            $posicion = 0;
            while ($fila = mysqli_fetch_assoc($result)){
                $lista_participantes[$posicion] = $fila ['ID_PARTICIPANTE'];
                $posicion++;
            }
            echo "<script>console.log('mInicioEvento::pedirListaParticipantes-> Cantidad de participantes: $posicion')</script>";
            $connect->close();
            return $lista_participantes;
        }
        /**
         * Consulta la lista de participantes inscritos en un evento que aun no estan presentes
         * @param   numero  id del evento
         * @return  lista   lista de las id de los participantes
         */
        static function pedirListaParticipantesInasistentes($ID_EVENTO){
            $lista_participantes[0] = -1;
            $connect = conexionBaseDatos();
            $sql = "SELECT ID_PARTICIPANTE 
                    FROM PARTICIPANTES_EVENTO
                    WHERE ID_EVENTO = '$ID_EVENTO' AND
                    ASISTIO = 0";
            $result = $connect->query($sql);
            $posicion = 0;
            while($fila = mysqli_fetch_assoc($result)){
                $lista_participantes[$posicion] = $fila ['ID_PARTICIPANTE'];
                $posicion++;
            }
            echo "<script>console.log('mInicioEvento::pedirListaParticipantesInasistentes-> Cantidad de participantes: $posicion')</script>";
            $connect->close();
            return $lista_participantes;
        }
        /**
         * Esta funcion actualiza la asistencia del usuario participante que asistio a un evento.
         * @param   numero  id del usuario que participo en el evento.
         */
        static function actualizarAsistenciaParticipante($ID_USUARIO,$ID_EVENTO){
            $connect = conexionBaseDatos();
            $sql = "UPDATE PARTICIPANTES_EVENTO 
                    SET ASISTIO = 1 
                    WHERE ID_EVENTO='$ID_EVENTO' AND ID_PARTICIPANTE='$ID_USUARIO'";
            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mInicioEvento::actualizarAsistenciaParticipantes')</script>";
            $connect->close();
        }
    }
   



    