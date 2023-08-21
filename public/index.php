<?php

// Вибір користувача з програмами
$userChoose = readline("
Будь ласка, виберіть одну з трьох програм: 1 або 2 або 3" . PHP_EOL);

switch ($userChoose) {
    case '1':
        // Обчислення площі кола
        function calculateCircleArea($radius) {
            $pi = 3.14159;
            $area = $pi * pow($radius, 2);
            return $area;
        }

        $radius = readline("Введіть своє число: ");
        $areaOfCircle = calculateCircleArea($radius);

        echo "Площа кола з радіусом $radius: $areaOfCircle" . PHP_EOL;
        break;
    case '2':
        // Піднесення числа до степеня
        function powerOfNumber($number, $power) {
            $result = pow($number, $power);
            echo "$number в степені $power: $result" . PHP_EOL;
        }

        $number = readline("Введіть перше число: ");
        $power = readline("Введіть друге число: ");
        powerOfNumber($number, $power);

        break;
    case '3':
        // Піднесення числа до степеня зі зміною значення через посилання
        function powerOfNumberReturn($number, $power) {
            return pow($number, $power);
        }

        function powerOfNumberChange(&$number, $power) {
            $number = pow($number, $power);
        }

        $number = readline("Введіть перше число: " . PHP_EOL);
        $power = readline("Введіть друге число: " . PHP_EOL);

        $newResult = powerOfNumberReturn($number, $power);

        powerOfNumberChange($number, $power);
        echo "Функція powerOfNumberChange: число 2 ($power) піднесене до степеню $number дорівнює $newResult" . PHP_EOL;

        break;
    default:
        echo "Будь ласка, виберіть одну з 3 програм" . PHP_EOL;
}

