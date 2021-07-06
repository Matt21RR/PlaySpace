<?php 
  if(!isset($_SESSION))session_start();
  if(!isset($_SESSION['ID_USUARIO'])){
    header("location: ./pIniciarSesion.php");
    die;
  }
  if(!isset($titleSection)){ //TITULO POR DEFECTO
    $titleSection = "PlaySpace";
  }
  

?> <!-- COMPROBAR QUE HAYA UNA CUENTA INICIADA-->
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link href="./css/bootstrap.css" rel="stylesheet">
      
      <link rel="stylesheet" type="text/css" href="./css/style.css">
      <title>Document</title>
  </head>
  <body>

  <div class="navbar navbar-fixed-top" style="position:fixed; top:0; width: 100%; z-index:2;">
      <div class="navbar-inner">
          <ul class="nav">
              <span onclick="openNav()"><img src="./svg/menu.svg" class="menuico" style="padding-left:10px; margin-left: 4px; margin-right:0px;"></span>
              <div class="mainTitle col text-truncate"><?php echo $titleSection; ?></div>
          </ul>
      </div>
  </div>


  <!-- Use any element to open the sidenav -->

  <div id="mySidenav" class="sidenav">
    <div class="container">
      <a href="javascript:void(0)" class="closebtn overflow-hidden"onclick="closeNav()">
        <img src="./svg/menu.svg" class="menuico" style="margin-right: 0px;">
        <div class="container my-auto px-0">
          Menu
        </div>
      </a>
    </div>
    
    <div class="userInformation">
      <div class="row">
        <div class="col-4" >
          <img id="userPhoto" class="userPhoto" src="./png/foto_perfil/<?php echo $_SESSION['ID_FOTO_PERFIL']; ?>.png" style="width:0;"><!--ID DE FOTO DE PERFIL AQUI-->
        </div>
        <div class="col-8" >
            <div class="sectionText" style="padding-top:10px;">
              <?php echo $_SESSION['NOMBRE_USUARIO']; ?><!--NICKNAME AQUI-->
            </div>
          <div class="sectionText">
            ID - <?php echo $_SESSION['ID_USUARIO']; ?><!--ID AQUI-->
          </div>
          <a href="../controladorVista/cvArquitecto.php?seccion=-1" style="height:unset; margin:unset; border:unset; padding:0px;">
            <div class="shutdown"></div>
          </a>
          
          
        </div>
      </div>
      
        
    </div>
    <hr width="90%" size=4 noshade="noshade">
    <a class= "overflow-hidden" href="../controladorVista/cvArquitecto.php?seccion=1"><img src="./png/menuIcons/Perfil.svg" class="menuico"><div class="sectionText">Perfíl</div></a>
    <a class= "overflow-hidden" href="../controladorVista/cvArquitecto.php?seccion=2"><img src="./png/menuIcons/Amigos.svg" class="menuico"><div class="sectionText">Amigos</div></a>
    <a class= "overflow-hidden" href="../controladorVista/cvArquitecto.php?seccion=3"><img src="./png/menuIcons/Evento.svg" class="menuico"><div class="sectionText">Eventos</div></a>
    <a class= "overflow-hidden" href="../controladorVista/cvArquitecto.php?seccion=4"><img src="./png/menuIcons/Mapa.svg" class="menuico"><div class="sectionText">Mapa y Búsqueda</div></a>
    <hr width="90%" size=4 noshade="noshade">
    <a class= "overflow-hidden" href="../controladorVista/cvArquitecto.php?seccion=5"><img src="./png/menuIcons/Evento.svg" class="menuico"><div class="sectionText">Eventos Creados</div></a>
    <!--Anulado Temporalmente-->
    <!--<a class= "overflow-hidden" href="../controladorVista/cvArquitecto.php?seccion=6"><img src="./png/menuIcons/Tienda.svg" class="menuico"><div class="sectionText">Tiendas Creadas</div></a>-->
  </div>


  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->


  <script src="./js/menu.js">

  </script>

  </body>
</html>