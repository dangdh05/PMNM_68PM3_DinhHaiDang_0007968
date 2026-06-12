<?php
class home
{
    public function index()
    {
        header('Location: ' . BASE_URL . '/sinhvien/index');
        exit();
    }
    public function login()
    {
        require_once '../app/views/home/login.php';
    }
}
