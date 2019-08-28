<?php
$resultado = 0;
for($i = 1;$resultado < 1000; $i++)
{
    if ($resultado = $resultado + $i < 1000) {
        $resultado = $resultado + $i;
        echo $i."<br>";
    }
}
echo $resultado;