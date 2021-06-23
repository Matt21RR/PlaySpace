<?php
    include_once ('../mBaseDatos.php');
    include_once ("../mMaster.php");
    
    class mPerfil{
        /**
         * Consulta la informacion del usuario
         * @param   numero  la id del usuario a consultar
         * @return  lista   informacion del evento
         */
        static function pedirEstadisticas($ID_USUARIO){
            $connect=conexionBaseDatos();
            $sql="select * from USUARIOS where ID_USUARIO = '$ID_USUARIO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $info_usuario[0] = $fila ['NOMBRE_USUARIO'];
                $info_usuario[1] = $fila ['CONTRASENA'];
                $info_usuario[2] = $fila ['CORREO'];
                $info_usuario[3] = $fila ['CALIFICACION_USUARIO'];
                $info_usuario[4] = $fila ['PARTICIPACIONES'];
                $info_usuario[5] = $fila ['CALIFICACION_EVENTOS'];
                $info_usuario[6] = $fila ['EVENTOS_REALIZADOS'];
                $info_usuario[7] = $fila ['ID_FOTO_PERFIL'];
            }
            $pos_imprimir=0;
            while ($pos_imprimir<7){
                echo "<script>console.log('mPerfil::pedirEstadisticas->$info_usuario[$pos_imprimir]')</script>";
                $pos_imprimir++;
            }
    
            $connect->close();
            return $info_usuario;
        }
    }