<?php
require_once 'Text.php';
require_once 'NewText.php';

echo " " . PHP_EOL; //For console look

$myText = new Text();
echo "Text output: " . PHP_EOL;
$myText->print();

echo " -------------------------------- " . PHP_EOL; //For console look

echo "NewText output: " . PHP_EOL;
$myText = new NewText();
$myText->print();

echo " " . PHP_EOL; //For console look