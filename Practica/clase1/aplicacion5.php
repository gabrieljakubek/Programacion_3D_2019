<?php
$a = 1;
$b = 7;
$c = 6;
if ($a < $b && $a > $c || $a < $c && $a > $b) {
    echo "El del medio es " . $a. " A ";
} elseif ($b < $a && $b > $c || $b < $c && $b > $a) {
    echo "El del medio es " .$b. " B ";
} elseif ($c < $b && $c > $a || $c < $a && $c > $b) {
    echo "El del medio es " .$c. " C ";
} else {
    echo "No hay del medio";
}
