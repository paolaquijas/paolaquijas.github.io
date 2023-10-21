<?php
$conexion = mysqli_connect('localhost', 'root', '', 'registro') or die(mysqli_error($mysqli));

if (isset($_POST['enviar'])) {
    insertar($conexion);
}

if (isset($_POST['eliminar']) && isset($_POST['curso'])) {
    $curso = $_POST['curso'];
    eliminar($conexion, $curso);
}

function insertar($conexion){
    if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['curso'])){
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $curso = $_POST['curso'];

        $consulta = "INSERT INTO cursos (nombre, correo, curso) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "sss", $nombre, $correo, $curso);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Registro insertado correctamente.";
        } else {
            echo "Error al insertar registro: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($conexion);
}

function eliminar($conexion, $curso){
    if (isset($curso)) {
        $consulta = "DELETE FROM cursos WHERE curso = ?";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "s", $curso);

        if (mysqli_stmt_execute($stmt)) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al eliminar registro: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    }
}
?>

   
