<?php

trait MoneyManagementTrait
{
    private $balance;

    public function __construct($balance) {
        $this->balance = max(0, $balance);
    }

    public function getBalance() {
        return $this->balance;
    }

    public function deposit($amount) {
        if ($amount <= 0) {
            throw new InvalidArgumentException("Invalid Deposit Amount");
        }
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($amount <= 0 || $amount > $this->balance) {
            throw new InvalidArgumentException("Invalid Withdrawal Amount");
        }
        $this->balance -= $amount;
    }
}