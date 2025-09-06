<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vmng";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = trim($_POST['name']);
    $apellido = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($apellido) && !empty($email) && !empty($password)) {

        $fecha = date("Y-m-d H:i:s");

        $check_stmt = $conn->prepare("SELECT ID_usuario FROM usuario WHERE Email_usuario = ?"); 
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        // Conectar a la BD
        //$conexion = mysqli_connect("localhost", "root", "", "vmng");

        //if (!$conexion) {
            //die("Conexión fallida: " . mysqli_connect_error());
        //}

        // Sentencia
        $stmt = mysqli_prepare($conn, "INSERT INTO usuario (Nombre_usuario, Apellido_usuario, Email_usuario, Contraseña_usuario, Fecha_creación) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $email, $password, $fecha);

        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            // Redirigir a página de inicio si registro es exitoso
            header("Location: ../Menu/index.html");
            exit();
        } else {
            echo "<h3 class='error'>Error al registrar: " . mysqli_error($conn) . "</h3>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "<h3 class='error'>Por favor completa todos los campos.</h3>";
    }
}
?>
