<?php
//funcionalidad para cerrar sesión
session_start();
session_destroy();
header("Location: login.php");
exit()