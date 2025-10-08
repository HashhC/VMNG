<?php
    include "conexionbd.php";
    if(($_SERVER["REQUEST_METHOD"] == "POST")){
        $ID_usuario = trim($_POST['ID_usuario']);
        $Nombre_usuario = trim($_POST['name']);
        $Apellido_usuario = trim($_POST['lastName']);
        $Email_usuario = trim($_POST['email']);
        $Contraseña_usuario = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $Rol = trim($_POST['rol']);

        if (!empty($Nombre_usuario) && !empty($Apellido_usuario) && !empty($Email_usuario) && !empty($Contraseña_usuario)) {
            $stmt = mysqli_prepare($conn, "UPDATE usuario SET Nombre_usuario=?, Apellido_usuario=?, Email_usuario=?, Contraseña_usuario=?, Rol=? WHERE ID_usuario=?");
            mysqli_stmt_bind_param($stmt, "sssssi", $Nombre_usuario, $Apellido_usuario, $Email_usuario, $Contraseña_usuario, $Rol, $ID_usuario);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                echo '<div class="alert alert-success">Usuario modificado correctamente</div>';
                header("Location: ../dashboard/tables.php");
            exit;

            }else{
                echo '<div class="alert alert-danger">Error al modificar usuario</div>';
            }
            
            }else{
                echo '<div class="alert alert-warning">Los campos estan vacios</div>';
        }   
    }
?>