<?php 

$valor =[17, 22];
$operação = 'add';

if ($operação == 'add') {
    $resultado = array_sum($valor);
echo "A soma dos valores é $resultado <br>";

}

if ($operação == 'multi') {
    $resultado = array_product($valor);
echo "A Multiplicação dos valores é $resultado <br>";

};  


function sub($a, $b, $c) { 

    $resultado = $a - $b - $c;
    return $resultado;
}

echo "a subtração dos valores é " . sub(10,5, 10) . "<br>";  





function add($a, $b, $c) { 

    $resultado = $a + $b + $c;
    return $resultado;
}

echo "a soma dos valores é " . add(10,5, 10);

