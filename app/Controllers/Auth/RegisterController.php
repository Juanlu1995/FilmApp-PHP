<?php
/**
 * Created by PhpStorm.
 * User: juanlu
 */

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Invitation;
use App\Models\User;
use Sirius\Validation\Validator;

/**
 * Class RegisterController donde se controla el registro de usuarios
 * @package App\Controllers\Auth
 */
class RegisterController extends BaseController {
    /**
     * Ruta /registro donde se muestra la página de registro de usuarios
     *
     * @return String Render de la página
     */
    public function getRegister() {
        return $this->render('auth/register.twig', []);
    }


    /**
     * Ruta /registro donde se manda el formulario de la página de registro de usuarios
     *
     * @return String página de inicio si ha salido el registro satisfactorio o
     * Render de la página con erroes si el registro ha fallado
     */
    public function postRegister() {
        $validator = new Validator();

        $validator->add('name:Nombre', 'required', [], 'El {label} es obligatorio');
        $validator->add('name:Nombre', 'minlength', ['min' => 5], 'El {label} debe tener al menos 5 caracteres');
        $validator->add('email:Email', 'required', [], 'El {label} es obligatorio');
        $validator->add('email:Email', 'email', [], 'No es un email válido');
        $validator->add('password1:Password', 'required', [], 'La {label} es requerida');
        $validator->add('password1:Password', 'minlength', ['min' => 8], 'La {label} debe tener al menos 8 caracteres');
        $validator->add('password2:Password', 'required', [], 'La {label} es requerida');
        $validator->add('password2:Password', 'match', 'password1', 'Las passwords deben coincidir');


        if ($validator->validate($_POST)) {
            $user = new User();

            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->password = password_hash($_POST['password1'], PASSWORD_DEFAULT);

            $user->save();

            header('Location: ' . BASE_URL);
        } else {
            $errors = $validator->getMessages();
        }

        return $this->render('auth/register.twig', ['errors' => $errors]);
    }


    /**
     * Ruta /invitacion donde de manda el formulario de la página para mandar una invitación
     *
     * @return string Render de la página de invitación.
     */
    public function getInvitacion() {
        return $this->render('auth/invitation/invitation.twig', []);
    }

    public function postInvitacion() {

        $validator = new Validator();

        $validator->add('email:Email', 'required', [], "El campo {label} es obligatorio para poder invitar");
        $validator->add('email:Email', 'email', [], "El campo {label} debe contenet un email válido");

        if ($validator->validate($_POST)) {
            $invitation = new Invitation();

            if (!Invitation::where('email',$_POST['email'])->first()){
                $invitation->email = $_POST['email'];
                $invitation->used = 0;

                $invitation->save();
            }

            return $this->render('auth/invitation/invitationSuccess.twig', []);
        } else {
            $errors = $validator->getMessages();
        }
        return $this->render('auth/invitation/invitation.twig', ['errors' => $errors]);
    }

}