<?php
session_start();
session_destroy();
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600);
}
header('Location: ' . BASE_URL . '/auth/login');
exit();
