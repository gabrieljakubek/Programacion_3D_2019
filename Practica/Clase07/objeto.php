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

    public static function Modificar($destino, $objeto)
    {
        $objetos = json_decode(Objeto::Listar($destino));
        $i = 0;
        foreach ($objetos as $value) {
            if ($objeto->Equals($value)) {
                array_splice($objetos, $i, 1, array($objeto));
                break;
            }
            $i++;
        }
        Objeto::Guardar($destino, $objetos);
    }

    public static function Borrar($destino, $objeto)
    {
        $objetos = Objeto::Listar($destino);
        $i = 0;
        foreach ($objetos as $value) {
            if ($objeto->Equals($value)) {
                array_splice($objetos, $i, 1);
                break;
            }
            $i++;
        }
        Objeto::Guardar($destino, $objetos);
    }

    public static function GenerarRaiz($explode)
    {
        $raiz = "";
        for ($j = 0; $j < count($explode) - 1; $j++) {
            $raiz = $raiz . $explode[$j] . "/";
        }
        return $raiz;
    }

    public static function Existe($ruta, $objeto, $variable)
    {
        $base = json_decode(Objeto::Listar($ruta));
        $retorno = false;
        foreach ($base as $value) {
            if ($value->$variable == $objeto->$variable) {
                $retorno = true;
                break;
            }
        }
        return $retorno;
    }

    public static function Encontrar($ruta, $valor, $variable)
    {
        $base = json_decode(Objeto::Listar($ruta));
        $retorno = array();
        foreach ($base as $value) {
            if (strtolower($value->$variable) == strtolower($valor)) {
                array_push($retorno, $value);
            }
        }
        return $retorno;
    }
}
