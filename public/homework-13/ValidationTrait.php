<?php

trait ValidationTrait {
    public function validatePositiveValue(float $value, string $errorMessage): void {
        if ($value <= 0) {
            throw new InvalidArgumentException($errorMessage);
        }
    }
}