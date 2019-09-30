<?php
include_once "./alumno.php";
include_once "./materia.php";
include_once "./manejador.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_POST["accion"]) {
        case 'cargarAlumno':
            if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_FILES["foto"])) {
                $alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["email"]);
                echo (Manejador::GuardarAlumno($alumno, $_FILES["foto"]));
            }
            break;
        case 'cargarMateria':
            if (isset($_POST["materia"]) && isset($_POST["codigo"]) && isset($_POST["cupo"]) && isset($_POST["aula"])) {
                $materia = new Materia($_POST["materia"], $_POST["codigo"], $_POST["cupo"], $_POST["aula"]);
                echo (Manejador::GuardarMateria($materia));
            }
            break;
        case 'inscribirAlumno':
            if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_POST["materia"]) && isset($_POST["codigo"])) {
                $alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["email"]);
                $materia = new Materia($_POST["materia"], $_POST["codigo"]);
                echo (Manejador::InscribirAlumno($alumno, $materia));
            }
            break;
        case 'modificarAlumno':
            if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_FILES["foto"])) {
                $alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["email"]);
                echo (Manejador::ModificarAlumno($alumno, $_FILES["foto"]));
            } else if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"])) {
                $alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["email"]);
                echo (Manejador::ModificarAlumno($alumno, null));
            }
            break;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    switch ($_GET["accion"]) {
        case 'consultarAlumno':
            if (isset($_GET["apellido"])) {
                echo (Manejador::ListarAlumnos($_GET["apellido"], "apellido"));
            }
            break;
        case 'inscribirAlumno':
            if (isset($_GET["nombre"]) && isset($_GET["apellido"]) && isset($_GET["email"]) && isset($_GET["materia"]) && isset($_GET["codigo"])) {
                $alumno = new Alumno($_GET["nombre"], $_GET["apellido"], $_GET["email"]);
                $materia = new Materia($_GET["materia"], $_GET["codigo"]);
                echo (Manejador::InscribirAlumno($alumno, $materia));
            }
            break;
        case 'inscripciones':
            if (isset($_GET["apellido"])) {
                echo (Manejador::ListarInscripciones($_GET["apellido"], "apellido"));
            } else if (isset($_GET["materia"])) {
                echo (Manejador::ListarInscripciones($_GET["materia"], "materia"));
            } else {
                echo (Manejador::ListarInscripciones(null, null));
            }
            break;
        case 'alumnos':
            echo (Manejador::ListarAlumnos(null, null));
            break;
    }

}
