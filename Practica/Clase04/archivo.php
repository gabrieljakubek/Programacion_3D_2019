<?php
class Archivo
{
    public static function GuardarArchivo($archivo, $destino, $nombre)
    {
        $archivoTmp = $archivo["tmp_name"];
        $ruta = $destino.Archivo::GenerarNombre($archivo,$nombre);
        $rta = move_uploaded_file($archivoTmp, $ruta);
        if (!$rta) {
            $ruta = null;
        }
        return $ruta;
    }

    private static function GenerarNombre($archivo, $nombre)
    {
        return $nombre . "." . explode("/", $archivo["type"])[1];
    }
    public static function BackUpFoto($raiz, $destino,$nombre)
    {
        copy($raiz.$nombre,$destino.$nombre);
    }
}
