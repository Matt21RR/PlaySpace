<?php
// --- OBTENCIÓN de información básica del usuario
    // ~ geoplugin_currencyCode = Moneda del país
    $informacionSolicitud = file_get_contents("http://www.geoplugin.net/json.gp?ip=");
    $dataSolicitud = json_decode($informacionSolicitud);    // Almacenar la información como objeto
    $info_IP = (array) $dataSolicitud;  // Convertir la información a Array
    $_SESSION['monedaLocal'] = $info_IP['geoplugin_currencyCode'];  // Obtención de la moneda del país