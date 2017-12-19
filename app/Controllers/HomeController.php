<?php
namespace App\Controllers;

use App\Controllers\Auth\AuthController;
use App\Controllers\Auth\RegisterController;

class HomeController extends BaseController {

    /**
     * Ruta / donde se muestra la página de inicio del proyecto.
     *
     * @return string Render de la página
     */
    public function getIndex(){
        $films = new FilmsController();

        return $films->getIndex();
    }

    // todo hacer página de contacto
    public function getContacto(){
        return 'Información de contacto';
    }

    /**
     * Ruta /login donde se muestra la página de logueo de usuarios
     *
     * @return String Render de la página
     */
    public function getLogin(){
        $auth = new AuthController();

        return $auth->getLogin();
    }

    /**
     * Ruta /login donde se mandan los datos de la página de logueo de usuarios.
     * Si hay errores, se hace render de la página de logueo con los errores
     *
     * @return null|string redirección a página principal o Render de la página con errores
     */
    public function postLogin(){
        $auth = new AuthController();

        return $auth->postLogin();
    }

    /**
     * Ruta /registro donde se muestra la página de registro de usuarios
     *
     * @return String Render de la página
     */
    public function getRegistro(){
        $register = new RegisterController();

        return $register->getRegister();
    }

    /**
     * Ruta /registro donde se manda el formulario de la página de registro de usuarios
     *
     * @return String página de inicio si ha salido el registro satisfactorio o
     * Render de la página con erroes si el registro ha fallado
     */
    public function postRegistro(){
        $register = new RegisterController();

        return $register->postRegister();
    }

    /**
     * Ruta /logout en la cual se deslogua al usuario
     */
    public function getLogout(){
        $auth = new AuthController();

        return $auth->getLogout();
    }


    public function getInvitacion(){
        $reg = new RegisterController();

        return $reg->getInvitacion();
    }

    public function postInvitacion(){
        $reg = new RegisterController();

        return $reg->postInvitacion();
    }
    /**
     * Sólo accedemos a esta página cuando la página que buscamos no ha sido encontrada
     * @param $route String ruta a la cual el usuario a intentado acceder
     * @return string Render de la página de erorr 404
     */
    public function get404($route){
        $webInfo = [
            'title' => $route
        ];
        return $this->render("404.twig",[$webInfo]);
    }
}