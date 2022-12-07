<?php
namespace App\Services;
use App\Database;
use App\Redirect;
use Doctrine\DBAL\Connection;

class LoginService{

    public function execute(LoginServicesRequest $request)
    {
        $email = $request->getEmail();
        $password = $request->getPassword();

        if (!Database::getConnection()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $dbPassword = Database::getConnection()->fetchOne('SELECT password FROM news_api.users WHERE email = ?', [$email]);
        if (password_verify($password,$dbPassword)){
            $_SESSION['auth_id']=Database::getConnection()->fetchOne('SELECT id FROM news_api.users WHERE email = ?', [$email]);
            return new Redirect('/profile');
        } else {
            echo 'Sorry, you entered wrong Details!';die;
        }

    }
}