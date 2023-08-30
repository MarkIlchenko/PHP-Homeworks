<?php

// Подключаем необходимые классы
require_once 'classes/BankAccount.php';
require_once 'classes/Login.php';
require_once 'classes/NewHomeworkUser.php';

$url = 'https://jsonplaceholder.typicode.com/users';
$data = file_get_contents($url);
$users = json_decode($data, true);
$newUsers = [...$users];

$userInput = intval(readline("Enter your user ID: ") . PHP_EOL);

$accountName = null;
$accountBalance = null;
$accountMoneyRequest = null;
// Используем более осмысленное имя переменной, например, $selectedUser
$selectedUser = null;

$sessionHistory = array();


foreach ($users as $user) {
    if ($user['id'] === $userInput) {
        $selectedUser = $user;
        break;
    }
}

if ($selectedUser !== null) {
    try {
        $login = new Login($selectedUser['id']);
    } catch (Exception $e) {
        echo "Invalid data." . PHP_EOL;
        exit;
    }

    $accountName = $selectedUser['name'];
    $accountBalance = isset($selectedUser['balance']) ? $selectedUser['balance'] : 5000;
    $accountMoneyRequest = isset($selectedUser['balance']) ? $selectedUser['balance'] : 20;

    echo PHP_EOL;
    echo "Account Name: " . $accountName . PHP_EOL;

    $userBankAccount = new BankAccount($accountBalance, $accountMoneyRequest);
    echo "Welcome, User ID: " . $login->getUserId() . ". Your balance: $" . $userBankAccount->getBalance() . PHP_EOL;

    $sessionHistory = [];

    while (true) {
        echo "Select an action:" . PHP_EOL;
        echo "1 Deposit" . PHP_EOL;
        echo "2 Withdraw" . PHP_EOL;
        echo "3 Money Request" . PHP_EOL;
        echo "Any other key will exit" . PHP_EOL;
        $userDes = readline("Your action: ");

        if ($userDes === '1') {
            $depositAmount = intval(readline("Enter the amount to deposit: "));
            $userBankAccount->getBalanceManager()->deposit($depositAmount);
            echo "After deposit: Your balance is: $" . $userBankAccount->getBalance() . PHP_EOL;
            $sessionHistory[] = "Deposited: $" . $depositAmount;
        } elseif ($userDes === '2') {
            $withdrawAmount = intval(readline("Enter the amount to withdraw: "));
            $userBankAccount->getBalanceManager()->withdraw($withdrawAmount);
            echo "After withdrawal: Your balance is: $" . $userBankAccount->getBalance() . PHP_EOL;
            $sessionHistory[] = "Withdrawn: $" . $withdrawAmount;
        } elseif ($userDes === "3") {
            $requestAmount = intval(readline("Enter the amount to request: "));
            $userBankAccount->getRequestManager()->setAmount($requestAmount);
            echo "After money request: Your balance is: $" . $userBankAccount->getAmount() . PHP_EOL;
            $sessionHistory[] = "Money requested: $" . $requestAmount;
        } else {
            break;
        }
    }

    echo "Session History:" . PHP_EOL;
    foreach ($sessionHistory as $historyItem) {
        echo "- " . $historyItem . PHP_EOL;
    }
} else {
    echo "Please select a valid user" . PHP_EOL;
}
