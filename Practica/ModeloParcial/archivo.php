<?php
class Archivo
{
    public static function GuardarArchivo($archivo, $destino, $nombre)
    {
        if (!file_exists($destino) ){
            mkdir($destino);
        }
        $archivoTmp = $archivo["tmp_name"];
        $ruta = $destino.Archivo::GenerarNombre($archivo,$nombre);
        $rta = move_uploaded_file($archivoTmp, $ruta);
        if (!$rta) {
            $nombre = null;
        }
        return $nombre;
    }

    private static function GenerarNombre($archivo, $nombre)
    {
        return $nombre . "." . explode("/", $archivo["type"])[1];
    }
    public static function BackUpArchivo($raiz, $destino,$nombre)
    {
        copy($raiz.$nombre,$destino.$nombre);
    }

    public static function BorrarArchivo($raiz,$nombre)
    {
        if (is_dir($raiz) && file_exists($raiz.$nombre) ) {
            unlink($raiz.$nombre);
        }
    }
}
