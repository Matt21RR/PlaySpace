<?php
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');
    
    /**
     * Pedir la lista de personas que asistieron a un evento.
     * @param   numero  id del evento
     * @return  lista   lista de participantes que asistieron al evento
     */
    function pedirListaAsistentes($ID_EVENTO){
        $connect=conexionBaseDatos();
        $sql = "SELECT ASISTIO FROM PARTICIPANTES_EVENTO WHERE ID_EVENTO='$ID_EVENTO'";
        $result = $connect->query($sql);
        $posicion = 0;
        while ($fila = mysqli_fetch_assoc($result)){
            $lista_participantes[$posicion] = $fila ['ID_EVENTO'];
            $posicion++;
        }
        echo "<script>console.log('mFinEvento::pedirListaAsistentes-> Cantidad de participantes: $posicion')</script>";
        $connect->close();
        return $lista_participantes;

    }