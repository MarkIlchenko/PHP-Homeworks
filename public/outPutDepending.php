<?php
function getColorName($value) {
    return match ($value) {
        "008000" => 'green',
        "FF0000" => 'red',
        "0000FF" => 'blue',
        "964B00" => 'brown',
        "7F00FF" => 'violet',
        "000000" => 'black',
        default => 'white',
    };
}

echo "Ви можете ввести найпопулярніші HEX-коди для кольору, який ви бажаєте.\n";
echo "PS: ось шпаргалка\n";

echo "008000\n";
echo "FF0000\n";
echo "0000FF\n";
echo "964B00\n";
echo "7F00FF\n";
echo "000000\n";
echo "FFFFFF\n";

$value = readline("Будь ласка, введіть свій HEX, і ми скажемо, який це колір: ");
$colorName = getColorName($value);
echo "Значення: $value, Колір: $colorName" . PHP_EOL;