<?php
include_once "./usuario.php";
include_once "./log.php";
class Manejador
{
    const rutaUsuarios = "./usuarios.json";
    const rutaLogger = "./info.log";
    const rutaImagenes = "./img/fotos/";
    const rutaBackUp = "./img/backup/";

    public static function GuardarUsuario($usuario, $foto1, $foto2)
    {
        $flag = false;
        $usuarios = Usuario::CargarArray(Manejador::rutaUsuarios);
        foreach ($usuarios as $value) {
            if ($usuario->Equals($value)) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            $usuario->foto1 = Archivo::GuardarArchivo($foto1, Manejador::rutaImagenes, $usuario->legajo . "-1");
            $usuario->foto2 = Archivo::GuardarArchivo($foto2, Manejador::rutaImagenes, $usuario->legajo . "-2");
            array_push($usuarios, $usuario);
            Objeto::Guardar(Manejador::rutaUsuarios, $usuarios);
            return json_encode("Se logro cargar el usuario");
        } else {
            return json_encode("Usuario ya cargado");
        }
    }

    public static function ListarUsuario($usuario)
    {
        if ($usuario->clave != null) {
            $flag = false;
            $usuarios = Usuario::CargarArray(Manejador::rutaUsuarios);
            foreach ($usuarios as $value) {
                if ($usuario->Equals($value)) {
                    $retorno = $value;
                    $flag = true;
                    break;
                }
            }
        } else {
            $flag = false;
            $usuarios = Usuario::CargarArray(Manejador::rutaUsuarios);
            foreach ($usuarios as $value) {
                if ($usuario->legajo == $value->legajo) {
                    $retorno = $value;
                    $flag = true;
                    break;
                }
            }
        }

        if ($flag) {
            return json_encode($retorno);
        } else {
            return json_encode("No existe el usuario");
        }

    }

    public static function Logger($accion, $ip)
    {
        $logs = Log::CargarArray(Manejador::rutaLogger);
        $fecha = date('H:i:s');
        $log = new Log($accion, $fecha, $ip);
        array_push($logs, $log);
        Objeto::Guardar(Manejador::rutaLogger, $logs);
    }

    public static function ModificarUsuario($usuario, $foto1, $foto2)
    {
        $usuarios = Usuario::CargarArray(Manejador::rutaUsuarios);
        $flag = false;
        foreach ($usuarios as $value) {
            if ($usuario->Equals($value)) {
                if ($foto1 != null && $foto2 != null) {
                    Archivo::BackUpArchivo(Manejador::rutaImagenes, $value->foto1, Manejador::rutaBackUp, Archivo::GenerarNombre($foto1, $value->legajo . "-1"));
                    Archivo::BackUpArchivo(Manejador::rutaImagenes, $value->foto2, Manejador::rutaBackUp, Archivo::GenerarNombre($foto2, $value->legajo . "-2"));
                    $usuario->foto1 = Archivo::GuardarArchivo($foto1, Manejador::rutaImagenes, $usuario->legajo . "-1");
                    $usuario->foto2 = Archivo::GuardarArchivo($foto2, Manejador::rutaImagenes, $usuario->legajo . "-2");
                } else if ($foto1 != null) {
                    Archivo::BackUpArchivo(Manejador::rutaImagenes, $value->foto1, Manejador::rutaBackUp, Archivo::GenerarNombre($foto1, $value->legajo . "-1"));
                    $usuario->foto1 = Archivo::GuardarArchivo($foto1, Manejador::rutaImagenes, $usuario->legajo . "-1");
                    $usuario->foto2 = $value->foto2;
                } else if ($foto2 != null) {
                    Archivo::BackUpArchivo(Manejador::rutaImagenes, $value->foto2, Manejador::rutaBackUp, Archivo::GenerarNombre($foto2, $value->legajo . "-2"));
                    $usuario->foto2 = Archivo::GuardarArchivo($foto2, Manejador::rutaImagenes, $usuario->legajo . "-2");
                    $usuario->foto1 = $value->foto1;
                } else {
                    $usuario->foto1 = $value->foto1;
                    $usuario->foto2 = $value->foto2;
                }
                Objeto::Modificar(Manejador::rutaUsuarios, $usuario);
                $flag = true;
                break;
            }
        }
        if ($flag) {
            return json_encode("Se modifico el usuario");
        } else {
            return json_encode("No se encontro el usuario");
        }

    }

}
