<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<style>
 
	        #map
	        {
	            width: 100%;
	            height: 300px;
	            border: 1px solid #d0d0d0;
	        }
 
</style>

<script>
	 function localize()
		{
		 	if (navigator.geolocation)
			{
                navigator.geolocation.getCurrentPosition(mapa);
            }
            else
            {
                alert("Tu navegador no soporta geolocalizacion.");
            }
		}
 
		function mapa(pos)
		{
		/************************ Aqui están las variables que te interesan***********************************/
			var latitudUser = '<?php echo $coordsAct[0]; ?>'
			var longitudUser = '<?php echo $coordsAct[1]; ?>'
			var ubiUsuario = new google.maps.LatLng(latitudUser,longitudUser);

            var latitudObjetivo = '<?php echo $coords[0]; ?>'
			var longitudObjetivo = '<?php echo $coords[1]; ?>'
            var ubiObjetivo = new google.maps.LatLng(latitudObjetivo,longitudObjetivo);
            document.getElementById("latCustom").value = '<?php echo $coords[0]; ?>'
            document.getElementById("lonCustom").value = '<?php echo $coordsAct[1]; ?>'
 
            var contenedor = document.getElementById("map")

			var propiedades =
			{
                zoom: 15,
                center: ubiUsuario,
                mapTypeId: google.maps.MapTypeId.ROADMAP
			};
 
			var map = new google.maps.Map(contenedor, propiedades);
 
			var posActual = new google.maps.Marker({/*MARCADOR POSICION ACTUAL*/
                position : ubiUsuario,
                draggable: false,
                map: map,
                title: "Tu posicion actual"
            });

			var marcador = new google.maps.Marker({ /*MARCADOR MOVIL*/
                position : ubiObjetivo,
                draggable: false,
                map: map,
                title: "Lugar seleccionado"
            });
		}
 </script>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body onLoad="localize()">
			<div id="map" ></div> 
            <a href="<?php $nomArch ?>">Seleccionar una nueva Ubicacion</a>
            <form action = "cEventoCrear.php" method="$_GET">
                <input type="hidden" id="latCustom" name="latCustom">
                <input type="hidden" id="lonCustom" name="lonCustom">
                <input type="submit" value="Confirmar ubicacion y continuar">
            </form>
        </body>
        </html>