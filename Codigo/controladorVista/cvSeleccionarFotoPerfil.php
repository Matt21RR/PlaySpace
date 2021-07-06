<?php
    //Si se dio click al boton confirmar
    if(isset($_GET['Confirmar'])){
        if(!isset($_SESSION))session_start();
        $_SESSION['id_foto_perfil'] = $_GET['pic'];
    }
    header("location: ../vista/pCuentaCrear.php");