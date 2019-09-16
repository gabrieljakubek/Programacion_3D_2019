<?php
include "./objeto.php ";
$personas = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["legajo"])) {
        $personas = json_decode(Objeto::Listar("./archivo.json"));

        $persona = new stdClass();
        $persona->nombre = $_POST["nombre"];
        $persona->apellido = $_POST["apellido"];
        $persona->legajo = $_POST["legajo"];
        array_push($personas, $persona);
        switch ($_POST["accion"]) {
            case 'guardar':
                Objeto::Guardar("./archivo.json", $personas, "legajo");
                break;
            case 'borrar':
                Objeto::Borrar("./archivo.json", $persona, "legajo");
                break;
            case 'modificar':
                Objeto::Modificar("./archivo.json", $persona, "legajo");
                break;

            default:
                # code...
                break;
        }
    }
}

/*if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $personas = Objeto::Listar("./archivo.txt",$variables);    
    echo json_encode($personas);
}*/
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $personas = Objeto::Listar("./archivo.json");
    echo $personas;
}
