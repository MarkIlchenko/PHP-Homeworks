<?php
require_once 'ValidationTrait.php';

class Rectangle extends Figure {
    use ValidationTrait;

    private const INVALID_DIMENSIONS_ERROR = "Invalid dimensions for Rectangle";
    private float $length;
    private float $width;

    public function __construct(float $length, float $width) {
        $this->validateDimensions($length, $width);
        $this->length = $length;
        $this->width = $width;
    }

    public function area(): float {
        return $this->length * $this->width;
    }

    public function perimeter(): float {
        return 2 * ($this->length + $this->width);
    }

    public function getLength(): float {
        return $this->length;
    }

    public function getWidth(): float {
        return $this->width;
    }

    private function validateDimensions(float $length, float $width): void {
        $this->validatePositiveValue($length, self::INVALID_DIMENSIONS_ERROR);
        $this->validatePositiveValue($width, self::INVALID_DIMENSIONS_ERROR);
    }

    public function __destruct() {
        echo sprintf(
            "Rectangle: Length = %.2f, Width = %.2f, Area = %.2f, Perimeter = %.2f\n",
            $this->getLength(),
            $this->getWidth(),
            $this->area(),
            $this->perimeter()
        );
    }
}