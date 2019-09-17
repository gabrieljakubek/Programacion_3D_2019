<?php
include_once "./objeto.php ";
include_once "./archivo.php";
include_once "./persona.php";
$personas = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["legajo"])) {
        $base = json_decode(Objeto::Listar("./archivo.json"));
        if (count($base) > 0) {
            $personas = Persona::CargarArray($base);
        }
        $persona = new Persona($_POST["nombre"], $_POST["apellido"], $_POST["legajo"]);
        switch ($_POST["accion"]) {
            case 'guardar':
                if (isset($_FILES["imagen"])) {
                    $persona->imagen = Archivo::GuardarArchivo($_FILES["imagen"], "./imagenes/", $persona->legajo);
                }
                array_push($personas, $persona);
                Objeto::Guardar("./archivo.json", $personas);
                break;
            case 'modificar':
                Objeto::Modificar("./archivo.json", $personas, $persona);
                break;
            case 'borrar':
                Objeto::Borrar("./archivo.json", $personas, $persona);
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
