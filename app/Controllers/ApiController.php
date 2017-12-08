<?php
namespace App\Controllers;

use App\Models\Film;

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