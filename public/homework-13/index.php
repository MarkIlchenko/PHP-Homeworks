<?php
require_once 'Figure.php';
require_once 'Rectangle.php';
require_once 'Circle.php';

try {
    $rectangle = new Rectangle(10, 16);
    echo "-> Rectangle created successfully\n" . PHP_EOL;
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

try {
    $circle = new Circle(12);
    echo "-> Circle created successfully\n" . PHP_EOL;
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}


