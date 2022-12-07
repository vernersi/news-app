<?php
namespace App\Services;

class RegisterServicesRequest{
    private string $name;
    private string $email;
    private string $password;

    public function __construct(string $name, string $email, string $password){

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getPassword(): string
    {
        return $hashedPassword=password_hash($this->password,PASSWORD_DEFAULT);
    }

}