<?php
$logFile = "log.txt";

if (file_exists($logFile)) {
    $log = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


    if (!empty($log)) {

        $lastLogEntry = end($log);

        $lastArgsArray = explode(" ", $lastLogEntry);

        echo implode(" ", $lastArgsArray) . PHP_EOL;
    } else {
        echo "The log file is empty." . PHP_EOL;
    }
} else {
    echo "The log file does not exist." . PHP_EOL;
}