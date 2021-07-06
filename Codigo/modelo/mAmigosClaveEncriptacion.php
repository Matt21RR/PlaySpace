<?php
    include_once ('../mBaseDatos.php');
    include_once ("../mMaster.php");
    class mAmigosClaveEncriptacion{
        /**
         * Para subir la clave de encriptacion SIN encriptar
         * NOTA: Enviar la clave sin encriptar unida a la primer letra del
         *       nombre del usuario repetida tres veces mas 1(uno) espacios.
         *       EJ. nombre_usuario = 'juankarlos'
         *       clave no encriptada = '7CVa5ydo0asd65gvasg'
         *       Entonces se debe de enviar : 'jjj 7CVa5ydo0asd65gvasg'
         *       *Esto se hace para saber cuando la clave esta encriptada o no.
         * 
         * @param   texto   id del chat que une a ambos usuarios
         * @param   texto   clave de encriptacion
         */
        static function enviarClave ($ID_CHAT,$CLAVE_ENCRIPTACION){
            $connect = conexionBaseDatos();
            $sql = "UPDATE AMIGOS 
                    set key_encriptacion_solicitante = '$CLAVE_ENCRIPTACION',
                        key_encriptacion_objetivo = '$CLAVE_ENCRIPTACION' 
                    where ID_CHAT = '$ID_CHAT'";
            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mClaveEncriptacion::enviarClave->$ID_CHAT')</script>";
            $connect->close();
        }
        /**
         * Pide la clave de encriptacion para desencriptar los mensajes
         * NOTA: Pese a su nombre, esta funcion permite obtener tambien
         * las claves de encriptacion sin cifrar.
         * @param   texto   id del chat que une a ambos usuarios
         * @param   numero  id del usuario
         */
        static function pedirClaveEncriptada($ID_CHAT,$ID_USUARIO){

            $connect = conexionBaseDatos();
            $sql = "SELECT key_encriptacion_solicitante
                    FROM AMIGOS
                    WHERE ID_CHAT='$ID_CHAT' AND ID_SOLICITANTE = '$ID_USUARIO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $key_encriptacion = $fila ['key_encriptacion_solicitante'];
            }

            if ($fila==null){
                $sql = "SELECT key_encriptacion_objetivo
                    FROM AMIGOS
                    WHERE ID_CHAT='$ID_CHAT' AND ID_OBJETIVO = '$ID_USUARIO'";
                $result = $connect->query($sql);
                while ($fila = mysqli_fetch_assoc($result)){
                    $key_encriptacion = $fila ['key_encriptacion_objetivo'];
                }
            }

            echo "<script>console.log('mClaveEncriptacion::pedirClaveEncriptada->$key_encriptacion')</script>";
            $connect->close();
            return $key_encriptacion;
        }
        
        /**
         * Envia la clave encriptada por uno de los amigos
         * @param   texto   id del chat
         * @param   numero  0 = guardar en el campo del solicitante / 1 = en el del objetivo
         */
        static function enviarClaveEncriptada($ID_CHAT,$GUARDAR_EN,$CLAVE_ENCRIPTACION){
            $connect = conexionBaseDatos();
            $sql = "UPDATE AMIGOS ";
            if ($GUARDAR_EN == 0){
                $sql .="SET key_encriptacion_solicitante = '$CLAVE_ENCRIPTACION' ";
            }else{
                $sql .="SET key_encriptacion_objetivo = '$CLAVE_ENCRIPTACION' ";
            }
            $sql .="where ID_CHAT = '$ID_CHAT'";

            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mClaveEncriptacion::enviarClaveEncriptada->$ID_CHAT - $GUARDAR_EN')</script>";
            $connect->close();
        }
        /**
         * Borra la clave de encriptacion propia para que el "amigo" sepa
         * que se requiere de la clave de encriptacion sin encriptar
         * @param   texto   id del chat
         * @param   numero  0 = para borrar la key del solicitante / 1 para la key del objetivo
         */
        static function pedirClaveAmigo ($ID_CHAT,$BORRAR_EN){
            $connect = conexionBaseDatos();
            $sql = "UPDATE AMIGOS ";
            if ($BORRAR_EN == 0){
                $sql .="SET key_encriptacion_solicitante = '' ";
            }else{
                $sql .="SET key_encriptacion_objetivo = '' ";
            }
            $sql .="where ID_CHAT = '$ID_CHAT'";

            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mClaveEncriptacion::pedirClaveAmigo->$ID_CHAT - $BORRAR_EN')</script>";
            $connect->close();
        }

        static function revisarClaveAmigo ($ID_CHAT, $VERIFICAR){
            $connect = conexionBaseDatos();
            $sql = "SELECT ";
            if ($VERIFICAR == 0){
                $sql .="KEY_ENCRIPTACION_SOLICITANTE FROM AMIGOS ";
            }else{
                $sql .="KEY_ENCRIPTACION_OBJETIVO FROM AMIGOS ";
            }
            $sql .="where ID_CHAT = '$ID_CHAT'";

            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_array($result)){
                $claveAmigo = $fila [0];
            }
            echo "<script>console.log('mClaveEncriptacion::revisarClaveAmigo->$claveAmigo')</script>";
            $connect->close();
            return $claveAmigo;
        }
        /**
         * Para enviar una copia de la clave de encriptacion sin encriptar al
         * amigo que la necesita
         * @param   texto   id del chat
         * @param   numero  0 = para enviar la key al 'solicitante' / 1 para enviar la key al 'objetivo'
         */
        static function enviarClaveAmigo($ID_CHAT,$ENVIAR_A,$KEY_ENCRIPTACION){
            $connect = conexionBaseDatos();
            $sql = "UPDATE AMIGOS ";
            if ($ENVIAR_A == 0){
                $sql .="SET key_encriptacion_solicitante = '$KEY_ENCRIPTACION' ";
            }else{
                $sql .="SET key_encriptacion_objetivo = '$KEY_ENCRIPTACION' ";
            }
            $sql .="where ID_CHAT = '$ID_CHAT'";

            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mClaveEncriptacion::enviarClaveAmigo->$ID_CHAT - $ENVIAR_A - $KEY_ENCRIPTACION')</script>";
            $connect->close();
        }
    }
    
    //enviarClaveEncriptada('14',0,'subí washo');
    //enviarClave("14","quesitowe");
    //pedirClaveEncriptada('23',2);
    //enviarClaveAmigo('14',0,'fleecka');