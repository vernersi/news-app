<?php
namespace App\Controllers;
use App\Services\RegisterService;
use App\Services\RegisterServicesRequest;
use App\Template;

class RegisterController {

        public function showForm():Template{

            return new Template('/register.twig', [
            ]);
        }

        public function store(){
            if ($_POST['password']!==$_POST['password-repeat']) {
                echo 'Repeated Password does not match!';die;
}
            $registerService = new RegisterService();
            $registerService->execute(
                new RegisterServicesRequest(
                    $_POST['name'],
                    $_POST['email'],
                    $_POST['password'],
                )
            );

            //header() + location <--- redirects
        }
}