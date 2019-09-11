<?php
session_start();
if (!isset($_SESSION["lista"])) {
    $_SESSION["lista"] = null;
}
include "../clase1/clases/persona.php";
include "../clase1/clases/alumno.php";
include "./alumnoDao.php";
$alumnoDao = new AlumnoDao();
if (!isset($_SESSION["lista"])) {
    $alumnos = array(get_object_vars(new Alumno("Pepe", 121345, 4, 2)));
} else {
    $alumnos = json_decode($_SESSION["lista"]);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    for ($i = 0; $i < count($alumnos); $i++) {
        echo $alumnos[$i]->nombre . "<br/>";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre"]) && isset($_POST["dni"]) && isset($_POST["legajo"]) && $_POST["cuatrimestre"]) {
        $alumnos = $alumnoDao->Guardar($alumnos, new Alumno($_POST["nombre"], $_POST["dni"], $_POST["legajo"], $_POST["cuatrimestre"]));
        // for ($i = 0; $i < count($alumnos); $i++) {
        //     echo $alumnos[$i]->nombre . "<br/>";
        // }
        echo json_encode($alumnos);
        $_SESSION["lista"] = json_encode($alumnos);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $alumnos = $alumnoDao->Guardar($alumnos, new Alumno($_POST["nombre"], $_POST["dni"], $_POST["legajo"], $_POST["cuatrimestre"]));
    echo json_encode($alumnos) . "<br/>";
    $alumnos = $alumnoDao->Borrar($alumnos, new Alumno($_DELETE["nombre"], $_DELETE["dni"], $_DELETE["legajo"], $_DELETE["cuatrimestre"]));
    echo json_encode($alumnos);
}
//var_dump($_SERVER);
//session_destroy();
