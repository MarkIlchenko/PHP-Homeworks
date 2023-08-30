<?php
require_once 'MoneyManagement.php';
require_once 'MoneyManagementTrait.php';
class RequestMoney
{
    private $amount;
    use MoneyManagementTrait;

    public function __construct($amount) {
        $this->amount = max(0, $amount);
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($newAmount) {
        if ($newAmount <= 0) {
            throw new InvalidArgumentException("Invalid Deposit Amount");
        }
        echo "Waiting for money request..." . PHP_EOL;
        sleep(3);

        $this->amount = $newAmount;
    }
}