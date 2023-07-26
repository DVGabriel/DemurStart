<?php
include_once "../conexion.php";

$intentosMaximos = 5;

$username = $_POST['username'];
$password = $_POST['password'];

$username = mysqli_real_escape_string($conexion, $username);

$sql = "SELECT * FROM usuarios WHERE usuario='$username'";
$result = mysqli_query($conexion, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $passwordFromDB = $row['clave']; // Contraseña sin hashing

    if ($row['intentos_fallidos'] >= $intentosMaximos) {
        echo "La cuenta está bloqueada temporalmente debido a demasiados intentos fallidos. Inténtalo más tarde.";
        exit;
    }

    if ($password === $passwordFromDB) { // Verificar la contraseña sin hashing
        // Restablecer el contador de intentos fallidos en caso de inicio de sesión exitoso
        $sql_reset_intentos = "UPDATE usuarios SET intentos_fallidos = 0 WHERE usuario='$username'";
        mysqli_query($conexion, $sql_reset_intentos);

        $cargo = $row['usuario_privilegio'];

        if ($cargo == 1) {
            header("Location: ../../page/administradores/dashboard_admin/administracion.html");
        } elseif ($cargo == 2) {
            header("Location: ../../page/trabajador/Trabajador.php");
        } else {
            echo "No se puede determinar el cargo del usuario.";
        }
        exit;
    } else {
        // Incrementar el contador de intentos fallidos
        $intentos_fallidos_actuales = $row['intentos_fallidos'] + 1;
        $sql_update_intentos = "UPDATE usuarios SET intentos_fallidos = $intentos_fallidos_actuales WHERE usuario='$username'";
        mysqli_query($conexion, $sql_update_intentos);

        echo "Credenciales incorrectas. Intento de inicio de sesión fallido $intentos_fallidos_actuales de $intentosMaximos.";

        // Bloquear la cuenta si se alcanza el número máximo de intentos fallidos
        if ($intentos_fallidos_actuales >= $intentosMaximos) {
            $tiempoBloqueo = 5 * 60; // Bloquear durante 5 minutos (puedes ajustar el tiempo según tus necesidades)
            $sql_bloquear_cuenta = "UPDATE usuarios SET intentos_fallidos = 0, bloqueo_tiempo = NOW() + INTERVAL $tiempoBloqueo SECOND WHERE usuario='$username'";
            mysqli_query($conexion, $sql_bloquear_cuenta);
            echo "La cuenta ha sido bloqueada temporalmente debido a demasiados intentos fallidos. Inténtalo más tarde.";
        }
    }
} else {
    // Usuario no encontrado
    echo "Credenciales incorrectas";
}

mysqli_close($conexion);
?>
