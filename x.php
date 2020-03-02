<?php
$x=0;
while ($x<10){
    ${'var'.$x} = $x;
    print(${'var'.$x});
    $x++;
}
echo($var1);
?>