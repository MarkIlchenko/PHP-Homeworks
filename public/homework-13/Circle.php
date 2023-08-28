<?php
require_once 'ValidationTrait.php';

class Circle extends Figure {
    use ValidationTrait;

    public const INVALID_RADIUS_ERROR = "Invalid radius for Circle";
    private float $radius;

    public function __construct(float $radius) {
        $this->validateRadius($radius);
        $this->radius = $radius;
    }

    public function area(): float {
        return pi() * $this->radius * $this->radius;
    }

    public function perimeter(): float {
        return 2 * pi() * $this->radius;
    }

    public function getRadius(): float {
        return $this->radius;
    }

    private function validateRadius(float $radius): void {
        $this->validatePositiveValue($radius, self::INVALID_RADIUS_ERROR);
    }

    public function __destruct() {
        echo sprintf(
            "Circle: Radius = %.2f, Area = %.2f, Circumference = %.2f\n",
            $this->getRadius(),
            $this->area(),
            $this->perimeter()
        );
    }
}
