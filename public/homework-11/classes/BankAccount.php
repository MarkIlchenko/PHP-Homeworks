<?php
require_once 'MoneyManagement.php';
require_once 'MoneyManagementTrait.php';

require_once 'AccountInformation.php';
require_once 'BalanceManager.php';
require_once 'RequestMoney.php';

class BankAccount implements MoneyManagement{
    private $balanceManager;
    private $requestManager;

    public function __construct($balance, $requestManager) {
        $this->balanceManager = new BalanceManager($balance);
        $this->requestManager = new RequestMoney($requestManager);
    }

    public function deposit($amount) {
        $this->balanceManager->deposit($amount);
    }

    public function withdraw($amount) {
        $this->balanceManager->withdraw($amount);
    }

    public function getBalance() {
        return $this->balanceManager->getBalance();
    }

    public function getAmount() {
        return $this->getBalance() + $this->requestManager->getAmount();
    }

    public function getBalanceManager() {
        return $this->balanceManager;
    }

    public function getRequestManager() {
        return $this->requestManager;
    }
}