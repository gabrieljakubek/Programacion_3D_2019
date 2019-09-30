<?php
include_once "./alumno.php";
include_once "./materia.php";
include_once "./inscribir.php";
class Manejador
{
    const rutaAlumnos = "./alumnos.json";
    const rutaMaterias = "./materias.json";
    const rutaInscripciones = "./inscripciones.json";
    const rutaImagenes = "./Imagenes/";
    const rutaBackUpFotos = "./backUpFotos/";

    public static function GuardarAlumno($alumno, $foto)
    {
        $flag = false;
        $alumnos = Alumno::CargarArray(Manejador::rutaAlumnos);
        foreach ($alumnos as $value) {
            if ($alumno->Equals($value)) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            $alumno->foto = Archivo::GuardarArchivo($foto, "./Imagenes/", $alumno->email);
            array_push($alumnos, $alumno);
            Objeto::Guardar(Manejador::rutaAlumnos, $alumnos);
        } else {
            return "Alumno ya cargado";
        }
    }

    public static function ListarAlumnos($valor,$parametro)
    {
        if ($parametro == "apellido") {
            $retorno = Objeto::Encontrar(Manejador::rutaAlumnos, $valor, "apellido");
            if (count($retorno) > 0) {
                return json_encode($retorno);
            } else {
                return "No existe inscripciones con el apellido " . $valor;
            }
        }
        else {
            return Objeto::Listar(Manejador::rutaAlumnos);
        }
    }

    public static function GuardarMateria($materia)
    {
        $flag = false;
        $materias = Materia::CargarArray(Manejador::rutaMaterias);
        foreach ($materias as $value) {
            if ($materia->Equals($value)) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            array_push($materias, $materia);
            Objeto::Guardar(Manejador::rutaMaterias, $materias);
        } else {
            return "Materia ya cargada";
        }
    }

    public static function InscribirAlumno($alumno, $materia)
    {
        $materiaB = (Objeto::Encontrar(Manejador::rutaMaterias, $materia->codigo, "codigo"));
        if ($materiaB != null) {
            $materia->cupo = $materiaB[0]->cupo;
            $materia->aula = $materiaB[0]->aula;
            if ($materia->cupo > 0) {
                $alumnoFlag = Objeto::Existe(Manejador::rutaAlumnos, $alumno, "email");
                if ($alumnoFlag) {
                    $inscripcion = new Inscribir($alumno->nombre, $alumno->apellido, $alumno->email, $materia->materia, $materia->codigo);
                    $inscripcionFlag = false;
                    $inscripciones = Inscribir::CargarArray(Manejador::rutaInscripciones);
                    foreach ($inscripciones as $value) {
                        if ($value->Equals($inscripcion)) {
                            $inscripcionFlag = true;
                            break;
                        }
                    }
                    if (!$inscripcionFlag) {
                        array_push($inscripciones, $inscripcion);
                        Objeto::Guardar(Manejador::rutaInscripciones, $inscripciones);
                        $materia->cupo -= 1;
                        Objeto::Modificar(Manejador::rutaMaterias, $materia);
                        return "Se logro inscribir al alumno";
                    } else {
                        return "Alumno ya inscripto en la materia";
                    }

                } else {
                    return "El alumno no se encuentra cargado";
                }
            } else {
                return "La materia no tiene más cupo";
            }
        } else {
            return "La materia no se encuentra cargada";
        }
    }

    public static function ListarInscripciones($valor, $parametro)
    {
        if ($parametro == "apellido") {
            $retorno = Objeto::Encontrar(Manejador::rutaInscripciones, $valor, "apellido");
            if (count($retorno) > 0) {
                return json_encode($retorno);
            } else {
                return "No existe inscripciones con el apellido " . $valor;
            }
        } elseif ($parametro=="materia") {
            $retorno = Objeto::Encontrar(Manejador::rutaInscripciones, $valor, "materia");
            if (count($retorno) > 0) {
                return json_encode($retorno);
            } else {
                return "No existe inscripciones con la materia " . $valor;
            }
        } else {
            return Objeto::Listar(Manejador::rutaInscripciones);
        }
    }

    public static function ModificarAlumno($alumno,$archivo)
    {
        $alumnos = Alumno::CargarArray(Manejador::rutaAlumnos);
        $flag = false;
        foreach ($alumnos as $value) {
            if ($alumno->Equals($value)) {
                if ($archivo != null) {
                    Archivo::BackUpArchivo(Manejador::rutaImagenes, $value->foto,Manejador::rutaBackUpFotos,Archivo::GenerarNombre($archivo,$value->apellido."-".date("d-m-Y")));
                    $alumno->foto = Archivo::GuardarArchivo($archivo, Manejador::rutaImagenes, $value->email);
                } else {
                    $alumno->foto = $value->imagen;
                }
                Objeto::Modificar(Manejador::rutaAlumnos,$alumno);
                $flag = true;
                break;
            }
        }
        if ($flag) {
            return "Se modifico el alumno con email " . $alumno->email;
        } else {
            return "No se encontro el alumno a modificar con el email ".$alumno->email;
        }
        
    }
}
