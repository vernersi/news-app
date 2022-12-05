<?php
namespace App\Services;
use Doctrine\DBAL\Connection;

class LoginService{
    private Connection $connection;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV['dbname'],
            'user' => $_ENV['user'],
            'password' => $_ENV['password'],
            'host' => $_ENV['host'],
            'driver' => $_ENV['driver']
        ];
        $this->connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    }
    public function execute(LoginServicesRequest $request)
    {
        $email = $request->getEmail();
        $password = $request->getPassword();

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $dbPassword = $this->connection->fetchOne('SELECT password FROM news_api.users WHERE email = ?', [$email]);
        if (password_verify($password,$dbPassword)){
            session_start();
            $name = $this->connection->fetchOne('SELECT name FROM news_api.users WHERE email = ?', [$email]);
            echo 'Welcome'.' '.$name;
        } else {
            echo 'Sorry, you entered wrong Details!';die;
        }

    }
}