<?php
namespace App\Controllers;

use App\Model\Film;

class FilmsController extends BaseController {
    /**
     * Ruta [GET] /films/new que muestra el formulario de añadir una nueva película
     *
     * @return String Render de la web con toda la información.
     */
    public function getNew(){
        $webInfo = [
            'h1'        => 'Añadir Película',
            'submit'    => 'Añadir',
            'method'    => 'POST'
        ];

        //TODO hacer errores de validación.

        //Se construye un array asociativo $film con todas sus claves vacías

        $film = array_fill_keys(['name','date','cover','category','rating'], "");

        return $this->render('formFilm.twig',[
           'film' => $film,
           'webInfo' => $webInfo
        ]);
    }
}