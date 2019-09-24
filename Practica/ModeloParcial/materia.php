<?php
include_once "./objeto.php";
include_once "./archivo.php";
class Materia
{
    public $materia;
    public $codigo;
    public $cupo;
    public $aula;

    public function __construct($materia,$codigo,$cupo=null,$aula=null)
    {
        $this->materia = $materia;
        $this->codigo = $codigo;
        $this->cupo = $cupo;
        $this->aula = $aula;
    }

    public function Equals($materia){
        $retorno = false;
        if ($this->codigo == $materia->codigo) {
            $retorno = true;
        }
        return $retorno;
    }

    public static function CargarArray(){
        $materias = array();
        $base = json_decode(Objeto::Listar("./materias.json"));
        if (count($base) > 0) {
            for ($i = 0; $i < count($base); $i++) {
                array_push($materias, new Materia($base[$i]->materia, $base[$i]->codigo, $base[$i]->cupo, $base[$i]->aula));
            }
        }
        return $materias;
    }
}
