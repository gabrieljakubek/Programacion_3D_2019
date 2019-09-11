<?php
$resultado = 0;
$contadornumeros = 0;
for ($i = 1; $i < 1000; $i++) {
    if (($resultado + $i) < 1000) {
        $resultado += $i;
        $contadornumeros  += 1;
        echo "Se sumo el " . $i . "<br>";
    }
    else{
        break;
    }
}
echo "Se cumo una cantidad de ".$contadornumeros." numeros <br>";
echo "El resultado de la suma es de: ".$resultado;
