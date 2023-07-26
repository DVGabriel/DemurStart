<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inicio Sesión</title>
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="shortcut icon" href="../../img/DemurStart Technology logo.jpg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>

    <div class="login-box">
      <img src="../../img/DemurStart Technology logo.jpg" class="avatar" alt="Avatar Image">
      <h1>Inicio de Sesión</h1>
      <form action="../../php/login/validacion_login.php" method="POST">
        <!-- USERNAME INPUT -->
        <label for="username">Usuario</label>
        <input type="text" placeholder="Enter Username" name="username">
        <!-- PASSWORD INPUT -->
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Enter Password" name="password">
        <input type="submit" value="Log In">
        <a href="#">Olvidaste la contraseña?</a><br>
        <a href="#">No tienes cuenta?</a>
      </form>
    </div>
  </body>
</html>