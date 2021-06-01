<?php
    include_once('../modelo/mPerfil.php');          //Herencia
    include_once('cPerfilEditar.php');

    class cPerfil extends mPerfil
    {
        /**
         * Se obtiene la información básica del usuario tomando su ID
         * @param   entero  ID de usuario
         * @return  lista   Información basica del usuario
         *                      [0] = NOMBRE_USUARIO
         *                      [1] = CONTRASENA
         *                      [2] = CORREO
         *                      [3] = CALIFICACION_USUARIO
         *                      [4] = PARTICIPACIONES
         *                      [5] = CALIFICACION_EVENTOS
         *                      [6] = EVENTOS_REALIZADOS
         *                      [7] = ID_FOTO_PERFIL
         */
        static function consultarPerfil($ID_USUARIO){
            $info_Usuario = self::pedirEstadisticas($ID_USUARIO);

            echo "<script>console.log('cPerfil::consultarPerfil')</script>";
            return $info_Usuario;
        }

        /**
         * Actualizar perfil segun el usuario
         * @param   entero  ID del usuario
         * @param   texto   Nuevo NOMBRE_USUARIO
         * @param   texto   Nuevo CORREO
         * @param   texto   Nueva CONTRASENA
         * @param   entero  Nueva ID_FOTO_PERFIL
         */
        static function actualizarPerfil($ID_USUARIO,
                                        $NUEVO_NOMBRE_USUARIO=0,
                                        $NUEVO_CORREO=0,
                                        $NUEVA_CONTRASENA=0,
                                        $NUEVA_ID_FOTO_PERFIL=0){

            cPerfilEditar::editarPerfil($ID_USUARIO,
                                        $NUEVO_NOMBRE_USUARIO,
                                        $NUEVO_CORREO,
                                        $NUEVA_CONTRASENA,
                                        $NUEVA_ID_FOTO_PERFIL)

            echo "<script>console.log('cPerfil::actualizarPerfil')</script>";
        }
    }
