<?php
include_once("../modelo/mEventos.php");
class cEventos{
    /**
     * Consulta la lista de eventos a los cuales esta inscrito
     * @param   numero  id del usuario
     */
    static function consultarEventosInscritos($ID_USUARIO){
        $id_eventos = mEventos::pedirIDEventosInscrito($ID_USUARIO);
        if($id_eventos[0]!=-1){//si hay algun evento
            for($posX = 0; $posX != count($id_eventos); $posX++){
                $resultado=mEvento::pedirInfoBasicaEvento($id_eventos[$posX]);
                $info_basic_eventos[$posX][0] = $resultado[0];//ID_EVENTO
                $info_basic_eventos[$posX][1] = $resultado[1];//TIPO_EVENTO
                $info_basic_eventos[$posX][2] = $resultado[2];//# INSCRITOS
                $info_basic_eventos[$posX][3] = $resultado[3];//# SLOTS_PARTICIPANTES
                $info_basic_eventos[$posX][4] = $resultado[4];//FECHA_INICIO
            }
        }
        
    }
    /**
     * Consulta la lista de los eventos que ha creado
     * @param   numero  id del usuario
     */
    static function consultarEventosCreados($ID_USUARIO){
        $id_eventos = mEventos::pedirIDEventosCreador($ID_USUARIO);
        if($id_eventos[0]!=-1){
            for($posX = 0; $posX != count($id_eventos); $posX++){
                $resultado=mEvento::pedirInfoBasicaEvento($id_eventos[$posX]);
                $info_basic_eventos[$posX][0] = $resultado[0];//ID_EVENTO
                $info_basic_eventos[$posX][1] = $resultado[1];//TIPO_EVENTO
                $info_basic_eventos[$posX][2] = $resultado[2];//# INSCRITOS
                $info_basic_eventos[$posX][3] = $resultado[3];//# SLOTS_PARTICIPANTES
                $info_basic_eventos[$posX][4] = $resultado[4];//FECHA_INICIO
            }
        }
    }
    /**
     * Consultar la informacion de un evento especifico
     * @param   numero  id evento
     */
    static function consultarInformacionEvento($ID_EVENTO){

    }
    /**
     * Inscribirse en un evento
     * @param   numero  id evento
     * @param   numero  id del usuario
     */
    static function inscribirseEnEvento($ID_EVENTO,$ID_USUARIO){

    }
}