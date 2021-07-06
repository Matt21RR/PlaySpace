<?php
    include_once ('../mBaseDatos.php');
    include_once ("../mMaster.php");
    class mAmigos{
        /**
         * Pide la lista de id's de los amigos
         * @param   numero  id del usuario para buscar los amigos
         * @return  lista   ID_AMIGO | NOMBRE_AMIGO | ID_FOTO_PERFIL | ID_CHAT
         *                  retorna -1 en la primer posicion si no se encuentra ninguna coincidencia
         */
        static function pedirListaAmigos($ID_USUARIO){
            $LISTA_AMIGOS[0][0] = -1;
            $connect=conexionBaseDatos();
            $sql = "SELECT *
                    FROM INFO_AMIGOS
                    WHERE ID_USUARIO = '$ID_USUARIO'";
            $posicion = 0;
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $LISTA_AMIGOS[$posicion][0] = $fila['ID_AMIGO'];
                $LISTA_AMIGOS[$posicion][1] = $fila['NOMBRE_AMIGO'];
                $LISTA_AMIGOS[$posicion][2] = $fila['ID_FOTO_PERFIL'];
                $LISTA_AMIGOS[$posicion][3] = $fila['ID_CHAT'];
                
                $posicion++;
            }
            
            echo "<script>console.log('mAmigos::pedirListaAmigos-> ".$LISTA_AMIGOS[0][0]."')</script>";
            $connect->close();
            return $LISTA_AMIGOS;
        }

        /**
         * Pide la lista de id's de los usuarios que te envian solicitudes de amistad
         * @param   numero  id del usuario
         * @param   lista   lista del las id de los usuarios que te han enviado solicitudes
         *                  retorna -1 en la primer posicion si no se encuentra ninguna coincidencia
         */
        static function pedirListaSolicitudesPendientes($ID_USUARIO){
            $LISTA_SOLICITUDES[0] = -1;
            $connect=conexionBaseDatos();
            $sql = "SELECT 
                    (case when ID_USUARIO_AMIGO_1 = '$ID_USUARIO' THEN ID_USUARIO_AMIGO_2 ELSE ID_USUARIO_AMIGO_1 END) AS ID_SOLICITANTE
                    FROM INFO_SOLICITUDES 
                    WHERE ID_USUARIO_SOLICITANTE <> '$ID_USUARIO'
                    AND (ID_USUARIO_AMIGO_1 ='$ID_USUARIO'
                    OR ID_USUARIO_AMIGO_2 = '$ID_USUARIO')";
            $posicion = 0;
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $LISTA_SOLICITUDES[$posicion] = $fila['ID_SOLICITANTE'];
                $posicion++;
            }
            $LISTA_SOLICITUDES = array_unique($LISTA_SOLICITUDES);
            sort($LISTA_SOLICITUDES);
            echo "<script>console.log('mAmigos::pedirListaSolicitudesPendientes->".$LISTA_SOLICITUDES[0]."')</script>";
            $connect->close();
            return $LISTA_SOLICITUDES;
        }
        /**
         * Saber si se ha rechazado una solicitud de amistad y quien de los dos la rechazó
         * @param   numero  id del usuario actual
         * @param   numero  id del otro usuario
         * @return   numero     la id del que fue rechazado o -1 en la primer pos si no se ha encontrado ninguna coincidencia
         */
        static function pedirListaSolicitudesRechazadas($ID_USUARIO,$ID_OBJETIVO){
            $LISTA_SOLICITUDES[0] = -1;
            $connect=conexionBaseDatos();
            $sql = "SELECT ID_USUARIO_SOLICITANTE,
                    (case when ID_USUARIO_AMIGO_1 = '$ID_USUARIO' THEN ID_USUARIO_AMIGO_1 ELSE ID_USUARIO_AMIGO_2 END) AS ID_RECHAZADOR
                    FROM INFO_SOLICITUDES_RECHAZADAS 
                    WHERE (ID_USUARIO_AMIGO_1 ='$ID_USUARIO'
                    AND ID_USUARIO_AMIGO_2 = '$ID_OBJETIVO') OR (ID_USUARIO_AMIGO_1 ='$ID_OBJETIVO'
                    AND ID_USUARIO_AMIGO_2 = '$ID_USUARIO')";
            $posicion = 0;
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $LISTA_SOLICITUDES[$posicion] = $fila['ID_USUARIO_SOLICITANTE'];
                $posicion++;
            }
            $LISTA_SOLICITUDES = array_unique($LISTA_SOLICITUDES);
            echo "<script>console.log('mAmigos::pedirIDSolicitudesRechazadas->".$LISTA_SOLICITUDES[0]."')</script>";
            $connect->close();
            return $LISTA_SOLICITUDES;
        }

        /**
         * Pide la lista de id's de los usuarios que has enviado solicitudes de amistad
         * @param   numero  id del usuario
         * @param   lista   lista del las id de los usuarios que has enviado solicitudes
         *                  retorna -1 EN LA PRIMER POSICION si no se encuentra ninguna coincidencia
         */
        // ! EN DESUSO | CON FALLOS EN EL SQL
        static function pedirIDSolicitudesEnviadas($ID_USUARIO){
            $LISTA_SOLICITUDES[0] = -1;
            $connect=conexionBaseDatos();
            $sql = "SELECT ID_OBJETIVO,NOMBRE_OBJETIVO,ID_FOTO_PERFIL_OBJETIVO 
                    FROM INFO_SOLICITUDES 
                    WHERE ID_SOLICITANTE = '$ID_USUARIO' AND AMISTAD = '0'";
            $posicion = 0;
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $LISTA_SOLICITUDES[$posicion] = $fila['ID_OBJETIVO'];
                $posicion++;
            }
            
            echo "<script>console.log('mAmigos::pedirIDSolicitudesEnviadas->$posicion')</script>";
            $connect->close();
            return $LISTA_SOLICITUDES;
        }

        /**
         * Pide la informacion de un amigo
         * @param   numero  id del usuario.
         * @param   numero  id del usuario amigo.
         * @return  lista   Informacion del amigo.
         *                  -ID_CHAT | ID_AMIGO | NOMBRE_AMIGO | ID_FOTO_PERFIL
         *                  -Retornará -1 en la primer posicion si no se encuentra ningun resultado en la busqueda.
         */
        static function pedirInfoAmigo($ID_USUARIO,$ID_AMIGO){
            $infoAmigo[0] = -1;
            $connect=conexionBaseDatos();
            $sql = "SELECT * FROM INFO_AMIGOS 
                    WHERE ID_USUARIO = '$ID_USUARIO' AND ID_AMIGO = '$ID_AMIGO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $infoAmigo[0] = $fila['ID_CHAT'];
                $infoAmigo[1] = $fila['ID_AMIGO'];
                $infoAmigo[2] = $fila['NOMBRE_AMIGO'];
                $infoAmigo[3] = $fila['ID_FOTO_PERFIL'];
            }
            echo "<script>console.log('mAmigos::pedirInfoAmigo->".$infoAmigo[0]."')</script>";
            $connect->close();
            return $infoAmigo;
        }
        /**
         * Envia la solicitud de amistad
         * @param   texto   id de ambos usuarios pegada ('id_solicitante'.'id_objetivo')
         * @param   numero  id de la persona que realiza la solicitud de amistad
         * @param   numero  id de la persona objetivo de la solicitud de amistad
         * @return  numero  1 = envio exitoso | 0 = Ya existe una solicitud de amistad pendiente
         */
        static function enviarSolicitudAmistad($ID_CHAT,$ID_SOLICITANTE,$ID_OBJETIVO){
            $connect = conexionBaseDatos();
            $sql = "INSERT INTO AMIGOS (ID_CHAT,
                                        ID_SOLICITANTE,
                                        ID_OBJETIVO,
                                        AMISTAD)VALUES ('$ID_CHAT',
                                                            '$ID_SOLICITANTE',
                                                            '$ID_OBJETIVO',
                                                            0)";
            $result = $connect->query($sql);
            $resultado = comprobarDatosAfectados($connect);
            echo "<script>console.log('mAmigos::enviarSolicitudAmistad->$ID_CHAT')</script>";
            $connect->close();
            return $resultado;
        }
        /**
         * actualiza el estado de la amistad entre los usuarios
         * @param   numero  id de la persona que realiza la solicitud de amistad
         * @param   numero  id de la persona objetivo de la solicitud de amistad
         */
        static function enviarConfirmacionAmistad($ID_CHAT){
            $connect = conexionBaseDatos();
            $sql = "UPDATE AMIGOS 
                    set AMISTAD = 1 
                    where ID_CHAT = '$ID_CHAT' AND AMISTAD = 0";
            $result = $connect->query($sql);
            $resultado = comprobarDatosAfectados($connect);
            echo "<script>console.log('mAmigos::enviarConfirmacionAmistad $ID_CHAT')</script>";
            $connect->close();   
            return $resultado;
        }

        static function enviarDenegacionAmistad($ID_CHAT){
            $connect = conexionBaseDatos();
            $sql = "UPDATE AMIGOS 
                    set AMISTAD = -1 
                    where ID_CHAT = '$ID_CHAT' AND AMISTAD = 0";
            $result = $connect->query($sql);
            $resultado = comprobarDatosAfectados($connect);
            echo "<script>console.log('mAmigos::enviarDenegacionAmistad $ID_CHAT')</script>";
            $connect->close();   
            return $resultado;
        }
        /**
         * Borra la fila que relaciona a los amigos
         * @param   texto   id del chat (la id que relaciona a ambos usuarios)
         */
        static function finalizarAmistad($ID_CHAT){
            $connect = conexionBaseDatos();
            $sql = "DELETE FROM AMIGOS 
                    WHERE ID_CHAT = '$ID_CHAT'";
            $result = $connect->query($sql);
            $resultado = comprobarDatosAfectados($connect); //para saber si si se pudo hacer o no
            echo "<script>console.log('mAmigos::finalizarAmistad $ID_CHAT')</script>";
            $connect->close();
            return $resultado;
        }
        /**
         * Obtiene la informacion basica de un usuario por medio de la ID
         * @param   numero  id del usuario a buscar
         * @return  lista   -lista con los datos basicos del usuario encontrado.
         *                  -ID_USUARIO | NOMBRE_USUARIO | ID_FOTO_PERFIL
         *                  -Retorna "-1" en la primer posicion si no se encuentra
         *                      ningun usuario con la id de usuario introducida.
         */
        static function buscarUsuario ($id_usuario){
            $resultado[0] = -1;
            $connect = conexionBaseDatos();
            $sql = "SELECT * FROM INFO_BASICA_USUARIO
                    WHERE ID_USUARIO = '$id_usuario'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $resultado[0] = $fila['ID_USUARIO'];
                $resultado[1] = $fila['NOMBRE_USUARIO'];
                $resultado[2] = $fila['ID_FOTO_PERFIL'];
            }
            echo "<script>console.log('mAmigos::buscarUsuario -> ".$resultado[0]."')</script>";
            $connect->close();
            return $resultado;
        }
    }
    