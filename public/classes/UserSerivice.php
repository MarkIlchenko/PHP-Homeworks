<?php
require_once 'User.php';
class UserSerivice
{
    /**
     * @var User []
     */
    protected static array $users = [];

    public static function createUser(string $name, string $email): User {
        self::checkEmail($email);

        if (!is_null($email)) {
            $user = new User($name, $email);
            self::$users[$email]  = $user;
        } else {
            $user = new User($name);
        }

        return $user;
    }

    public static function checkEmail(string $email)
    {
        if (isset(self::$users[$email])) {
            throw new Exception('Email isnt free');
        }
        foreach (self::$users as $user) {
            if ($user->getEmail() === $email) {
                throw new Exception('Email isnt free ');
            }
        }
        return true;
    }

}
