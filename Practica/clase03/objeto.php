<?php
class Objeto
{

    public static function Guardar($destino, $objeto)
    {
        $array = json_decode(Objeto::Listar($destino));
        for ($i=0; $i < count($objeto); $i++) { 
            array_push($array,$objeto[$i]);
            //var_dump($array);
        }
        $archivo = fopen($destino, "w");
        fwrite($archivo, json_encode($array));
        fclose($archivo);
    }
    public static function Listar($destino)
    {
        $array = array();
        if (!file_exists($destino)) {
            $archivo = fopen($destino, "w");
            fwrite($archivo, json_encode($array));
            fclose($archivo);
        } else {

            $archivo = fopen($destino, "r");
            $array = json_decode(fread($archivo, filesize($destino)));
            fclose($archivo);
        }
        return json_encode($array);
    }
    /*public static function Listar($destino)
    {
        $array = array();
        $archivo = fopen($destino, "w");
        $array = fread($archivo, filesize($archivo));
        fclose($archivo);

        return json_encode($array);
    }
    

    public static function Guardar($destino, $formato, $objeto)
    {
        $archivo = fopen($destino, $formato);
        fwrite($archivo, $objeto . PHP_EOL);
        fclose($archivo);
    }*/

    public static function Modificar($destino, $objeto,$variable)
    {
        $array = json_decode(Objeto::Listar($destino));
        for ($i=0; $i < count($array) ; $i++) { 
            if ($array[$i]->$variable == $objeto->$variable) {
                
            }
        }

     }

    public static function Borrar($destino, $objeto)
    { }


    /*public static function Listar($destino, $nombre)
    {
        $objetos = array();
        $archivo = fopen($destino, "r");
        while (!feof($archivo)) {
            $linea = fgets($archivo);
            if ($linea != "") {
                $objeto = new stdClass;
                for ($i = 0; $i < count($nombre); $i++) {
                    $aux = $nombre[$i];
                    $objeto->$aux = explode("-", $linea)[$i];
                }
                array_push($objetos, $objeto);
            }
        }
        fclose($archivo);
        return $objetos;
    }*/
}
