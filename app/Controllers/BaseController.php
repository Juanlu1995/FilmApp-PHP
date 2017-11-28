<?php

namespace App\Controllers;

class BaseController {
    public function __construct() {
        //Inicializar el motor de template
        $loader = new \Twig_Loader_Filesystem('../views');
        $this->templateEngine = new \Twig_Environment($loader,[
            'debug' => true,
            'cache' => false
        ]);

        //Extender Twig
        //Filtros: toman una cadena y la modifican
        $this->templateEngine->addFilter(new \Twig_SimpleFilter('url', function ($path){
            return BASE_URL.$path;
        }))
    }
}