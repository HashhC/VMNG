<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = trim($_POST['name']);
    $apellido = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $contrasena = trim($_POST['password']);

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($apellido) && !empty($email) && !empty($contrasena)) {
        
        
        $fecha = date("Y-m-d H:i:s");

        // Conectar a la BD
        $conexion = mysqli_connect("localhost", "root", "", "vmng");

        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        // Sentencia
        $stmt = mysqli_prepare($conexion, "INSERT INTO usuario (Nombre_usuario, Apellido_usuario, Email_usuario, Contraseña_usuario, Fecha_creación) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $email, $contrasena, $fecha);

        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conexion);

            // Redirigir a página de inicio si registro es exitoso
            header("Location: ../Menu/index.html");
            exit();
        } else {
            echo "<h3 class='error'>Error al registrar: " . mysqli_error($conexion) . "</h3>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    } else {
        echo "<h3 class='error'>Por favor completa todos los campos.</h3>";
    }
}
?>
