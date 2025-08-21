<?php

$usuario = $_POST['Usuario'];
$contaseña = $_POST ['Contraseña'];

//conexión a la base de datos
$conexion = mysqli_connect('localhost','root','',"dbvmng");
$consulta = "SELECT * FROM usuarios WHERE Usuario = '$usuario ' AND Contraseña = '$contaseña '";

$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_num_rows($resultado);

if ($filas>0){
    header("Location: ../menu/index.html");

}else{
    echo "Error en la autenticación";

}

mysqli_free_result($resultado);
mysqli_close($conexion);
