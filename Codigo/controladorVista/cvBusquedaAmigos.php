<?php
if(!isset($_SESSION))session_start();
    include_once ("../Controlador/cAmigos.php");
    if(isset($_SESSION['ID_USUARIO'])){//si se quiere buscar la lista de amigos hacer...
        $idUsuario = $_SESSION['ID_USUARIO'];
        //*AJAX
        if(isset($_REQUEST['id_usuario_buscar'])){
            $id_usuario_buscar = $_REQUEST['id_usuario_buscar'];
            if($id_usuario_buscar != $idUsuario){//Revisar que no se este intentando buscar a si mismo
                echo json_encode(cAmigos::buscarAmigos($id_usuario_buscar));//buscar a un usuario
            }else{
                echo json_encode(array('0'=> -2));
            }
        }
        elseif(isset($_REQUEST['idUsuarioEnviarSolicitud'])){
            $idUsuarioEnviarSolicitud = $_REQUEST['idUsuarioEnviarSolicitud'];
            if($idUsuarioEnviarSolicitud != $idUsuario){//Revisar que no se este intentando enviar una solicitud a si mismo
                $resultado = cAmigos::enviarSolicitudAmistad($idUsuario,$idUsuarioEnviarSolicitud);
                echo json_encode($resultado);
            }else{
                echo json_encode(-3);
            }
        }
        elseif(isset($_REQUEST['idSolicitanteAceptar'])){
            $idSolicitanteAceptar = $_REQUEST['idSolicitanteAceptar'];
            $resultado = cAmigos::aceptarSolicitudAmistad($idUsuario,$idSolicitanteAceptar)  ;//PARA SABER SI SI SE PUDO ACEPTAR LA SOLICITUD
            echo json_encode($resultado);
        }
        elseif(isset($_REQUEST['idSolicitanteDenegar'])){
            $idSolicitanteDenegar = $_REQUEST['idSolicitanteDenegar'];
            $resultado = cAmigos::denegarSolicitudAmistad($idUsuario,$idSolicitanteDenegar)  ;//PARA SABER SI SI SE PUDO ACEPTAR LA SOLICITUD
            echo json_encode($resultado);
        }
    }