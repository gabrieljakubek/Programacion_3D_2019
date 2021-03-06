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
    
    public static function Modificar($destino, $objetos,$objeto)
    {         
        for ($i = 0; $i < count($objetos); $i++) {
            if ($objetos[$i]->Equals($objeto)) {
                array_splice($objetos, $i, 1, $objeto);
            }
        }
        Objeto::Guardar($destino,$array);
    }

    public static function Borrar($destino, $objetos, $objeto)
    {        
        for ($i = 0; $i < count($objetos); $i++) {
            if ($objetos[$i]->Equals($objeto)) {
                array_splice($objetos, $i, 1);
            }
        }
        Objeto::Guardar($destino, $objetos);
    }
}
