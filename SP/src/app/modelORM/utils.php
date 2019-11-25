<?php
namespace App\Models\ORM;
class utils
{
    public static function guardarArchivo($archivo, $destino, $nombre)
    {

        if (!file_exists($destino)) {
            mkdir($destino);
        }
        $nombreFormato = utils::GenerarNombre($archivo, $nombre);
        $archivo->moveTo($destino.$nombreFormato);        
    }

    private static function GenerarNombre($archivo, $nombre)
    {
        $extension = pathinfo($archivo->getClientFilename(), PATHINFO_EXTENSION);
        return $nombre . "." . $extension;
    }
}
