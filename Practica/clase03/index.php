<?php
include "./objeto.php ";

$personas = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["legajo"])) {
        $persona = new stdClass();
        $persona->nombre = $_POST["nombre"];
        $persona->apellido = $_POST["apellido"];
        $persona->legajo = $_POST["legajo"];
        array_push($personas,$persona);
        Objeto::Guardar("./archivo.txt",$personas);
    }
}

/*if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $personas = Objeto::Listar("./archivo.txt",$variables);    
    echo json_encode($personas);
}*/
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $personas = Objeto::Listar("./archivo.txt");    
    echo $personas;
}
