<?php

namespace MyApp\controllers;

class Home {

    //protected $container;
    protected $view;

    /*
    public function __construct($container) {
        $this->container = $container;
    }
    */

    public function __construct($view) {
        $this->view = $view;
    }

    /*
    public function index($request, $response) {

        $view = $this->container->get('View');
        var_dump($view);
        return $response->write('Teste index');

    }
    */

    public function index($request, $response) {

        //$view = $this->container->get('View');
        var_dump($this->view);
        return $response->write('Teste index');

    }

}

?>