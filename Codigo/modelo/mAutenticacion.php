<?php
    include_once('../mMaster.php');
    include_once('../mBaseDatos.php');

    class mAutenticacion
    {
        /**
         * Ingresa la clave de verificación en el usuario almacenado en la base de datos
         * @param   entero  id de usuario
         * @param   texto   clave de verificacion generada por el sistema
         */
        static function enviarClaveVerificacion($ID_USUARIO, $CLAVE_VERIFICACION){
            $connect = conexionBaseDatos();

            $sql  = "UPDATE USUARIOS ";
            $sql .= "SET CLAVE_VERIFICACION = '$CLAVE_VERIFICACION', 
                     FECHA_CLAVE_VERIFICACION = DATE_ADD(NOW(), INTERVAL 10 MINUTE)";        //Ingresa la fecha límite
            $sql .= "WHERE ID_USUARIO = '$ID_USUARIO'";

            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mAutenticacion::enviarClaveVerificacion')</script>";
            $connect -> close();
        }
        /**
         * Obtener la clave de verificación almacenada en la tabla del usuario
         * @param   entero  id del usuario
         * @return  texto   Clave de verificación
         */
        static function pedirClaveVerificacion($ID_USUARIO){
            $connect = conexionBaseDatos();

            $sql  = "SELECT * FROM USUARIOS ";
            $sql .= "WHERE ID_USUARIO = '$ID_USUARIO'";
            $result = $connect -> query($sql);

            while ($fila = mysqli_fetch_assoc($result)){
                $CLAVE_VERIFICACION = $fila['CLAVE_VERIFICACION'];
            }
            echo "<script>console.log('CLAVE_VERIFICACION: $CLAVE_VERIFICACION')</script>";

            $connect -> close();
            echo "<script>console.log('mAutenticacion::pedirClaveVerificacion')</script>";
            return $CLAVE_VERIFICACION;
        }
        /**
         * Borrar la clave de verificación almacenada en el usuario de la base de datos
         * @param   entero  id de usuario
         */
        static function borrarClaveVerificacion($ID_USUARIO){
            $connect = conexionBaseDatos();

            $sql  = "UPDATE USUARIOS ";
            $sql .= "SET CLAVE_VERIFICACION = null ";
            $sql .= "WHERE ID_USUARIO = $ID_USUARIO";

            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mAutenticacion::borrarClaveVerificacion')</script>";
            $connect -> close();
        }
    }
    

    


