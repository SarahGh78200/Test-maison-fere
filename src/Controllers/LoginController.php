<?php  
namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class LoginController extends AbstractController
{
    private array $errors = []; // Ajout de cette ligne

    public function index()
    {
        if (isset($_POST['email'], $_POST['password'])) {
            $this->check('email', $_POST['email']);
            $this->check('password', $_POST['password']);

            if (empty($this->arrayError)) {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                $user = User::findByEmail($email);

                if ($user) {
                    if (password_verify($password, $user->getPassword())) {
                        $_SESSION['user'] = [
                            'id' => $user->getId(),
                            'surname' => $user->getSurname(),
                            'name' => $user->getName(),
                            'idUser' => $user->getId(),
                            'idRole' => $user->getId_Role(),
                            'email' => $user->getEmail(),
                        ];
                        $this->redirectToRoute('/');
                    } else {
                        $this->errors['password'] = "Mot de passe incorrect ou adresse mail incorrect";
                    }
                } else {
                    $this->errors['email'] = "Cet email n'existe pas.";
                }
            }
        }

        if (isset($_SESSION['user'])) {
            $this->redirectToRoute('/');
        }

        // On passe $this->errors à la vue
        $errors = $this->errors; // On crée une variable locale
        require_once(__DIR__ . "/../Views/security/login.view.php");
    }
}
