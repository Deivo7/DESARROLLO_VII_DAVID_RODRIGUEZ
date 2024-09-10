<?php 
$nombre = "David";
$edad = 23;
$correo = "dfrb2914@gmail.com";
$telefono = "6771-0327"; 

define("PROFESION", "estudiante");

$present = "mi nombre es: $nombre tengo $edad años  y soy un ".  PROFESION .  "." ; 

echo $present . "<br>";

?>