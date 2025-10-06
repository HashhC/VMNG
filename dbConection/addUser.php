<?php
    include "../dbConection/conexionbd.php";
    if(!empty($_POST['btnUser'])){
        if(empty($_POST['Nombre_usuario']) || empty($_POST['Apellido_usuario']) || empty($_POST['Email_Usuario']) || empty($_POST['Contraseña_Usuario']) || empty($_POST['Fecha_creación'])){
            
            $Nombre_usuario = $_POST['Nombre_usuario'];
            $Apellido_usuario = $_POST['Apellido_usuario'];
            $Email_Usuario = $_POST['Email_Usuario'];
            $Contraseña_Usuario = $_POST['Contraseña_Usuario'];
            $Fecha_creación = $_POST['Fecha_creación'];
            $sql = $conn->query("INSERT INTO usuario (Nombre_usuario, Apellido_usuario, Email_Usuario, Contraseña_Usuario, Fecha_creación) VALUES ('$Nombre_usuario', '$Apellido_usuario', '$Email_Usuario', '$Contraseña_Usuario', '$Fecha_creación')");
            if($sql==1){
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