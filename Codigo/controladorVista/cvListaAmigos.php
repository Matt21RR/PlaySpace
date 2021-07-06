<?php
    if(!isset($_SESSION))session_start();
    include_once ("../Controlador/cAmigos.php");

    

    if(isset($_SESSION['ID_USUARIO'])){//si se quiere buscar la lista de amigos hacer...
        $id_usuario = $_SESSION['ID_USUARIO'];

        if(isset($_GET['finalizarAmistad'])){//para eliminar al amigo
            $idAmigo = $_GET['finalizarAmistad'];
            $resultado = cAmigos::eliminarAmigo($id_usuario,$idAmigo); //para saber si si se pudo hacer o no se pudo hacer
            echo json_encode($resultado);
        }

        if(isset($consultado)){
            if($consultado==0){
                $_SESSION['listaAmigos'] = cAmigos::consultarAmigos($id_usuario);//obtener la lista de amigos
                $_SESSION['listaSolicitudes'] = cAmigos::consultarSolicitudesRecibidas($id_usuario);
                $consultado = 1;
            }
        }
    }

    
