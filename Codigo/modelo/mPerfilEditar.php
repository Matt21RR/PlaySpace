<?php
    include_once ('../mBaseDatos.php');
    include_once ("../mMaster.php");
    
    class mPerfilEditar{
        /**
         * Cambia los valores de la cuenta del usuario
         * @param   numero  id del usuario
         * @param   texto   nuevo nombre para el usuario
         * @param   texto   nuevo correo del usuario
         * @param   texto   nueva contraseña del usuario
         * @param   numero  nueva id de foto de perfil
         */
        static function actualizarPerfil($ID_USUARIO,
                                        $NUEVO_NOMBRE_USUARIO,
                                        $NUEVO_CORREO,
                                        $NUEVA_CONTRASENA,
                                        $NUEVA_ID_FOTO_PERFIL){
            $connect=conexionBaseDatos();
            $sql="UPDATE USUARIOS SET NOMBRE_USUARIO = '$NUEVO_NOMBRE_USUARIO',
                                    CONTRASENA = '$NUEVA_CONTRASENA',
                                    CORREO = '$NUEVO_CORREO',
                                    ID_FOTO_PERFIL = '$NUEVA_ID_FOTO_PERFIL' 
                                    WHERE ID_USUARIO='$ID_USUARIO'";
            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mEditarPerfil::comprobarDatosInicioSesion')</script>";
            $connect->close();
        }
        /**
         * Se actualiza la fecha en la cual es cambiado el nombre
         * de usuario.
         * @param   numero      la id del usuario
         */
        static function actualizarFechaCambioNombre($ID_USUARIO){
            $connect=conexionBaseDatos();
            $sql = "UPDATE usuarios 
                    set FECHA_CAMBIO_NOMBRE = current_timestamp() 
                    where ID_USUARIO = '$ID_USUARIO'";
            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mEditarPerfil::comprobarDatosInicioSesion')</script>";
            $connect->close();
        }
        /**
         * Se pide la fecha de la ultima vez que se editó el nombre
         * de usuario.
         * @param   numero      la id del usuario
         * @return  datetime    la fecha en la cual se hizo la ultima modificacion
         */
        static function pedirFechaCambioNombre($ID_USUARIO){
            $connect=conexionBaseDatos();
            $sql = "SELECT FECHA_CAMBIO_NOMBRE 
                    FROM USUARIOS 
                    WHERE ID_USUARIO ='$ID_USUARIO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $fecha_cambio_nombre = $fila ['FECHA_CAMBIO_NOMBRE'];
            }
            echo "<script>console.log('mEditarPerfil::pedirFechaCambioNombre->$fecha_cambio_nombre')</script>";
            $connect->close();
            return $fecha_cambio_nombre;
        }
        /**
         * Pide la contraseña HASHEADA del usuario que esta en la base de datos
         * @param   texto   nombre del usuario
         * @return  texto   contraseña del usuario hasheada
         */
        static function pedirContrasenaHasheada($ID_USUARIO){
            $connect=conexionBaseDatos();
            $passHashed = '';
            $sql = "SELECT CONTRASENA FROM USUARIOS WHERE ID_USUARIO = '$ID_USUARIO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $passHashed = $fila ['CONTRASENA'];
        
            }
            echo "<script>console.log('mPerfilEditar::pedirContrasenaHasheada->$passHashed')</script>";
            $connect->close();
            return $passHashed;

        }
        /**
         * Se borra la cuenta del usuario.
         * @param   entero  la id del usuario para borrar su cuenta
         */
        static function borrarCuenta($ID_USUARIO){
            $connect=conexionBaseDatos();
            $sql="delete from usuarios where ID_USUARIO='$ID_USUARIO'";
            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.warn('mEditarPerfil::borrarCuenta)</script>";
            $connect->close();
        }
    }