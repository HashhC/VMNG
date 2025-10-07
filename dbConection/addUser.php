<?php
    include "../dbConection/conexionbd.php";
    if(($_SERVER["REQUEST_METHOD"] == "POST")){

        $Nombre_usuario = trim($_POST['name']);
        $Apellido_usuario = trim($_POST['lastName']);
        $Email_usuario = trim($_POST['email']);
        $Contraseña_usuario = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $Rol = trim($_POST['rol']);

        if (!empty($Nombre_usuario) && !empty($Apellido_usuario) && !empty($Email_usuario) && !empty($Contraseña_usuario)) {
            $Fecha_creación = date("Y-m-d H:i:s");

            $stmt = mysqli_prepare($conn, "INSERT INTO usuario (Nombre_usuario, Apellido_usuario, Email_usuario, Contraseña_usuario, Rol, Fecha_creación) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "iiiiii", $Nombre_usuario, $Apellido_usuario, $Email_usuario, $Contraseña_usuario, $Rol, $Fecha_creación);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                echo '<div class="alert alert-success">Usuario agregado correctamente</div>';
                header("Location: ../dashboard/tables.php");
            exit;

            }else{
                echo '<div class="alert alert-danger">Error al agregar usuario</div>';
            }
            
            }else{
                echo '<div class="alert alert-warning">Los campos estan vacios</div>';
        }
    }
?>