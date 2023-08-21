<?php
$userNumber = (int)readline("Будь ласка, введіть довжину масиву, яку ви хочете задати: ");
$userArray = [];

for ($i = 0; $i < $userNumber; $i++) {
    $number = rand(0, 10);
    $userArray[] = $number;
}

$maxElement = max($userArray);
$minElement = min($userArray);

echo " " . PHP_EOL;
echo "->" . PHP_EOL;
echo "Саме більше число: $maxElement\n";
echo "Саме менше число: $minElement\n";
echo "->" . PHP_EOL;

sort($userArray);
echo "Відсортований масив за зростанням: " . implode(", ", $userArray) . "\n";

rsort($userArray);
echo "Відсортований масив за спаданням: " . implode(", ", $userArray) . "\n";
echo "->" . PHP_EOL;
echo " " . PHP_EOL;