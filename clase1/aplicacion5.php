<?php
$a = 9;
$b = 6;
$c =8;
$aux1 = false;
$aux2 = false;
$aux3 = false;
if ($a<$b) {
$aux1 = true;
}
if ($a>$c) {
    $aux2 = true;
}
if ($b>$c) {
    $aux3=true;
}
if ($aux1 && $aux2) {
    # code...
} else {
    # code...
}
