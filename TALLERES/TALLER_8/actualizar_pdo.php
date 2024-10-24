<?php
require_once "config_pdo.php";

// Actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
    
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar: " . $stmt->errorInfo()[2];
        }
    }
}

// Eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM usuarios WHERE id = :id";
    
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "Registro eliminado con éxito.";
        } else {
            echo "Error al eliminar: " . $stmt->errorInfo()[2];
        }
    }
}

// Cerrar la conexión
$pdo = null;
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
