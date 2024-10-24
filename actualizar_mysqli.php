<?php
require_once "config_mysqli.php";

// Actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
    
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssi", $nombre, $email, $id);
        
        if ($stmt->execute()) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar: " . $mysqli->error;
        }
        $stmt->close();
    }
}

// Eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM usuarios WHERE id = ?";
    
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo "Registro eliminado con éxito.";
        } else {
            echo "Error al eliminar: " . $mysqli->error;
        }
        $stmt->close();
    }
}

$mysqli->close();
?>

<!-- Formulario de actualización -->
<form method="post">
    <input type="hidden" name="id" value="1">
    <input type="text" name="nombre" placeholder="Nuevo nombre">
    <input type="email" name="email" placeholder="Nuevo email">
    <input type="submit" name="actualizar" value="Actualizar">
</form>

<!-- Formulario de eliminación -->
<form method="post">
    <input type="hidden" name="id" value="1">
    <input type="submit" name="eliminar" value="Eliminar">
</form>
