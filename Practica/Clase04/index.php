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
                    $persona->imagen = Archivo::GuardarArchivo($_FILES["imagen"], "./Imagenes/", $persona->legajo);
                }
                array_push($personas, $persona);
                Objeto::Guardar("./archivo.json", $personas);
                break;
            case 'modificar':
                for ($i=0; $i < count($personas); $i++) {
                    if ($persona->Equals($personas[$i])) {
                        if (isset($_FILES["imagen"])) {
                            $expl = explode("/", $personas[$i]->imagen);
                            $raiz = Objeto::GenerarRaiz($expl);
                            Archivo::BackUpArchivo($raiz,"./BackUp/", $expl[count($expl)-1]);
                            $persona->imagen = Archivo::GuardarArchivo($_FILES["imagen"], "./imagenes/", $persona->legajo);
                        } else {
                            $persona->imagen = $personas[$i]->imagen;
                        }
                    }
                }
                Objeto::Modificar("./archivo.json", $personas, $persona);
                break;
            case 'borrar':
            foreach ($personas as  $value) {
                if ($persona->Equals($value)) {
                    $expl = explode("/",$value->imagen);
                    $raiz = $raiz = Objeto::GenerarRaiz($expl);
                    Archivo::BorrarArchivo($raiz,$expl[count($expl)-1]);
                    Archivo::BorrarArchivo("./BackUp/",$expl[count($expl)-1]);
                    Objeto::Borrar("./archivo.json", $personas, $persona);
                }
            }
                
                break;
        }
    }
}

/*if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $personas = Objeto::Listar("./archivo.txt",$variables);
    echo json_encode($personas);
}*/
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // $raiz = "";
    $base = json_decode(Objeto::Listar("./archivo.json"));
    if (count($base) > 0) {
        $personas = Persona::CargarArray($base);
    }
    echo json_encode($personas);
    // for ($i=0; $i < count($personas); $i++) {
    //     var_dump($expl = explode("/", $personas[$i]->imagen));
    //     for ($j=0; $j < count($expl)-1; $j++) {
    //         $raiz =$raiz.$expl[$j]."/";
    //     }
    // }
    // echo($raiz);
}
