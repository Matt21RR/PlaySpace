<?php
$tamaño=0;
$marcha=0;
$velocidad=0;
$velocidadpeligro=325;

while($velocidad <= $velocidadpeligro){
	$marcha++;
	$velocidad = $marcha* 25;


	if($tamaño>5){
		$tamaño=0;
	}
	$tamaño++;

	echo ("<h".$tamaño.">");
	echo ("Marcha: <b>".$marcha."</b> | Velocidad: <b>".$velocidad."km/h.</b>");
	echo("<p>");
	echo ("</h".$tamaño.">");


	if($velocidad>$velocidadpeligro){
		echo("Su vehiculo ha superado los <a style='color:red'>".$velocidadpeligro."km/h</a>");
	}
}
