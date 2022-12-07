<?php

namespace App\viewVariables;


class ErrorsViewVariable
{
    public function getName():string
    {
        return 'error';
    }

    public function getValue():array
    {
        return $_SESSION['errors'] ?? [];
    }
}