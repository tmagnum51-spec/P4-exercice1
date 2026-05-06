<?php


class HomeController
{
    public function index(){
        $message='bonjour';
        require_once 'app/views/home.php';
    }
}