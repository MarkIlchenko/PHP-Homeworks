<?php

$printAnotherResult = function ($value) {
    echo "Результат: $value";
};

function multipleFunction($a, $b, $c = null, $callback = null) {
    $result = $a * $b;

    if ($c !== "") {
        $result *= $c;
        if ($callback instanceof Closure) {
            $callback($result);
        }
    }

    return $result;
}

$a = readline("Будь ласка, введіть ваше перше число: " . PHP_EOL);
$b = readline("Будь ласка, введіть ваше дурге число: " . PHP_EOL);
$c = readline("Будь ласка, введіть ваше третье число (або оставьте пустим): " . PHP_EOL);

$result = multipleFunction($a, $b, $c);
if ($c !== "") {
    echo " " . PHP_EOL;
    printValue2($printAnotherResult($result));
} else {
    printValue("Добуток $a і $b: $result");
}

//Эти две функции я сделал для себя, мне понравилось как они результат в консоль выводят
function printValue($value) {
    echo " " . PHP_EOL;
    echo "-> $value" . PHP_EOL;
    echo " " . PHP_EOL;
}
function printValue2($value) {
    echo " " . PHP_EOL;
    echo $value . PHP_EOL;
}