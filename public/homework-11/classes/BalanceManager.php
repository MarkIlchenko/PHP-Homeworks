<?php
require_once 'MoneyManagement.php';
require_once 'MoneyManagementTrait.php';

class BalanceManager {
    private $balance;

    public function __construct($balance) {
        if ($balance < 0) {
            throw new InvalidArgumentException("Invalid Balance Information");
        }

        $this->balance = $balance;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function setBalance($balance) {
        if ($balance < 0) {
            throw new InvalidArgumentException("Invalid Balance Information");
        }

        $this->balance = $balance;
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