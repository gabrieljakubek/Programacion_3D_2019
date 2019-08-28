<?php
// include "funciones.php";
//include "funcion.php";
#require "funcion.php";
// require_once "funciones.php";
// require_once "clases/persona.php";
include "clases/alumno.php";
// echo "Hola PHP <br>";
// saludar("Pepe <br>");
$persona = new Persona('Pepe',21);
$persona -> saludar();
$alumno = new Alumno('Jorge',24,576,3);
$alumno -> saludar();
?>