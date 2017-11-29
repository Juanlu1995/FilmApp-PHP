<?php

namespace App\Controllers;

use App\Models\Film;
use Sirius\Validation\Validator;

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

    public function postNew() {
        $webInfo = [
            'h1'        => 'Añadir Película',
            'submit'    => 'Añadir',
            'method'    => 'POST'
        ];

        if (!empty($_POST)) {
            $validator = new Validator();

            $requiredFieldMessageError = "El {label} es requerido";

            $validator->add('name:Name', 'required', [], $requiredFieldMessageError);
            $validator->add('date:Date', 'required', [], $requiredFieldMessageError);
            $validator->add('category:Category', 'required', [], $requiredFieldMessageError);

            $film['name'] = htmlspecialchars(trim($_POST['name']));
            $film['date'] = date("Y-m-d",strtotime($_POST['date']));
            $film['category'] = htmlspecialchars(trim($_POST['category']));
            $film['cover'] = htmlspecialchars(trim($_POST['cover'])) ?? array();
            $film['rating'] = htmlspecialchars(trim($_POST['rating'])) ?? array();

            if ($validator->validate($_POST)) {
                $film = new Film([
                    'name' => $film['name'],
                    'date' => $film['date'],
                    'category' => $film['category'],
                    'cover' => $film['cover'],
                    'rating' => $film['rating']
                ]);
                $film->save();

                // Si se guarda sin problemas se redirecciona la aplicación a la página de inicio
                header('Location: ' . BASE_URL);

            } else {
                $errors = $validator->getMessages();
            }
        }

        return $this->render('formFilm.twig',[
            'film' => $film,
            'errors' => $errors,
            'webInfo' => $webInfo
        ]);
    }


    /**
     * Ruta [GET] /films/edit/{id} que muestra el formulario de actualización de una nueva película.
     *
     * @param id int Código de la película.
     *
     * @return string Render de la web con toda la información.
     */
    public function getEdit($id){
        $errors = array();

        $webInfo = [
            'h1' => 'Añadir Película',
            'submit' => 'Añadir',
            'method' => 'POST'
        ];

        //Recuperamos los datos
        $film = Film::find($id);
        if (!$film){
            header('Location: home.twig');
        }

        return $this->render('formFilm.twig',[
           'film' => $film,
           'webInfo' => $webInfo,
            'errors' => $errors
        ]);
    }

    /**
     * Ruta [PUT] /films/edit/{id} que actualiza toda la información de una película. Se usa el verbo
     * put porque la actualización se realiza en todos los campos de la base de datos.
     *
     * @param id int Código de la película.
     *
     * @return string Render de la web con toda la información.
     */
    public function putEdit($id) {

        $errors = array();  // Array donde se guardaran los errores de validación

        $webInfo = [
            'h1' => 'Actualizar Película',
            'submit' => 'Actualizar',
            'method' => 'PUT'
        ];

        if (!empty($_POST)) {
            $validator = new Validator();

            $requiredFieldMessageError = "El {label} es requerido";

            $validator->add('name:Name', 'required', [], $requiredFieldMessageError);
            $validator->add('date:Date', 'required', [], $requiredFieldMessageError);
            $validator->add('category:Category', 'required', [], $requiredFieldMessageError);

            // Extraemos los datos enviados por POST
            $film['name'] = htmlspecialchars(trim($_POST['name']));
            $film['date'] = date("Y-m-d", strtotime($_POST['date']));
            $film['category'] = htmlspecialchars(trim($_POST['category']));
            $film['cover'] = htmlspecialchars(trim($_POST['cover'])) ?? array();
            $film['rating'] = htmlspecialchars(trim($_POST['rating'])) ?? array();

            if ($validator->validate($_POST)) {
                $film = new Film([
                    'name' => $film['name'],
                    'date' => $film['date'],
                    'category' => $film['category'],
                    'cover' => $film['cover'],
                    'rating' => $film['rating']
                ]);
                $film->save();

                // Si se guarda sin problemas se redirecciona la aplicación a la página de inicio
                header('Location: ' . BASE_URL);

            } else {
                $errors = $validator->getMessages();
            }

            // Si se guarda sin problemas se redirecciona la aplicación a la página de inicio
            return $this->render('formFilm.twig', [
                'film' => $film,
                'errors' => $errors,
                'webInfo' => $webInfo
            ]);
        }
    }



    /**
     * Ruta [GET] /films para la dirección home de la aplicación. En este caso se muestra la lista de películas.
     *
     * @return string Render de la web con toda la información.
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