<?php
$tiposTienda = array(
    "Tienda de Deporte",
    "Tienda de juegos de mesa y otros"
);
$cantTiposTiendaStart = 1;
$cantTiposTienda = 2; //empezar desde 1

$tipos = array(
    "deportivo",
    "ocio"
);
$cantTiposStart = 1;
$cantTipos = 2; //empezar desde 1

$deportes = array(
    "Voleibol",  //1 
    "Baloncesto",//2 
    "Futbol",//3
    "Tenis",//4
    "Patinaje",//5
    "Artes Marciales",//6
    "Golf",//7
    "Bolos",//8
    "Boxeo",//9
    "Microfutbol",//10
    "Ping Pong",//11
    "Balonmano",//12
    "Waterpolo",//13
    "Beisbol",//14
    "Criquet",//15
    "Polo",//16
    "Rugby",//17
    "Hockey sobre Pasto",//18
    "Hockey sobre Hielo",//19
    "Ciclismo de montaña",//20
    "Ciclismo BMX",//21
    "Esquí",//22
    "Motocross",//23
    "Futbol Americano",//24
    "Patinaje sobre hielo"//25
);
$cantDeportesStart = 1;
$cantDeportes = 25; //empezar desde 1

$hintDeportesGrupal = array(//describe la cantidad maxima de participantes que puede haber
    "Actividad por equipos de 6 jugadores/ se pueden inscribir maximo 12 personas",//1 
    "Actividad por equipos de 5 jugadores / se pueden inscribir maximo 10 personas",//2
    "Actividad por equipos de 11 jugadores / se pueden inscribir maximo 22 personas",//3 
    "Actividad individual / se pueden inscribir maximo 8 personas",//4
    "Actividad individual / se pueden inscribir maximo 8 personas",//5
    "Actividad individual / se pueden inscribir maximo 8 personas",//6
    "Actividad individual / se pueden inscribir maximo 8 personas",//7
    "Actividad individual / se pueden inscribir maximo 8 personas",//8
    "Actividad individual / se pueden inscribir maximo 8 personas",//9
    "Actividad por equipos de 5 jugadores / se pueden inscribir maximo 10 personas",//10
    "Actividad individual / se pueden inscribir maximo 8 personas",//11
    "Actividad por equipos de 7 jugadores / se pueden inscribir maximo 14 personas",//12
    "Actividad por equipos de 7 jugadores / se pueden inscribir maximo 14 personas",//13
    "Actividad por equipos de 9 jugadores / se pueden inscribir maximo 18 personas",//14
    "Actividad por equipos de 11 jugadores / se pueden inscribir maximo 22 personas",//15
    "Actividad individual / se pueden inscribir maximo 8 personas",//16
    "Actividad por equipos de 7 jugadores / se pueden inscribir maximo 14 personas",//17
    "Actividad por equipos de 11 jugadores / se pueden inscribir maximo 22 personas",//18
    "Actividad por equipos de 6 jugadores/ se pueden inscribir maximo 12 personas",//19
    "Actividad individual / se pueden inscribir maximo 8 personas",//20
    "Actividad individual / se pueden inscribir maximo 8 personas",//21
    "Actividad individual / se pueden inscribir maximo 8 personas",//22
    "Actividad individual / se pueden inscribir maximo 8 personas",//23
    "Actividad por equipos de 11 jugadores / se pueden inscribir maximo 22 personas",//24
    "Actividad individual / se pueden inscribir maximo 8 personas"//25
);
$hintDeportesTorneo = array(
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//1
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//2
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//3
    "Torneo individual / se pueden inscribir maximo 50 participantes",//4
    "Torneo individual / se pueden inscribir maximo 50 participantes", //5
    "Torneo individual / se pueden inscribir maximo 50 participantes",//6
    "Torneo individual / se pueden inscribir maximo 50 participantes",//7
    "Torneo individual / se pueden inscribir maximo 50 participantes",//8
    "Torneo individual / se pueden inscribir maximo 50 participantes",//9
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//10
    "Torneo individual / se pueden inscribir maximo 50 participantes",//11
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//12
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//13
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//14
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//15
    "Torneo individual / se pueden inscribir maximo 50 participantes",//16
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//17
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//18
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//19
    "Torneo individual / se pueden inscribir maximo 50 participantes",//20
    "Torneo individual / se pueden inscribir maximo 50 participantes",//21
    "Torneo individual / se pueden inscribir maximo 50 participantes",//22
    "Torneo individual / se pueden inscribir maximo 50 participantes",//23
    "Torneo por equipos / se pueden inscribir maximo 30 equipos",//24
    "Torneo individual / se pueden inscribir maximo 50 participantes"//25
);
//===========================================
$ocio = array(
    "Karaoke",//101
    "Juegos de Tablero",//102
    "Juegos de Cartas",//103
    "Videojuegos"//104
);
$cantOcioStart = 101;
$cantOcio = 104; //empezar desde 101
$hintOcioGrupal = array(//Describe la cantidad maxima de participantes que puede haber
    "Actividad individual / se pueden inscribir maximo 8 personas",//101
    "Actividad individual / se pueden inscribir maximo 8 personas",//102
    "Actividad individual / se pueden inscribir maximo 8 personas",//103
    "Actividad individual / se pueden inscribir maximo 8 personas"//104
);
$hintOcioTorneo = array(//Describe la cantidad maxima de participantes que puede haber
    "Torneo individual / se pueden inscribir maximo 30 participantes",//101
    "Torneo individual / se pueden inscribir maximo 30 participantes",//102
    "Torneo individual / se pueden inscribir maximo 30 participantes",//103
    "Torneo individual / se pueden inscribir maximo 30 participantes"//104
);
//===========================================
$masivos = array(
    "Concierto",//201
    "Teatro",//202
    "Festival Cultural",//203
    "Festival",//204
    "Feria",//205
    "Partido o competicion",//206
    "Carrera"//207
);
$cantMasivosStart = 201;
$cantMasivos = 207; //Empezar desde 201
$hintMasivos = array(
    "",//201
    "",//202
    "",//203
    "",//204
    "",//205
    "",//206
    ""//207
);

// ------------------------   
$actividades = [
    $deportes,
    $ocio
];

for($i=0; $i<count($actividades); $i++){
    for($j=0; $j<count($actividades[$i]); $j++){
        $sport_sinEspacio[$i][$j] = str_replace(" ", "_", $actividades[$i][$j]);
    }
}


// ---DE JHOY-------
$j = 1;
for($i=0; $i<count($deportes); $i++){
    $value_deportes[$i] = $j;
    $posicion_deportes[$j] = $deportes[$i];
    $j += 1;
}
$k = 101;
for($i=0; $i<count($ocio); $i++){
    $value_ocio[$i] = $k;
    $posicion_ocio[$k] = $ocio[$i];
    $k += 1; 
}
$l = 201;
for($i=0; $i<count($masivos); $i++){
    $value_masivos[$i] = $l;
    $posicion_masivos[$l] = $masivos[$i];
    $l += 1;
}
// Listas de los valores segun la actividad
$value_actividades = [
    $value_deportes,
    $value_ocio     
];

$posicionActividad = [
    $posicion_deportes,
    $posicion_ocio
];