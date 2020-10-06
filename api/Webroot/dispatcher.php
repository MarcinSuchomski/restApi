<?php

/*
 * Dispatcher class
 *
 * validate reqyest tyoe and routes request to correct controler
 * */

class Dispatcher
{

    private $request;
    // mapping controller methods to request type only correct setup will be acceptable
    private $reqestActionArray = array(
        "GET" => "GET",
        "POST" => "CREATE",
        "PUT" => "UPDATE",
        "DELETE" => "DELETE"
    );

    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);


        $controller = $this->loadController();

        if (isset($this->reqestActionArray[$this->request->requestMethod]) && $this->reqestActionArray[$this->request->requestMethod] == strtoupper(
                $this->request->action
            )) {
            //remove first element of array since i dont need it any more
            array_shift($this->request->params);

            $result = call_user_func_array([$controller, $this->request->action], $this->request->params);
            header($result['status_code_header']);
            echo $result['body'];
        } else {
            header("HTTP/1.1 404 Not Found");
            exit();
        }
        // if fails response with header

    }

    /*
     * checking if correct class/method exist and initialize it
     * */
    public function loadController()
    {
        //create Crontroler name
        $name = $this->request->controller . "Controller";
        $file = ROOT . 'Controllers/' . $name . '.php';

        if (!file_exists($file)) {
            header("HTTP/1.1 404 Not Found");
            exit();
        }

        //require class
        require($file);

        //initiate class
        $controller = new $name();

        return $controller;
    }


}

?>