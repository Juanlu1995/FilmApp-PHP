<?php
namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;
use Sirius\Validation\Validator;

class AuthController extends BaseController {

    public function getLogin(){
        return $this->render('auth/login.twig',[]);
    }

    public function postLogin(){
        $validator = new Validator();

        $validator->add('email:Email','required',[],"El campo {label} es requerido");
        $validator->add('email:Email','email',[],"El campo {label} no es un email válido");
        $validator->add('password:Password','required',[],"El campo {label} es requerido");

        if ($validator->validate($_POST)){
            $user = User::where('email',$_POST['email'])->first();
            if (password_verify($_POST['password'],$user->password)){
                $_SESSION['userId'] = $user->id;
                $_SESSION['userName'] = $user->name;
                $_SESSION['userEmail'] = $user->email;

                header('Location: '. BASE_URL);

                return null;
            }
            $validator->addMessage('authError','Los datos son incorrectos');
        }
        //todo LOGS

        return $this->render('auth/login.twig',[
            'errors' => $validator->getMessages()
        ]);
    }

    public function getLogout(){
        unset($_SESSION['userId']);
        unset($_SESSION['userName']);
        unset($_SESSION['userEmail']);

        header("Location: ". BASE_URL);
    }
}