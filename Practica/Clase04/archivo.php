<?php
class Archivo
{
    public static function GuardarArchivo($archivo, $destino, $nombre)
    {
        $archivoTmp = $archivo["tmp_name"];
        $ruta = $destino . $nombre . "." . explode("/", $archivo["type"])[1];
        $rta = move_uploaded_file($archivoTmp, $ruta);
        if (!$rta) {
            $ruta = mill;
        }
        return $ruta;
    }
}
