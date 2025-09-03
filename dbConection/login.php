<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $contrasena = trim($_POST['password']);

    if (!empty($email) && !empty($contrasena)) {
        // Conectar a la BD
        $conexion = mysqli_connect("localhost", "root", "", "vmng");

        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        // Consulta segura
        $stmt = mysqli_prepare($conexion, "SELECT * FROM usuario WHERE Email_usuario = ? AND Contraseña_usuario = ?");
        mysqli_stmt_bind_param($stmt, "ss", $email, $contrasena);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) == 1) {
            // Usuario válido, iniciar sesión
            $usuario = mysqli_fetch_assoc($resultado);
            $_SESSION['usuario'] = $usuario['Nombre_usuario'];

            header("Location: ../Menu/index.html");
            exit();
        } else {
            echo "<h3 class='error'>Correo o contraseña incorrectos</h3>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    } else {
        echo "<h3 class='error'>Completa todos los campos</h3>";
    }
}
?>
