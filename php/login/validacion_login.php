<?php

include_once "../conexion.php";

$usuario = $_POST['username'];
$contraseña = $_POST['password'];

$username = mysqli_real_escape_string($conexion,$usuario);
$password = mysqli_real_escape_string($conexion,$contraseña);


$sql = "SELECT*FROM usuarios  WHERE usuario='$usuario' AND clave='$contraseña'";



$result = mysqli_query($conexion,$sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $cargo = $row['usuario_privilegio'];

    if ($cargo == 1) {
        header("Location: ../../page/administradores/administracion.php");
    } elseif ($cargo == 2) {
        header("Location: ../../page/trabajador/Trabajador.php");
    } else {
        echo "No se puede determinar el cargo del usuario.";
    }
    exit;
} else {
    echo "Credenciales incorrectas";
}
mysqli_close($conexion);
?>