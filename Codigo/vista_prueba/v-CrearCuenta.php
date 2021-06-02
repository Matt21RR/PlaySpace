<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
</head>
<body>
    <h1>Crear Cuenta</h1>
    <form action="c-CrearCuenta.php" method="POST">  
        <input type="text" placeholder="Foto Perfil" name="ID_foto"><br>
        <input type="text" placeholder="Nombre de Usuario" name="usuario"><br>
        <input type="text" placeholder="Correo Electrónico" name="correo"><br>
        <input type="password" placeholder="Contraseña" name="contrasena"><br>

        <input type="submit" value="Crear Cuenta">
    </form>
</body>
</html> 