<?php
    include_once('../modelo/mCuentaCrear.php');         //Herencia
    include_once('cUsuario.php');
    include_once('cCifradoContrasena.php');
    include_once('../modelo/mInicioSesion.php');       //Temporal Obtener ID_USUARIO
    include_once('cPerfilEditar.php');

    class cCuentaCrear extends mCuentaCrear
    {
// ------- CREAR CUENTA ------------------------------------------------------------------
        /**
         * Se validan los datos incresados por el usuario:
         *                              correo : crearCorreo()
         *                              nombre de usuario : crearNick()
         *                              contraseña : crearContrasena()
         *                              foto de perfil : seleccionarFotoPerfil()
         * Cuyo caso los datos ingresados sean correcto se procedera a subir los datos a la base de datos
         * @param   texto   nombre de usuario ingresado por el usuario
         * @param   texto   contraseña ingresada por el usuario
         * @param   texto   correo ingresado por el usuario
         * @param   entero  selección de la foto de perfil por el usuario
         * @return  entero   ID del usuario creado
         *                  -1 = Cuenta no creada
         */
        static function crearCuenta($nickIngresado, $contrasenaIngresada, $correoIngresado, $fotoPerfilIngresada){
            $crearCuenta = 1;
            $almacenarDatos = [$nickIngresado, $contrasenaIngresada, $correoIngresado, $fotoPerfilIngresada];            //Se almacenan los valores en un diccionario para un uso mas autonomo
            
            for($i=0; $i<count($almacenarDatos); $i++){
                if($almacenarDatos[$i] == $contrasenaIngresada){
                    $contrasena = self::validarDatosCuenta($almacenarDatos[$i], $i);    //Obtener la contraseña encriptada
                    if($contrasena == -1){
                        $crearCuenta = -1;          //Valores no validos se les niega el intento de subida a la BD
                        break;
                    }
                } else if(self::validarDatosCuenta($almacenarDatos[$i], $i) == -1){
                    $crearCuenta = -1;              //Valores no validos se les niega el intento de subida a la BD
                    break;
                }
            }
            if($crearCuenta == 1){              //Subida de información básica a la BD
                self::enviarInfoCuenta ($nickIngresado, $fotoPerfilIngresada, $contrasena, $correoIngresado);
                $crearCuenta = mInicioSesion::comprobarDatosInicioSesion($nickIngresado,$contrasena);        //Almacena el ID del usuario
            }
            echo "<script>console.log('cCuentaCrear::crearCuenta')</script>";
            return $crearCuenta;
        }
// ------- VALIDAR DATOS -----------------------------------------------------------------
        /**
         * Validar el dato ingresado por el usuario al momento de crear una cuenta
         * @param   texto   Dato ingresado por el usuario
         * @param   entero  Metodo que se usarapa para validar el dato ingresado
         *                      0 = Nombre Usuario
         *                      1 = Contraseña
         *                      2 = Correo
         *                      3 = Foto Perfil
         * @return  entero   1 = Dato válido para su uso
         *                  -1 = Dato no válido para su uso
         *          texto   ¿? = Contraseña encriptada
         */
        static function validarDatosCuenta($datoIngresado, $datoSeleccionar){
            $crearCuenta = -1;                          // BLOQUEO --- No crear cuenta
            if($datoSeleccionar == 0){                          // 0 = Comprobar Nick(Nombre Usuario)
                if(self::crearNick($datoIngresado) == 1){       
                    $crearCuenta = 1;                   // LLAVE --- Crear cuenta
                }
            } else if($datoSeleccionar == 1){                   // 1 = Comprobar Contraseña 
                $contrasena = self::crearContrasena($datoIngresado);      //Contraseña encriptada
                if( $contrasena != -1){
                    $crearCuenta = 1;                   // LLAVE --- Crear cuenta
                }
            } else if($datoSeleccionar == 2){                   // 2 = Comprobar Correo
                if(self::crearCorreo($datoIngresado) == 1){
                    $crearCuenta = 1;                   // LLAVE --- Crear cuenta
                }
            } else if($datoSeleccionar == 3){                   // 3 = Comprobar ID Foto Perfil
                if(self::seleccionarFotoPerfil($datoIngresado) == 1){
                    $crearCuenta = 1;                   // LLAVE --- Crear cuenta
                }
            }

            if($crearCuenta == 1 && $datoSeleccionar == 1){
                $crearCuenta = $contrasena;     //Reemplazar $crearCuenta por la contrasena encritada para poder retornarla
            }

            echo "<script>console.log('cCuentaCrear::validarDatosCuenta')</script>";
            return $crearCuenta;
        }
// ------- COMPROBAR CORREO / CONTRASEÑA / NICK / FOTO_PERFIL-----------------------------
        /**
         * Se comprueba el correo ingresado por el usuario para la creación de la cuenta
         * @param   texto   correo ingresado por el usuario
         * @return  entero  (Número entero) = correo ingresado no válido para su uso
         *          texto   correo validado y listo para su uso 
         */
        static function crearCorreo($correoIngresado){
            $correoObtenido = -1;

            if(cUsuario::pedirDatos($correoIngresado, 2) == 1){      // 2 = Evaluar correo  (Tamaño)
                if(self::comprobarCorreoRepetido($correoIngresado) == 0){
                    $correoObtenido = 1;
                }
            }
            echo "<script>console.log('cCrearCuenta::crearCorreo')</script>";
            return $correoObtenido;
        }
        /**
         * Se comprueba la contraseña ingresada por el usuario para la creación de la cuenta
         * @param   texto   contraseña ingresada por el usuario
         * @return  entero  (Número entero) = contraseña ingresada no válida para su uso
         *          texto   contraseña validada y lista para su uso 
         */
        static function crearContrasena($contrasenaIngresada){
            $contrasenaFinal = -1;

            if( cUsuario::pedirDatos($contrasenaIngresada, 3) == 1 ){        // 3 = Evaluar contrasena
                $semilla = cCifradoContrasena::generarSemilla();
                $contrasenaHasheada = cCifradoContrasena::hashearContrasena($contrasenaIngresada, $semilla);
                $contrasenaFinal = cCifradoContrasena::incrustarSemilla($contrasenaHasheada, $semilla);
            }

            echo "<script>console.log('cCrearCuenta::crearContrasena')</script>";
            return $contrasenaFinal;
        } 
        /**
         * Se comprueba el nombre de usuario (Nick = Nickname) ingresado por el usuario para la 
         * creación de la cuenta
         * @param   texto   Nick ingresado por el usuario
         * @return  entero  -1 = Nick ingresada no válida para su uso
         *                   1 = Nick validada y lista para su uso 
         */
        static function crearNick($nickIngresado){
            $nickObtenido = -1;
            if(cUsuario::pedirDatos($nickIngresado, 1) == 1){       // 1 = Evaluar nombre usuario
                if (self::comprobarNickRepetido($nickIngresado) == 0){
                    $nickObtenido = 1;
                }
            }
            echo "<script>console.log('cCrearCuenta::crearNick')</script>";
            return $nickObtenido;
        }
        /**
         * Comprueba que la ID de la foto de perfil exista
         * @param   entero  ID de la foto de perfil ingresada
         * @return  entero  (Número entero) = ID de la foto de perfil no encontrada
         *                  ID de la foto de perfil obtenida
         */
        static function seleccionarFotoPerfil($fotoPerfilIngresada){
            $fotoPerfilObtenida = cUsuario::pedirIDFotoPerfil($fotoPerfilIngresada);
            echo "<script>console.log('cCrearCuenta::seleccionarFotoPerfil')</script>";
            return $fotoPerfilObtenida;
        }
//----------------------------------------------------------------------------------------
    }