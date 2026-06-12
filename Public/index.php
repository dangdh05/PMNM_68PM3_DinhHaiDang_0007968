<?php
define('BASE_URL', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));

require_once '../app/middleware.php';
$middleware = new Middleware();
$middleware->checklogin();
$app = new App();
