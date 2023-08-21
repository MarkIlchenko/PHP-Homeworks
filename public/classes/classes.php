<?php
class Hello {
    public string $name = "анонiм";
    function helloWorld(): void {
        echo "Hello World! " . $this->name . PHP_EOL;
    }
}

$newObj = new Hello();
$newObj->helloWorld();
$newObj->name = "Mark";
$newObj->helloWorld();
echo PHP_EOL;