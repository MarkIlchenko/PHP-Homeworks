<?php
require_once 'MoneyManagement.php';
require_once 'MoneyManagementTrait.php';

class AccountInformation {
    private $account;

    public function __construct($account) {
        if ($account === '') {
            throw new InvalidArgumentException("Invalid Account Information");
        }

        $this->account = $account;
    }

    public function getAccount() {
        return $this->account;
    }

    public function setAccount($account) {
        if ($account === '') {
            throw new InvalidArgumentException("Invalid Account Information");
        }

        $this->account = $account;
    }
}