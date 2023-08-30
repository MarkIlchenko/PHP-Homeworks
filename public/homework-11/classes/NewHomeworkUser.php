<?php

class NewHomeworkUser
{
    private $username;
    private $password;
    private $loggedIn;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        $this->loggedIn = false;
    }

    public function register() {
        echo "User {$this->username} successfully registered." . PHP_EOL;
    }

    public function login($enteredUsername, $enteredPassword) {
        if ($enteredUsername === $this->username && $enteredPassword === $this->password) {
            $this->loggedIn = true;
            echo "User {$this->username} successfully logged in." . PHP_EOL;
        } else {
            echo "Error: Invalid credentials." . PHP_EOL;
        }
    }

    public function isLoggedIn() {
        return $this->loggedIn;
    }

    public function logout() {
        $this->loggedIn = false;
        echo "User {$this->username} successfully logged out." . PHP_EOL;
    }

    public function getUsername() {
        return $this->username;
    }
}