<?php
require_once 'Shape.php';

abstract class Figure implements Shape {
    abstract public function area(): float;
    abstract public function perimeter(): float;
}