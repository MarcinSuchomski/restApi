<?php

/*
 * Router calss
 *
 * slices request
 *
 * controller
 * action - create / get / delete / update
 * params - values passed to method
 *
 * */

class Router
{

    static public function parse($url, $request)
    {
        $url = trim($url);

        $explode_url = explode('/', $url);
        $explode_url = array_slice($explode_url, 2);
        $request->controller = $explode_url[1];
        $request->action = $explode_url[2];
        $request->params = array_slice($explode_url, 2);
    }
}

?>