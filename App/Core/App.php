<?php

class App
{
    protected $controller = 'Home';
    protected $action = 'index';
    protected $params = [];

    public function __construct()
    {
        $urlProcessed = $this->UrlProcess();

        if (isset($urlProcessed[0])) {
            $controllerName = ucfirst($urlProcessed[0]);

            if (file_exists('../App/Controller/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($urlProcessed[0]);
            }
        }

        require_once '../App/Controller/' . $this->controller . '.php';

        $this->controller = new $this->controller; // tạo đối tượng controller

        if (isset($urlProcessed[1])) {
            if (method_exists($this->controller, $urlProcessed[1])) {
                $this->action = $urlProcessed[1];
                unset($urlProcessed[1]);
            }
        }

        $this->params = $urlProcessed ? array_values($urlProcessed) : [];

        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    public function UrlProcess()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        return [];
    }
}
