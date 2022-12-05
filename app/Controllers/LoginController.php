<?php

namespace App\Controllers;
use App\Services\LoginService;

use App\Services\LoginServicesRequest;
use App\Template;

class LoginController
{
    public function showForm(): Template
    {

        return new Template('/login.twig', [
        ]);
    }

    public function login(){
        $loginService = new LoginService();
        $loginService->execute(
            new LoginServicesRequest(
                $_POST['email'],
                $_POST['password']
            )
        );

        //header() + location <--- redirects
    }

}