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

    public static function Guardar($destino, $objeto)
    {
        $archivo = fopen($destino, "w");
        fwrite($archivo, json_encode($objeto));
        fclose($archivo);
    }

    public static function Modificar($destino, $objetos, $objeto)
    {
        $i = 0;
        foreach ($objetos as $value) {
            if ($value->Equals($objeto)) {
                array_splice($objetos, $i, 1, array($objeto));
                break;
            }
            $i++;
        }
        Objeto::Guardar($destino, $objetos);
    }

    public static function Borrar($destino, $objetos, $objeto)
    {
        $i = 0;
        foreach ($objetos as $value) {
            if ($value->Equals($objeto)) {
                array_splice($objetos, $i, 1);
                break;
            }
            $i++;
        }
        Objeto::Guardar($destino, $objetos);
    }

    public static function GenerarRaiz($explode)
    {
        $raiz ="";
        for ($j=0; $j < count($explode)-1; $j++) {
            $raiz =$raiz.$explode[$j]."/";
        }
        return $raiz;
    }
}
