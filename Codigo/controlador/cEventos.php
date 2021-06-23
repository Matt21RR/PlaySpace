<?php
include_once("../modelo/mEventos.php");
class cEventos{
    /**
     * Consulta la lista de eventos a los cuales esta inscrito
     * @param   numero  id del usuario
     * @return  lista   lista con la informacion basica de los eventos a los cuales es esta inscrito
     *                  -1 en la posicion [0][0] si no se encontró nada
     */
    static function consultarEventosInscritos($ID_USUARIO){
        $id_eventos = mEventos::pedirIDEventosInscrito($ID_USUARIO);
        if($id_eventos[0]!=-1){//si hay algun evento
            for($posX = 0; $posX != count($id_eventos); $posX++){
                $resultado = cEventos::consultarInfoBasicaEvento($id_eventos[$posX]);
                $info_basic_eventos[$posX][0] = $resultado[0];//ID_EVENTO
                $info_basic_eventos[$posX][1] = $resultado[1];//TIPO_EVENTO
                $info_basic_eventos[$posX][2] = $resultado[2];//# INSCRITOS
                $info_basic_eventos[$posX][3] = $resultado[3];//# SLOTS_PARTICIPANTES
                $info_basic_eventos[$posX][4] = $resultado[4];//FECHA_INICIO
                $info_basic_eventos[$posX][5] = $resultado[5];//TAMAÑO_EVENTO
            }
        }else{
            $info_basic_eventos[0][0] = -1;
        }
        return $info_basic_eventos;
    }
    /**
     * Consulta la lista de los eventos que ha creado
     * @param   numero  id del usuario
     * @return  lista   lista con la informacion basica de los eventos a los cuales es esta inscrito
     *                  -1 en la posicion [0][0] si no se encontró nada
     */
    static function consultarEventosCreados($ID_USUARIO){
        $id_eventos = mEventos::pedirIDEventosCreador($ID_USUARIO);
        if($id_eventos[0]!=-1){
            for($posX = 0; $posX != count($id_eventos); $posX++){
                $resultado=cEventos::consultarInfoBasicaEvento($id_eventos[$posX]);
                //TODO: En caso de que el evento no tenga participantes $resultado[0] == -1
                //TODO: Realizar la busqueda de la info con pedirInformacionEventos();
                //TODO: Para prevenir un fallo relacionado con "sin participantes"
                if($resultado[0] != -1){
                    $info_basic_eventos[$posX][0] = $resultado[0];//ID_EVENTO
                    $info_basic_eventos[$posX][1] = $resultado[1];//TIPO_EVENTO
                    $info_basic_eventos[$posX][2] = $resultado[2];//# INSCRITOS
                    $info_basic_eventos[$posX][3] = $resultado[3];//# SLOTS_PARTICIPANTES
                    $info_basic_eventos[$posX][4] = $resultado[4];//FECHA_INICIO
                    $info_basic_eventos[$posX][5] = $resultado[5];//TAMAÑO_EVENTO
                }else{
                    $resultado=mEventos::pedirInformacionEventos($id_eventos[$posX]);

                    $info_basic_eventos[$posX][0] = $id_eventos[$posX];//ID_EVENTO
                    $info_basic_eventos[$posX][1] = $resultado[3];//TIPO_EVENTO
                    $info_basic_eventos[$posX][2] = 0;//# INSCRITOS
                    $info_basic_eventos[$posX][3] = $resultado[2];//# SLOTS_PARTICIPANTES
                    $info_basic_eventos[$posX][4] = $resultado[7];//FECHA_INICIO
                    $info_basic_eventos[$posX][5] = $resultado[1];//TAMAÑO_EVENTO
                }
            }
        }else{
            $info_basic_eventos[0][0] = -1;
        }
        return $info_basic_eventos;
    }
    /**
     * Consultar la informacion de un evento especifico
     * @param   numero  id evento
     * @return  lista   informacion del evento
     *                  -1 en la primer posicion si no se encuentra nada
     */
    static function consultarInformacionEvento($ID_EVENTO){
        $info_evento = mEventos::pedirInformacionEventos($ID_EVENTO);
        //SI EL EVENTO BUSCADO EXISTE...
        if($info_evento[0] != -1){
            //si hay alguien inscrito
            if(cEventos::consultarInfoBasicaEvento($ID_EVENTO)[0] != -1){
                //obtener la cantidad de participantes inscritos
                $info_evento[11] = cEventos::consultarInfoBasicaEvento($ID_EVENTO)[2];
            }else{
                $info_evento[11] = 0;
            }
        }else{
            $info_evento[11] = 0;
        }
        echo "<script>console.log('cEventos::consultarInformacionEvento -> ".$info_evento[0]."')</script>";
        return $info_evento;
    }
    /**
     * Consultar la información basica de un evento
     * @param   int     id del evento
     * @return  array   resultados de la busqueda
     */
    static function consultarInfoBasicaEvento($ID_EVENTO){
        $resultados = mEventos::pedirInfoBasicaEvento($ID_EVENTO);
        echo "<script>console.log('cEventos::consultarInfoBasicaEvento -> ".$resultados[0]."')</script>";
        return($resultados);
    }
    /**
     * Consultar la lista de participantes inscritos en un evento
     * @param   int     id del evento
     * @return  array   lista de participantes
     */
    static function consultarParticipantes($ID_EVENTO){
        $lista_participantes = mEventos::pedirListaInfoParticipantes($ID_EVENTO);
        echo "<script>console.log('cEventos::consultarParticipantes -> ".$lista_participantes[0][0]."')</script>";
        return $lista_participantes;
    }
    /**
     * Inscribirse en un evento
     * @param   numero  id evento
     * @param   numero  id del usuario
     */
    static function inscribirseEnEvento($ID_EVENTO,$ID_USUARIO){
        mEventos::actualizarlistaParticipantes($ID_EVENTO,$ID_USUARIO);
        echo "<script>console.log('cEventos::inscribirseEnEvento->".$ID_EVENTO."-".$ID_USUARIO."')</script>";
    }
    /**
     * Desinscribirse en un evento
     * @param   numero  id evento
     * @param   numero  id del usuario
     */
    static function desinscribirseEnEvento($ID_EVENTO,$ID_USUARIO){
        mEventos::borrarParticipante($ID_EVENTO,$ID_USUARIO);
        echo "<script>console.log('cEventos::desinscribirseEnEvento->".$ID_EVENTO."-".$ID_USUARIO."')</script>";
    }
}