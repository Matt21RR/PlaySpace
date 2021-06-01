<?php
    include_once ("../modelo/mReporteParticipante.php");
    class cReporteParticipante{
        /**
         * Incrementa (+1) la cantidad de malos comportamientos cometidos por un participante en un evento
         * @param   numero  id del participante
         * @param   numero  id del evento donde esta inscrito el participante
         */
        static function comportamientoUsuario($id_participante,$id_evento){
            $cantMal = mReporteParticipante::pedirCantidadMalosComportamientos($id_participante,$id_evento);
            echo ($cantMal);
            $cantMal++;
            mReporteParticipante::actualizarCantidadMalosComportamientos($id_participante,$id_evento,$cantMal);
            echo "<script>console.log('cReporteParticipante::comportamientoUsuario -> ".$id_usuario." - ".$cantMal."')</script>";
        }

        static function expulsarParticipante($id_participante,$id_evento){
            // TODO: Revisar la contidad de malos comportamientos
            mReporteParticipante::actualizarListaExpulsados($id_participante,$id_evento);
            mReporteParticipante::removerParticipante($id_participante,$id_evento);
            // todo: en caso de que sea el creador el evento toca eliminar el evento tambien o impedir que este se pueda expulsar

        }
    
    }