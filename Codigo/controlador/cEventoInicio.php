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
         */
        static function pedirListaPresentes($ID_EVENTO,$id_ingresado = -1){
            if(!isset($_SESSION))session_start();
            if($id_ingresado != -1 && $id_ingresado != ""){//Si se ha ingresado algo
                $_SESSION['coincidencia'] = 0;//Significa que no se encontro ninguna coincidencia
            }else{
                $_SESSION['coincidencia'] = -1; //Significa que no se ingreso nada para buscar
            }
            //OBTENER LA ID DEL ASISTENTE
            $inscritos = self::pedirListaInasistentes($ID_EVENTO);
            
            //VERIFICAR QUE HAY ALGUIEN INSCRITO Y QUE SE HA INGRESADO ALGUNA ID
            if (($inscritos[0] != -1) && ($id_ingresado != -1)){
                $cantInscritos = count($inscritos);
                for($posX = 0; $posX != $cantInscritos; $posX++){
                    //VERIFICAR QUE ESA ID ESTE EN LA LISTA DE PARTICIPANTES REGISTRADOS
                    if($id_ingresado == $inscritos[$posX]){
                        //REGISTRAR LA ID DEL PARTICIPANTE COMO: ASISTIO
                        mEventoInicio::actualizarAsistenciaParticipante($id_ingresado,$ID_EVENTO);
                    }
                }
                //EJECUTAR lA VISTA DE LA PAGINA PAR INTRODUCIR LAS ID
                
            }
            header("location: ../vista/vPantallasEventoInicio/pIngresarIDPresentes.php");
            
        }
    }
    if(array_key_exists('id_participante',$_GET)){
        if($_GET['id_participante'] != ""){
            cEventoInicio::pedirListaPresentes($ID_EVENTO,$_GET['id_participante']);
        }else{
            cEventoInicio::pedirListaPresentes($ID_EVENTO);
        }
    }else{
        cEventoInicio::pedirListaPresentes($ID_EVENTO);
    }