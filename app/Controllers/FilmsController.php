<?php

namespace App\Controllers;

use App\Models\Film;

class FilmsController extends BaseController {
    /**
     * Ruta [GET] /films/new que muestra el formulario de añadir una nueva película
     *
     * @return String Render de la web con toda la información.
     */
    public function getNew() {
        $webInfo = [
            'h1' => 'Añadir Película',
            'submit' => 'Añadir',
            'method' => 'POST'
        ];

        //TODO hacer errores de validación.

        //Se construye un array asociativo $film con todas sus claves vacías

        $film = array_fill_keys(['name', 'date', 'cover', 'category', 'rating'], "");

        return $this->render('formFilm.twig', [
            'film' => $film,
            'webInfo' => $webInfo
        ]);
    }

    /**
     * Ruta [GET] /films/
     */
    public function getIndex($id = null) {
        if (is_null($id)) {
            $webInfo = [
                'title' => 'Página de Inicio - filmApp'
            ];

            $films = film::query()->orderBy('id', 'desc')->get();
            //$films = film::all();

            return $this->render('home.twig', [
                'films' => $films,
                'webInfo' => $webInfo
            ]);

        } else {
            // Recuperar datos

            $webInfo = [
                'title' => 'Página de film - filmApp'
            ];

            $film = film::find($id);

            if (!$film) {
                return $this->render('404.twig', ['webInfo' => $webInfo]);
            }

            //dameDato($film);
            return $this->render('film.twig', [
                'film' => $film,
                'webInfo' => $webInfo]);
        }

    }
}