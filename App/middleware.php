<?php
require_once '../app/core/App.php';
session_start();
class middleware
{
    function checklogin()
    {
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
        $publicPages = ['home/login', 'auth/login'];
        if (!isset($_SESSION['username']) && !in_array($url, $publicPages)) {
            header('Location: ' . BASE_URL . '/home/login');
            exit();
        }
    }
}
