<?php
$args = $argv;

$file = fopen("log.txt", "a");

if ($file) {

    foreach ($args as $arg) {
        fwrite($file, $arg . "\n");
        fwrite($file, "Hello It's Mark!" . "\n");
    }

    fclose($file);
} else {
    echo "Failed to open the file for writing." . PHP_EOL;
}