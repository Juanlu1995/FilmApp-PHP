<?php
namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;
use Sirius\Validation\Validator;

/**
 * Class AuthController clase donde se controla el logueo de usuarios
 * @package App\Controllers\Auth
 */
class AuthController extends BaseController {

    /**
     * @return string Render de la página de logueo
     */
    public function getLogin(){
        return $this->render('auth/login.twig',[]);
    }

    /**
     * Ruta /login donde se mandan los datos de la página de logueo de usuarios.
     * Si hay errores, se hace render de la página de logueo con los errores
     *
     * @return null|string redirección a página principal o Render de la página con errores
     */
    public function postLogin(){

        $validator = new Validator();

        $validator->add('email:Email','required',[],"El campo {label} es requerido");
        $validator->add('email:Email','email',[],"El campo {label} no es un email válido");
        $validator->add('password:Password','required',[],"El campo {label} es requerido");

        if ($validator->validate($_POST)){
            $user = User::where('email',$_POST['email'])->first();
            if ($user) {
                if (password_verify($_POST['password'], $user->password)) {
                    $_SESSION['userId'] = $user->id;
                    $_SESSION['userName'] = $user->name;
                    $_SESSION['userEmail'] = $user->email;

                    header('Location: ' . BASE_URL);

                    return null;
                }
            }
            $validator->addMessage('authError','Los datos son incorrectos');
        }
        //todo LOGS

        return $this->render('auth/login.twig',[
            'errors' => $validator->getMessages()
        ]);
    }

    /**
     * Ruta /logout en la cual se deslogua al usuario
     */
    public function getLogout(){
        unset($_SESSION['userId']);
        unset($_SESSION['userName']);
        unset($_SESSION['userEmail']);

        header("Location: ". BASE_URL);
    }
}