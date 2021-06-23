<?php
    include_once('../mMaster.php');
    include_once('../mBaseDatos.php');

    class mBusqueda{
        static function pedirBusquedaEventos($coordLatUsuario,$coordLonUsuario,$distancia){
            $INFO_LOC_EVENTO[0][0]=-1;
            $posX=0;
            $connect = conexionBaseDatos();
            $sql = "CALL SP_BUSQUEDA_EVENTO(".$coordLatUsuario.",".$coordLonUsuario.",".$distancia.");";
            $result = $connect ->query($sql);
            while ($fila = mysqli_fetch_assoc($result)) {
                $INFO_LOC_EVENTO[$posX][0] = $fila['ID_EVENTO'];//id del evento
                $INFO_LOC_EVENTO[$posX][1] = $fila['UBICACION_LAT']; //coordenadas de latitud del evento
                $INFO_LOC_EVENTO[$posX][2] = $fila['UBICACION_LON']; //coordenadas de longitud del evento
                $INFO_LOC_EVENTO[$posX][3] = $fila['DISTANCIA']; //distancia que hay entre la ubi del usuario y la ubi del evento;
                $posX++;
            }
            $connect -> close();
            echo "<script>console.log('mBusqueda::pedirBusquedaEventos->".$posX."')</script>";
            return $INFO_LOC_EVENTO;
        }
        static function pedirBusquedaTiendas($coordLatUsuario,$coordLonUsuario,$distancia){
            $INFO_LOC_TIENDA[0][0]=-1;
            $posX=0;
            $connect = conexionBaseDatos();
            $sql = "CALL SP_BUSQUEDA_TIENDA(".$coordLatUsuario.",".$coordLonUsuario.",".$distancia.");";
            $result = $connect ->query($sql);
            while ($fila = mysqli_fetch_assoc($result)) {
                $INFO_LOC_TIENDA[$posX][0] = $fila['ID_TIENDA'];//id del evento
                $INFO_LOC_TIENDA[$posX][1] = $fila['UBICACION_LAT']; //coordenadas de latitud del evento
                $INFO_LOC_TIENDA[$posX][2] = $fila['UBICACION_LON']; //coordenadas de longitud del evento
                $INFO_LOC_TIENDA[$posX][3] = $fila['DISTANCIA']; //distancia que hay entre la ubi del usuario y la ubi del evento;
                $posX++;
            }
            $connect -> close();
            echo "<script>console.log('mBusqueda::pedirBusquedaTiendas->".$posX."')</script>";
            return $INFO_LOC_TIENDA;
        }
    }