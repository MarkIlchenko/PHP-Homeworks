<?php

const COMMAND_TASK = 'Find the number behind the index';
const COMMAND_HOMEWORK = 'Homework task';
const COMMAND_EXIT = 'exit';

function findFibonacciIndex($target): int
{
    if ($target <= 0) {
        return 0;
    } else if ($target === 1) {
        return 1;
    } else {
        $fibValues = [0, 1];

        for ($i = 2; $i <= $target; $i++) {
            $fibNext = $fibValues[$i - 1] + $fibValues[$i - 2];
            $fibValues[] = $fibNext;
        }

        return $fibValues[$target];
    }
}

function fibonacciGenerator(int $limit): Generator
{
    $a = 0;
    $b = 1;

    if ($limit >= 0) {
        yield $a;

        while ($b <= $limit) {
            yield $b;

            [$a, $b] = [$b, $a + $b];
        }
    }
}

function printFibonacciSeries(Generator $generator): void
{
    foreach ($generator as $fibonacciNumber) {
        echo $fibonacciNumber . " ";
    }
}

while (true) {
    $command = readline("Enter " . COMMAND_HOMEWORK . " or 1 " . COMMAND_TASK . " or 2 " . COMMAND_EXIT . " or 3: ");

    switch ($command) {

        case COMMAND_HOMEWORK:
        case '1':
            $limit = intval(readline("Please enter a number: "));
            $generator = fibonacciGenerator($limit);
            printFibonacciSeries($generator);
            echo PHP_EOL;
            break;

        case COMMAND_TASK:
        case '2':
            $targetNumber = intval(readline("Please enter a number: "));
            $resultInterval = findFibonacciIndex($targetNumber - 1);
            echo "Число Фибоначчи с индексом {$targetNumber} равно {$resultInterval}" . PHP_EOL;
            echo PHP_EOL;
            break;

        case COMMAND_EXIT:
        case '3':
            echo "Exiting the program." . PHP_EOL;
            return;
        default:
            echo "Unknown command. ";

    }
}