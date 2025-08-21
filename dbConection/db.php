<?php
$email = $_POST['Email'];
$contraseña = $_POST['Contraseña'];

// conexión a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'dbvmng');

$consulta = "SELECT * FROM users WHERE Email='$email' AND Contraseña='$contraseña'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_num_rows($resultado);

if ($filas > 0) {
    header("Location: ../menu/index.html");
} else {
    echo "Error en la autenticación";
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>