<?php
session_start();

// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vmng";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Buscar usuario
    $stmt = $conn->prepare("SELECT ID_usuario, Email_usuario, Nombre_usuario, Contraseña_usuario 
                            FROM usuario 
                            WHERE Email_usuario = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar contraseña
        if (password_verify($password, $user['Contraseña_usuario'])) {
            $_SESSION['id'] = $user['ID_usuario'];
            $_SESSION['email'] = $user['Email_usuario'];
            $_SESSION['nombre'] = $user['Nombre_usuario'];

            header("Location: ../menu/index.html?login=success");
            exit();
        } else {
            echo "Correo o contraseña incorrectos";
        }
    } else {
        echo "Correo o contraseña incorrectos";
    }
}
?>