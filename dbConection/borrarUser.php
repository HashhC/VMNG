<?php
    include "../dbConection/conexionbd.php";
    if(($_SERVER["REQUEST_METHOD"] == "POST")){

        $ID_usuario = trim($_POST['id']);

        if (!empty($ID_usuario)) {

            $stmt = mysqli_prepare($conn, "DELETE FROM usuario WHERE ID_usuario = ?");
            mysqli_stmt_bind_param($stmt, "i", $ID_usuario);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                echo '<div class="alert alert-success">Usuario eliminado correctamente</div>';
                header("Location: ../dashboard/tables.php");
            exit;

            }else{
                echo '<div class="alert alert-danger">Error al eliminar usuario</div>';
            }
            
            }else{
                echo '<div class="alert alert-warning">El campo ID esta vacio</div>';
        }
    }
?>