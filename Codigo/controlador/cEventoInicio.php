<?php
    include_once ("../modelo/mEventoInicio.php");

    class cEventoInicio{
        /**
         * Obtener la lista de los participantes que no han sido marcados como ASISTIO
         * @param   numero  id del evento
         * @return  lista   lista de los participantes
         *                  -1 cuando no se encuentra ningun participante
         */
        static function pedirListaInasistentes($ID_EVENTO){
            return mEventoInicio::pedirListaParticipantesInasistentes($ID_EVENTO);
        }
        /**
         * Pedirle la lista de participantes presentes al usuario
         * @param   numero  id del evento
         * @param   numero  id del participante que es subministrada por el usuario
         * @return  numero  -1 = No hay nadie inscrito al evento |
         *                  0 = participante no encontrado en la lista | 
         *                  1 = participante con status de "asistió"
         */
        static function pedirListaPresentes($ID_EVENTO,$id_ingresado){
            //OBTENER LA ID DEL ASISTENTE
            $inscritos = self::pedirListaInasistentes($ID_EVENTO);
            
            //VERIFICAR QUE HAY ALGUIEN INSCRITO Y QUE SE HA INGRESADO ALGUNA ID
            $encontrado = $inscritos;
            if (($inscritos[0] != -1) && ($id_ingresado > 0)){
                $cantInscritos = count($inscritos);
                $encontrado = 0;
                for($posX = 0; $posX != $cantInscritos && $encontrado == 0; $posX++){
                    //VERIFICAR QUE ESA ID ESTE EN LA LISTA DE PARTICIPANTES REGISTRADOS
                    if($id_ingresado == $inscritos[$posX]){
                        //REGISTRAR LA ID DEL PARTICIPANTE COMO: ASISTIO
                        $encontrado = 1;
                        mEventoInicio::actualizarAsistenciaParticipante($id_ingresado,$ID_EVENTO);
                    }else{
                        $encontrado = 0;
                    }
                }
            }
            return $encontrado;
        }
    }