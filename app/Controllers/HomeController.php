<?php
namespace App\Controllers;

class HomeController {

    /**
     * Ruta / donde se muestra la página de inicio del proyecto.
     *
     * @return string Render de la página
     */
    public function getIndex(){
        $films = new FilmsController();

        return $films->getIndex();
    }

    public function getContacto(){
        return 'Información de contacto';
    }
}