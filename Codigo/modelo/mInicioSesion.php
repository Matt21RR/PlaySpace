<?php
    include_once ('../mBaseDatos.php');
    include_once ("../mMaster.php");
    class mInicioSesion{
        /**
         * Comprueba si se encuentra algun usuario en la base de datos con las credenciales
         * ingresadas.
         * @param   texto   El nombre del usuario
         * @param   texto   La contraseña del usuario
         * @return  numero  Id del usuario | -1 = No se ha encontrado ningun usario con esas credenciales
         */
        static function comprobarDatosInicioSesion($nick,$pass){
            $connect=conexionBaseDatos();

            $id_usuario = -1;

            $sql="select ID_USUARIO from USUARIOS where NOMBRE_USUARIO = '$nick' and CONTRASENA = '$pass'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $id_usuario = $fila ['ID_USUARIO'];
        
            }
            echo "<script>console.log('mInicioSesion::comprobarDatosInicioSesion->$id_usuario')</script>";
            $connect->close();
            return $id_usuario;
        }
        // ! ESTO CREO QUE NO SIRVE PARA NADA (CREO)
        /**
         * Pide la contraseña HASHEADA del usuario que esta en la base de datos
         * @param   texto   nombre del usuario
         * @return  texto   contraseña del usuario hasheada
         */
        static function pedirContrasenaHasheada($nick){
            $connect=conexionBaseDatos();
            $passHashed = '';
            $sql = "SELECT CONTRASENA FROM USUARIOS WHERE NOMBRE_USUARIO = '$nick'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $passHashed = $fila ['CONTRASENA'];
        
            }
            echo "<script>console.log('mInicioSesion::pedirContrasenaHasheada->$passHashed')</script>";
            $connect->close();
            return $passHashed;

        }
    }
    