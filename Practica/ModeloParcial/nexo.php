<?php
include_once "./alumno.php";
include_once "./materia.php";
include_once "./manejador.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_POST["accion"]) {
        case 'cargarAlumno':
            if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_FILES["foto"])) {
                $alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["email"]);
                Manejador::GuardarAlumno($alumno, $_FILES["foto"]);
            }
            break;
        case 'cargarMateria':
            if (isset($_POST["materia"]) && isset($_POST["codigo"]) && isset($_POST["cupo"]) && isset($_POST["aula"])) {
                $materia = new Materia($_POST["materia"], $_POST["codigo"], $_POST["cupo"], $_POST["aula"]);
                Manejador::GuardarMateria($materia);
            }
            break;
        case 'inscribirAlumno':
            break;

    }} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["apellido"])) {
        echo (Manejador::BuscarAlumnosApellido($_GET["apellido"]));
    }
}
