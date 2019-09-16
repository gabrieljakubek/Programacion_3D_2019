<?php
class Objeto
{
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

    private static function Comparar($obj1,$obj2,$arrayVar)
    {
        $retorno = array();
        foreach ($arrayVar as $value) {
            if ($obj1 -> $value === $obj2 -> $value) {
                array_push($retorno,true);
            }
            else {
                array_push($retorno,false);
            }
        }

    }
    
    public static function Guardar($destino, $objeto, $variable)
    {
        $array = json_decode(Objeto::Listar($destino));
        $check = false;
        $arrayCant = count($array);
        $objetoCant = count($objeto);
        if ($arrayCant > $objetoCant) {
            $archivo = fopen($destino, "w");
            fwrite($archivo, json_encode($objeto));
            fclose($archivo);
        } else {
            var_dump($array);
            for ($i = 0; $i < $objetoCant; $i++) {
                for ($j = 0; $j < $arrayCant; $j++) {
                    if ($array[$j]->$variable == $objeto[$i]->$variable) {
                        $check = true;
                        break;
                    }
                }
                if (!$check) {
                    array_push($array, $objeto[$i]);
                } else {
                    $check = false;
                }
            }
            $archivo = fopen($destino, "w");
            fwrite($archivo, json_encode($array));
            fclose($archivo);
        }
    }
    
    public static function Modificar($destino, $objeto, $variable)
    {
        $array = json_decode(Objeto::Listar($destino));
        $objetos = array($objeto);
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]->$variable == $objeto->$variable) {
                array_splice($array, $i, 1, $objetos);
            }
        }
        Objeto::Guardar("./archivo.json",$array,$variable);
    }

    public static function Borrar($destino, $objeto, $variable)
    {
        $array = json_decode(Objeto::Listar($destino));
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]->$variable == $objeto->$variable) {
                array_splice($array, $i, 1);
            }
        }
        Objeto::Guardar($destino, $array, $variable);
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
