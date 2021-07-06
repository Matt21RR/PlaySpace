<?php
include_once ("../modelo/mAmigos.php");
class cAmigos{
    /**
     * Obtener la lista de id de los amigos
     * @param   numero  id del usuario
     * @return  lista   lista de ids de los amigos
     */
    static function consultarAmigos($id_usuario){
        $listaAmigos = mAmigos::pedirlistaAmigos($id_usuario);
        if ($listaAmigos[0][0] == -1){
            $cantidadAmigos = 0;
        }else{
            $cantidadAmigos = count($listaAmigos);
        }
        echo "<script>console.warn('cAmigos::consultarAmigos -> $cantidadAmigos Amigos')</script>";
        return $listaAmigos;
    }
    /**
     * Obtener las solicitudes de amistad enviadas sin aceptar
     * @param   numero  id del usuario
     * @return  lista   lista de las id de las solicitudes enviadas
     */
    static function consultarSolicitudesEnviadas($id_usuario){
        $listaSolicitudes = mAmigos::pedirIDSolicitudesEnviadas($id_usuario);
        if ($listaSolicitudes[0][0] == -1){
            echo "<script>console.error('cAmigos::consultarSolicitudesEnviadas -> No se encontró ninguna solicitud enviada')</script>";
            return (-1);
        }else{
            $cantidadSolicitudes = count($listaSolicitudes);
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
        $listaIdSolicitudes = mAmigos::pedirListaSolicitudesPendientes($id_usuario);
        if ($listaIdSolicitudes[0] == -1){
            $cantidadSolicitudes = 0;
            $listaSolicitudes[0][0] = -1;
        }else{
            for ($posX=0; $posX < count($listaIdSolicitudes); $posX++) { 
                $listaSolicitudes[$posX] = mAmigos::buscarUsuario($listaIdSolicitudes[$posX]); 
            }
            $cantidadSolicitudes= count($listaSolicitudes);
        }
        echo "<script>console.warn('cAmigos::consultarSolicitudesRecibidas -> $cantidadSolicitudes Solicitudes de amistad recibidas')</script>";
            return $listaSolicitudes;
        
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
            echo "<script>console.error('usuario no encontrado')</script>";
        }else{
            echo "<script>console.log('cAmigos::buscarAmigos -> ".$infoUsuario[0]." | ".$infoUsuario[1]." | ".$infoUsuario[2]."')</script>";
        }
        return $infoUsuario;
    }
    /**
     * Generar una solicitud de amistad.
     * @param   numero  id del usuario
     * @param   numero  id del usuario al cual se le desea enviar la solicitud de amistad
     * @return  numero  1 = La solicitud se envio correctamente |
     *                  0 = Ya se ha enviado una solicitud de amistad a esa persona |
     *                  -1 = los usuarios ya son amigos |
     *                  -2 = El otro usuario ha rechazado la solicitud de amistad recientemente
     *                  
     */
    static function enviarSolicitudAmistad($id_solicitante,$id_objetivo){
        
        if ((mAmigos::pedirInfoAmigo($id_solicitante,$id_objetivo)[0]) == -1) {//verificar que no sean amigos
            //verificar que no se hayan rechazado una solicitud de amistad previamente(que el usuario actual no haya sido el rechazado)
            if(array_search($id_solicitante, mAmigos::pedirListaSolicitudesRechazadas($id_solicitante,$id_objetivo)) === false){
                //verificar que no tengan una solicitud de amistad ya enviada
                if(array_search($id_objetivo, mAmigos::pedirListaSolicitudesPendientes($id_solicitante)) !== false){
                    echo "<script>console.error('cAmigos::buscarAmigos -> Tu y ".$id_objetivo." tienen usa solicitud de amistad pendiente')</script>"; 
                    return 0;
                }else{
                    //verificar que no se hayan rechazado una solicitud de amistad previamente(que el usuario actual no haya sido el rechazador)
                    if(array_search($id_objetivo, mAmigos::pedirListaSolicitudesRechazadas($id_solicitante,$id_objetivo)) !== false){
                        $id_chat = $id_objetivo."_".$id_solicitante; //solicitud a borrar
                        mAmigos::finalizarAmistad($id_chat);//borrar esa solicitud
                    }
                    $id_chat = $id_solicitante."_".$id_objetivo;
                    $resultadoEnvio = mAmigos::enviarSolicitudAmistad($id_chat, $id_solicitante, $id_objetivo);//Almacena si se pudo enviar la solicitud o no
                    echo "<script>console.log('cAmigos::enviarSolicitudAmistad -> Solicitud de amistad enviada? ->'".$resultadoEnvio.")</script>";
                    return $resultadoEnvio;
                }
            }else{
                echo "<script>console.error('cAmigos::buscarAmigos -> ".$id_objetivo." te ha rehazado una solicitud de amistad recientemente.')</script>";
                return -2;
            }
            
        }else{
            echo "<script>console.error('cAmigos::buscarAmigos -> Tu y ".$id_objetivo." ya son amigos.')</script>";
            return -1;
        }
    }
    /**
     * Confirma la solicitud de amistad
     * @param   numero  id del usuario actual
     * @param   numero  id de la persona que realizo la solicitud
     */
    static function aceptarSolicitudAmistad($id_usuario,$id_solicitante){
        $id_chat = $id_solicitante."_".$id_usuario;
        $resultado = mAmigos::enviarConfirmacionAmistad($id_chat);
        if($resultado != 0){
            include_once ("../controlador/cClaveEncriptacion.php");
            cClaveEncriptacion::enviarClaveEncriptacion($id_chat);
        }
        echo "<script>console.log('cAmigos::aceptarSolicitudAmistad -> Solicitud de amistad aceptada : $id_chat')</script>";
        return $resultado;
    }
    /**
     * Deniega la solicitud de amistad
     * @param   numero  id del usuario actual
     * @param   numero  id de la persona que realizo la solicitud
     */
    static function denegarSolicitudAmistad($id_usuario,$id_solicitante){
        // TODO: Revisar triggers no inmediatos para primero marcar amistad como -1(no aceptada) y mas tarde borrar la asociacion
        $id_chat = $id_solicitante."_".$id_usuario;
        $resultado = mAmigos::enviarDenegacionAmistad($id_chat);
        echo "<script>console.log('cAmigos::denegarSolicitudAmistad -> Solicitud de amistad denegada : $id_chat')</script>";
        return $resultado;
    }
    /**
     * Eliminar un amigo
     * @param   numero  id del usuario
     * @param   numero  id el amigo a eliminar
     */
    static function eliminarAmigo ($id_usuario, $id_amigo){
        $id_chat = (mAmigos::pedirInfoAmigo($id_usuario,$id_amigo))[0];
        if ($id_chat != -1){
            $resultado = mAmigos::finalizarAmistad($id_chat);//para saber si si se pudo eliminar el amigo o no
            echo "<script>console.warn('cAmigos::eliminarAmigo -> Amistad Terminada : $id_chat')</script>";
        }else{
            echo "<script>console.error('cAmigos::eliminarAmigo -> Error en los datos ingresados / Amistad no encontrada : $id_chat')</script>";
        }
        return $resultado;
    }

    /**
     * Solicitar info de un amigo
     * @param   numero  id del usuario
     * @param   numero  id el amigo
     * @return  arreglo info del amigo
     */
    static function solicitarInfoAmigo($id_usuario, $id_amigo){
        $infoAmigo = mAmigos::pedirInfoAmigo($id_usuario,$id_amigo);
        echo "<script>console.log('cAmigos::solicitarInfoAmigo -> ".$infoAmigo[0]."')</script>";
        return ($infoAmigo);
    }
}