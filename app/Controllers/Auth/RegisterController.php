<?php
/**
 * Created by PhpStorm.
 * User: juanlu
 */

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;
use Sirius\Validation\Validator;

/**
 * Class RegisterController donde se controla el registro de usuarios
 * @package App\Controllers\Auth
 */
class RegisterController extends BaseController{
    /**
     * Ruta /registro donde se muestra la página de registro de usuarios
     *
     * @return String Render de la página
     */
    public function getRegister(){
        return $this->render('auth/register.twig',[]);
    }


    /**
     * Ruta /registro donde se manda el formulario de la página de registro de usuarios
     *
     * @return String página de inicio si ha salido el registro satisfactorio o
     * Render de la página con erroes si el registro ha fallado
     */
    public function postRegister(){
        $validator = new Validator();

        $validator->add('name:Nombre', 'required', [], 'El {label} es obligatorio');
        $validator->add('name:Nombre', 'minlength', ['min' => 5], 'El {label} debe tener al menos 5 caracteres');
        $validator->add('email:Email', 'required', [], 'El {label} es obligatorio');
        $validator->add('email:Email', 'email', [], 'No es un email válido');
        $validator->add('password1:Password', 'required', [], 'La {label} es requerida');
        $validator->add('password1:Password', 'minlength', ['min' => 8], 'La {label} debe tener al menos 8 caracteres');
        $validator->add('password2:Password', 'required', [], 'La {label} es requerida');
        $validator->add('password2:Password', 'match', 'password1', 'Las passwords deben coincidir');



        if($validator->validate($_POST)){
            $user = new User();

            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->password = password_hash($_POST['password1'], PASSWORD_DEFAULT);

            $user->save();

            header('Location: '.BASE_URL);
        }else{
            $errors = $validator->getMessages();
        }

        return $this->render('auth/register.twig', ['errors' => $errors]);
    }

}