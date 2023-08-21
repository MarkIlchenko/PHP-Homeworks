<?php

require_once 'UserSerivice.php';
class User
{

    protected static int $counter = 0;
    protected array $phones = [];

    protected array $methodAlias = [
        'setName' => 'rename'
    ];
    public function __construct(protected string $name, protected string $email){
        self::$counter++;
    }

    public function __destruct()
    {
        echo ' !!!!!! ' . (--self::$counter);
    }

    public function getPhones(): array {
        return $this->phones;
    }
    public function getName(): string
    {
        return $this->name . ' - ' . self::$counter;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function addPhones(string $phones): void {
        $this->phones[] = $phones;
    }

    public function rename(string $newName): void {
        if (mb_strlen($newName) < 3) {
            throw new Exception('The name is short');
        }
        $this->name = $newName;
    }
    public static function getCounter(): int
    {
        return self::$counter;
    }

    public function __call($method, $arg) {
        if (!isset($this->methodAlias[$method])) {
           throw new Exception("Method $method doesnt exist");
        }
        $alterNameMethod = $this->methodAlias[$method];
        return call_user_func_array([$this, $alterNameMethod], $arg);
//        $this->$alterNameMethod($arg);
    }
}

$user = UserSerivice::createUser('Mark', "asds@gasf.com");

$user2 = UserSerivice::createUser('Dima', "asds2@gasf.com");
$user3 = UserSerivice::createUser('Marina', "asds3@gasf.com");
$user4 = UserSerivice::createUser('Mark New', 'asds4@gasf.com');

echo $user4->getName() . PHP_EOL;
//$name = readline("Enter your name: ");
//$email = readline("Enter your email: ");
//
//try {
//    $user5 = UserSerivice::createUser($name, $email);
//} catch (Exception $e) {
//   echo "Error " . $e ->getMessage() . PHP_EOL;
//}

echo 'Count of users: ' . User::getCounter() . PHP_EOL;
exit;
