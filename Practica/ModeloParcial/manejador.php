<?php
include_once "./alumno.php";
include_once "./materia.php";
class Manejador
{
    public static function GuardarAlumno($alumno, $foto)
    {
        $flag = false;
        $alumnos = Alumno::CargarArray();
        $alumno->foto = Archivo::GuardarArchivo($foto, "./Imagenes/", $alumno->email);
        foreach ($alumnos as $value) {
            if ($alumno->Equals($value)) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            array_push($alumnos, $alumno);
            Objeto::Guardar("./alumnos.json", $alumnos);
        }
    }

    public static function BuscarAlumnosApellido($apellido)
    {
        $retorno = array();
        $alumnos = Alumno::CargarArray();
        foreach ($alumnos as $value) {
            if ($value->BuscarApellido($apellido)) {
                array_push($retorno, $value);
            }
        }
        if (count($retorno) > 0) {
            return json_encode($retorno);
        } else {
            return "No existe alumno con apellido" . $apellido;
        }
    }

    public static function GuardarMateria($materia)
    {
        $flag = false;
        $materias = Materia::CargarArray();
        foreach ($materias as $value) {
            if ($materia->Equals($value)) {
                $flag = true;
                break;
            }
        }
        var_dump($flag);
        var_dump($materia);
        if (!$flag) {
            array_push($materias, $materia);
            Objeto::Guardar("./materias.json", $materias);
        }
    }

    public static function InscribirAlumno($alumno, $materia)
    {
        $alumnos = Alumno::CargarArray();
        $materias = Materia::CargarArray();
        $materiaB = null;
        $flagAlumno = false;
        foreach ($materias as $value) {
            if ($materia->Equals($value)) {
                $materiaB = $value;
                break;
            }
        }
        if ($materiaB != null && $materiaB->cupo > 0) {
            foreach ($alumnos as $value) {
                if ($alumno->Equals($value)) {
                    $flagAlumno = true;
                    break;
                }
            }
            if ($flagAlumno) {
                
            }
        }
    }
}
