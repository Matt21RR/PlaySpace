<?php
include_once ("../modelo/mAmigos.php");
class cAmigos{
    /**
     * Obtener la lista de id de los amigos
     * @param   numero  id del usuario
     * @return  lista   lista de ids de los amigos
     */
    static function consultarAmigos($id_usuario){
        $listaAmigos = mAmigos::pedirIDAmigos($id_usuario);
        if ($listaAmigos[0] == -1){
            echo "<script>console.error('cAmigos::consultarAmigos -> No se encontró ninguna solicitud enviada')</script>";
            return (-1);
        }else{
            $cantidadAmigos= count($listaAmigos);
            echo "<script>console.warn('cAmigos::consultarAmigos -> $cantidadAmigos Amigos')</script>";
            return $listaAmigos;
        }
    }
    /**
     * Obtener las solicitudes de amistad enviadas sin aceptar
     * @param   numero  id del usuario
     * @return  lista   lista de las id de las solicitudes enviadas
     */
    static function consultarSolicitudesEnviadas($id_usuario){
        $listaSolicitudes = mAmigos::pedirIDSolicitudesEnviadas($id_usuario);
        if ($listaSolicitudes[0] == -1){
            echo "<script>console.error('cAmigos::consultarSolicitudesEnviadas -> No se encontró ninguna solicitud enviada')</script>";
            return (-1);
        }else{
            $cantidadSolicitudes= count($listaSolicitudes);
            echo "<script>console.warn('cAmigos::consultarSolicitudesEnviadas -> $cantidadSolicitudes Solicitudes de amistad enviadas')</script>";
            return $listaSolicitudes;
        }
        
    }
    /**
     * Obtener las solicitudes de amistad recibidas sin aceptar
     * @param   numero  id del usuario
     * @return  lista   lista de las id de las solicitudes recibidas
     */
    static function consultarSolicitudesRecibidas($id_usuario){
        $listaSolicitudes = mAmigos::pedirIDSolicitudesPendientes($id_usuario);
        if ($listaSolicitudes[0] == -1){
            echo "<script>console.error('cAmigos::consultarSolicitudesRecibidas -> No se encontró ninguna solicitud enviada')</script>";
            return (-1);
        }else{
            $cantidadSolicitudes= count($listaSolicitudes);
            echo "<script>console.warn('cAmigos::consultarSolicitudesRecibidas -> $cantidadSolicitudes Solicitudes de amistad recibidas')</script>";
            return $listaSolicitudes;
        }
        
    }
    /**
     * Busca usuarios con la id de usuario introducida
     * @param   numero  Id del usuario a buscar.
     * @return  lista   -lista con los datos basicos del usuario encontrado.
     *              -ID_USUARIO | NOMBRE_USUARIO | ID_FOTO_PERFIL
     *              -Retorna "-1" si no se encuentra ningun usuario con la id de usuairo introducida.
     */
    static function buscarAmigos($id_usuario){
        $infoUsuario = mAmigos::buscarUsuario($id_usuario);
        if ($infoUsuario[0] == -1){
            echo "<script>console.error('cAmigos::buscarAmigos -> No se encontró a ningun usuario con la id introducida')</script>";
            return (-1);
        }else{
            echo "<script>console.log('cAmigos::buscarAmigos -> ".$infoUsuario[0]." | ".$infoUsuario[1]." | ".$infoUsuario[2]."')</script>";
            return $infoUsuario;
        }
    }
    /**
     * Generar una solicitud de amistad.
     * @param   numero  id del usuario
     * @param   numero  id del usuario al cual se le desea enviar la solicitud de amistad
     */
    static function enviarSolicitudAmistad($id_solicitante,$id_objetivo){
        $id_chat = $id_solicitante." ".$id_objetivo;
        if ((mAmigos::pedirInfoAmigo($id_solicitante,$id_objetivo)[0]) == -1) {
            mAmigos::enviarSolicitudAmistad($id_chat, $id_solicitante, $id_objetivo);
            echo "<script>console.log('cAmigos::enviarSolicitudAmistad -> Solicitud de amistad enviada')</script>";
        }else{
            echo "<script>console.error('cAmigos::buscarAmigos -> Tu y ".$id_objetivo." ya son amigos, o tienen usa solicitud de amistad pendiente')</script>";
        }
    }
    /**
     * Confirma la solicitud de amistad
     * @param   numero  id del usuario actual
     * @param   numero  id de la persona que realizo la solicitud
     */
    static function aceptarSolicitudAmistad($id_usuario,$id_solicitante){
        $id_chat = $id_solicitante." ".$id_usuario;
        mAmigos::enviarConfirmacionAmistad($id_chat);
        echo "<script>console.log('cAmigos::aceptarSolicitudAmistad -> Solicitud de amistad aceptada : $id_chat')</script>";
    }
    /**
     * Deniega la solicitud de amistad
     * @param   numero  id del usuario actual
     * @param   numero  id de la persona que realizo la solicitud
     */
    static function denegarSolicitudAmistad($id_usuario,$id_solicitante){
        // TODO: Revisar triggers no inmediatos para primero marcar amistad como -1(no aceptada) y mas tarde borrar la asociacion
        $id_chat = $id_solicitante." ".$id_usuario;
        mAmigos::finalizarAmistad($id_chat);
        echo "<script>console.log('cAmigos::denegarSolicitudAmistad -> Solicitud de amistad denegada : $id_chat')</script>";
    }
    /**
     * Eliminar un amigo
     * @param   numero  id del usuario
     * @param   numero  id el amigo a eliminar
     */
    static function eliminarAmigo ($id_usuario, $id_amigo){
        $id_chat = (mAmigo::pedirInfoAmigo($id_usuario,$id_amigo))[0];
        if ($id_chat != -1){
            mAmigos::finalizarAmistad($id_chat);
            echo "<script>console.warn('cAmigos::eliminarAmigo -> Amistad Terminada : $id_chat')</script>";
        }else{
            echo "<script>console.error('cAmigos::eliminarAmigo -> Error en los datos ingresados / Amistad no encontrada : $id_chat')</script>";
        }
        
    }
}