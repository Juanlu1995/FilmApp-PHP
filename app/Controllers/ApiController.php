<?php
namespace App\Controllers;

use App\Models\Film;

/**
 * Class ApiController controlador de la API de la aplicación.
 * Devuelve los datos de la tabla "films" de nuestra base de datos
 * @package App\Controllers
 */
class ApiController{
    public function getFilms($id = null){
        if (is_null($id)) {
            $films = Film::all();

            header('Content-Type: application/json');
            return json_encode($films);
        } else {
            $film = Film::find($id);

            header('Content-Type: application/json');
            return json_encode($film);
        }
    }
}