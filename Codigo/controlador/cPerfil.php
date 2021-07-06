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
         *                      [7] = FECHA_CLAVE_VERIFICACION
         *                      [8] = TIENDA_PRUEBA
         *                      [9] = ID_FOTO_PERFIL
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
                                        $NUEVA_ID_FOTO_PERFIL);

            echo "<script>console.log('cPerfil::actualizarPerfil')</script>";
        }
        /**
         * Enviar email a un correo específico
         * @param   texto   correo al cual se le enviara un mensaje
         * @param   texto   Asunto del email
         *                      0 = CREAR CUENTA
         *                      1 = CLAVE_VERIFICACION (PIN / Recuperar Cuenta)
         *                      2 = Nuevo correo para un perfil
         * @param   texto   Mensaje que desea enviar
         *          entero  0 = Ninguno
         * @return  entero   1 = Mensaje enviado
         *                  -1 = Mensaje no enviado
         */
        static function enviarEmail($correo,$asunto,$mensaje=0){
            $asuntos = [
                'Creación Cuenta',
                'Recuperar Cuenta',
                'Nuevo Correo'   
            ];
            $mensajes = [
                'SE HA CREADO UNA CUENTA CON ESTE CORREO',
                'CLAVE DE VERIFICACIÓN: '.$mensaje,
                'NUEVO CORREO PARA EL USUARIO:'.$mensaje
            ];
 
            if(mail($correo, $asunto[$asunto], $mensajes[$asunto])){
                $emailSend = 1;
            } else{
                $emailSend = -1;
            }
            return $emailSend;
        }
    }
