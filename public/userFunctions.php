<?php
$userChoice = readline("Будь ласка, оберіть 1 або 2 програму з нашого списку, або натисніть будь-яку клавішу, щоб дізнатися більше про нашу програму.\n");
function compareAndPrint($value1, $value2) {
    echo "Порівнюємо: " . var_export($value1, true) . " i " . var_export($value2, true) . PHP_EOL;
    echo "Суворе порівняння (===): ";
    var_dump($value1 === $value2);
    echo "Несуворе порівняння (==): ";
    var_dump($value1 == $value2);
    echo "\n";
}

if ($userChoice === "1") {

    $userChoiceNew = readline("ВОберіть тип даних для порівняння (Number, String, Bool, Array, відкинути числа).\n");

    switch ($userChoiceNew) {
        case "Number":
            $num1 = 20;
            $num2 = 20;
            $num3 = "20";

            echo "Тут я збираюсь порівняти змінні різного типу з одним значенням." . PHP_EOL;
            compareAndPrint($num1, $num3);
            echo "Спочатку я збираюсь порівняти змінні одного типу з одним значенням." . PHP_EOL;
            compareAndPrint($num1, $num2);
            break;

        case "String":
            $string1 = "Hi Mark!";
            $string2 = "Hi Mark2";
            $string3 = "Hi Mark!";

            echo "Тут я збираюсь порівняти змінні різного типу з одним значенням." . PHP_EOL;
            compareAndPrint($string1, $string2);
            echo "Спочатку я збираюсь порівняти змінні одного типу з одним значенням." . PHP_EOL;
            compareAndPrint($string1, $string3);
            break;

        case "Bool":
            $bool1 = true;
            $bool2 = false;

            echo "п" . PHP_EOL;
            compareAndPrint($bool1, $bool2);

            $addDeep = readline("Ви хочете побачити порівняння false з null?");
            if ($addDeep === "yes") {
                $null = null;
                compareAndPrint($null, $bool2);
            }

            break;

        case "Array":
            $array1 = [1, 2, null, false, "a"];
            $array3 = [1, 2, null, false, "a"];
            $array2 = [3, 4, "b"];
            compareAndPrint($array1, $array2);
            compareAndPrint($array1, $array3);
            break;

        case "Drop Numbers":
            $float1 = 3.14;
            $float2 = 3.14159;
            compareAndPrint($float1, $float2);
            break;

        default:
            echo "Будь ласка, оберіть тип, який ви хочете порівняти зі списку.\n";
            break;
    }

} elseif ($userChoice === "2") {
    echo "Ласкаво просимо до програми порівняння значень!\n";
    while (true) {
        echo "Виберіть тип даних для порівняння (Number, String, Bool, Array, Дробові числа) або введіть 'exit' для виходу:";
        $dataType = readline();

        if ($dataType === 'exit') {
            break;
        }

        switch ($dataType) {
            case 'Number':
                echo "Введіть перше число: ";
                $value1 = readline();
                echo "Введіть друге число: ";
                $value2 = readline();
                break;

            case 'String':
                echo "Введіть перше число: ";
                $value1 = readline();
                echo "Введіть друге число: ";
                $value2 = readline();
                break;

            case 'Bool':
                echo "Введіть перше значення (true або false): ";
                $value1 = readline();
                echo "Введіть друге значення (true або false): ";
                $value2 = readline();
                break;

            case 'Array':
                echo "Введіть перший масив (через кому і без пробілів): ";
                $value1 = explode(',', readline());
                echo "Введіть другий масив (через кому і без пробілів): ";
                $value2 = explode(',', readline());
                break;

            case 'Drob Numbers':
                echo "Введіть перше дробове число: ";
                $value1 = readline();
                echo "Введіть друге дробове число: ";
                $value2 = readline();
                break;

            default:
                echo "Некоректний тип даних. Будь ласка, оберіть зі списку.\n";
                continue;
        }

        compareAndPrint($value1, $value2);
    }

    echo "Дякуємо за використання програми порівняння значень!\n";
} else {
    echo "Перша програма є статичною, у неї вже заздалегідь вписані числа, і ви можете побачити результат цих порівнянь.\n";
    echo "Друга програма є динамічною, куди ви зможете вписати свої дані, які хочете перевірити, і обрати тип даних, який бажаєте перевірити.\n";
}