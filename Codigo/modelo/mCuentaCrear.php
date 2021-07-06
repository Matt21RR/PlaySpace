<?php
    include_once ('../mBaseDatos.php');
    include_once ("../mMaster.php");

    class mCuentaCrear
    {
        /**
         * Comprueba que el correo ingresado no se encuentre ya presente en
         * la base de datos.
         * @param   texto   correo
         * @return  entero  0 = No / 1 = Si
         */
        static function comprobarCorreoRepetido($CORREO){
            $connect = conexionBaseDatos();
            $id_usuario=0;
            
            $sql = "SELECT ID_USUARIO 
                    FROM USUARIOS 
                    WHERE CORREO = '$CORREO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $id_usuario = $fila ['ID_USUARIO'];
        
            }
            if ($id_usuario!=0){
                $repetido = 1;
            }else{
                $repetido = 0;
            }

            $tipoMensaje = "log";
            if($repetido == 1){
                $tipoMensaje = "error";
            }
            echo "<script>console.$tipoMensaje('mCuentaCrear::comprobarCorreoRepetido->$repetido')</script>";
            $connect->close();
            return $repetido;
        }
        /**
         * Comprueba que el correo ingresado no se encuentre ya presente en
         * la base de datos.
         * @param   texto   nombre de usuario
         * @return  entero  0 = No / 1 = Si
         */
        static function comprobarNickRepetido($NOMBRE_USUARIO){
            $connect = conexionBaseDatos();
            
            $id_usuario=0;
            
            $sql = "SELECT ID_USUARIO 
                    FROM USUARIOS 
                    WHERE NOMBRE_USUARIO = '$NOMBRE_USUARIO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $id_usuario = $fila ['ID_USUARIO'];
            }
            if ($id_usuario!=0){
                $repetido = 1;
            }else{
                $repetido = 0;
            }

            $tipoMensaje = "log";
            if($repetido == 1){
                $tipoMensaje = "error";
            }
            echo "<script>console.$tipoMensaje('mCrearCuenta::comprobarNickRepetido->$repetido')</script>";
            $connect->close();
            return $repetido;
        }
        /**
         * Se agrega la informacion ingresada por el usuario a la base de datos.
         * @param   entero  id del usuario|Solo hacer mension del mismo|no subministrar ningun valor
         * @param   texto   nombre de usuario
         * @param   entero  id de la foto de perfil escogida
         * @param   texto   contraseña para la cuenta
         * @param   texto   correo del usuario 
         */
        static function enviarInfoCuenta ($NOMBRE_USUARIO,
                                    $ID_FOTO_PERFIL,
                                    $CONTRASENA,
                                    $CORREO){
            $connect = conexionBaseDatos();
            
            $sql = "INSERT INTO USUARIOS (NOMBRE_USUARIO,
                                            ID_FOTO_PERFIL,
                                            CONTRASENA,
                                            CORREO)VALUES ('$NOMBRE_USUARIO',
                                                        '$ID_FOTO_PERFIL',
                                                        '$CONTRASENA',
                                                        '$CORREO')";
            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mCrearCuenta::enviarInfoCuenta')</script>";
            $connect->close();
        }
    }