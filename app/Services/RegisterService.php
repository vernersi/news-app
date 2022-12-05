<?php

namespace App\Services;

use Doctrine\DBAL\Connection;

class RegisterService
{
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

    public function execute(RegisterServicesRequest $request)
    {
        $name = $request->getName();
        $email = $request->getEmail();
        $password = $request->getPassword();

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $this->connection->insert('users', [
            'name' => $name,
            'email' => $email,
            'password'=>$password
        ]);


    }
}