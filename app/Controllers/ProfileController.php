<?php
namespace App\Controllers;
use App\Template;

class ProfileController{
    public function showForm(): Template{
        var_dump($_SESSION['auth_id']);die;
        return new Template('/profile.twig',[]);
    }
}