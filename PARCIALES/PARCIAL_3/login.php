<?php
session_start();

// Si ya hay una sesión activa, redirigir al panel correspondiente
if(isset($_SESSION['usuario'])) {
    header("Location: " . ($_SESSION['rol'] === 'profesor' ? 'panel_profesor.php' : 'panel_estudiante.php'));
    exit();
}

// Función para validar el nombre de usuario
function validarUsuario($usuario) {
    return (strlen($usuario) >= 3 && 
            preg_match('/[A-Za-z]/', $usuario) && 
            preg_match('/[0-9]/', $usuario));
}

//Funcion para validar caracteres de la contraseña
function validarContra($contrasena){
    return(sterlen($contrasena)) >=5 &&
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if (!validarUsuario($usuario)) {
        $error = "El nombre de usuario debe tener al menos 3 caracteres y contener letras y números.";
    } else {
        // En un caso real, verificaríamos contra una base de datos
        if($usuario === "profesor1" && $contrasena === "prof1234") {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = 'profesor';
            header("Location: panel_profesor.php");
            exit();
        } elseif($usuario === "estudiante1" && $contrasena === "est1234") {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = 'estudiante';
            header("Location: panel_estudiante.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
    <form method="post" action="">
        <label for="usuario">Usuario (al menos 3 caracteres, incluyendo letras y números):</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
