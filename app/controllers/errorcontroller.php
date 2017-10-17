<?php
namespace App\Controllers;

class ErrorController
{
    public function indexAction()
    {
        $message = "This page does not exist";
        return compact("message");
    }
}
