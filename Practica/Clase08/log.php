<?php
class Log{
    public $accion;
    public $fecha;
    public $ip;

    public function __construct($accion,$fecha,$ip)
    {
        $this->accion = $accion;
        $this->fecha = $fecha;
        $this->ip = $ip;
    }

    public static function CargarArray($ruta)
    {
        $logs = array();
        $base = json_decode(Objeto::Listar($ruta));
        if (count($base) > 0) {
            for ($i = 0; $i < count($base); $i++) {
                array_push($logs, new Log($base[$i]->accion, $base[$i]->fecha, $base[$i]->ip));
            }
        }
        return $logs;
    }
}