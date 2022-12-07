<?php

namespace App\Services;

use App\Database;
use App\Redirect;

class RegisterService
{

    public function execute(RegisterServicesRequest $request)
    {
        $name = $request->getName();
        $email = $request->getEmail();
        $password = $request->getPassword();

        if (!Database::getConnection()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        Database::getConnection()->insert('users', [
            'name' => $name,
            'email' => $email,
            'password'=>$password
        ]);
        return new Redirect('/login');
    }
}