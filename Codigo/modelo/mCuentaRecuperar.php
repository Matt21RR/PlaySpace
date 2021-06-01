<?php
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');

    class mCuentaRecuperar
    {
        /**
         * Buscar cuenta de usuario por medio del correo por el cual se creo
         * @param   texto   correo usado para crear la cuenta de usuario
         * @return  entero  id de la cuenta buscada por medio del correo
         */
        static function buscarCuenta($CORREO){
            
            $ID_USUARIO = -1;
            $connect = conexionBaseDatos();

            $sql  = "SELECT ID_USUARIO ";
            $sql .= "FROM USUARIOS ";
            $sql .= "WHERE CORREO = '$CORREO'";

            $result = $connect -> query($sql);

            while ($fila = mysqli_fetch_assoc($result)){
                $ID_USUARIO = $fila ['ID_USUARIO'];
            }

            echo "<script>console.log('mRecuperarCuenta::bucarCuenta')</script>";
            if($ID_USUARIO==-1){
                echo "<script>console.error('Usuario no encontrado')</script>";
            } else{
                echo "<script>console.log('ID_USUARIO: $ID_USUARIO')</script>";
            }

            $connect -> close();
            
            return $ID_USUARIO;
        }

        /**
         * Actualizar contraseña de la cuenta
         * @param   entero  ID del usuario
         * @param   texto   nueva contraseña
         */
        static function actualizarDatosCuenta($ID_USUARIO, $CONTRASENA){
            $connect = conexionBaseDatos();

            $sql  = "UPDATE USUARIOS ";
            $sql .= "SET CONTRASENA = '$CONTRASENA' ";
            $sql .= "WHERE ID_USUARIO = '$ID_USUARIO'";

            $return = $connect -> query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mRecuperarCuenta::actualizarDatosCuenta')</script>";
            $connect -> close();
        }
    }


    

