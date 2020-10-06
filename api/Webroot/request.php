<?php

/*
 * Request calls
 *
 * store actions / param / methods
 * */

class Request
{
    public $url;
    public $action;
    public $params;
    public $requestMethod;

    public function __construct()
    {
        $this->url = $_SERVER["REQUEST_URI"];
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
    }
}

?>