<?php
require_once 'MoneyManagement.php';
require_once 'MoneyManagementTrait.php';
class Login
{
    private $userid;

    public function __construct($userid) {
        $this->userid = $userid;
    }

    public function getUserId() {
        return $this->userid;
    }

}