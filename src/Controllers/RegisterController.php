<?php  
namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class RegisterController extends AbstractController
{
    private array $errors = []; // Déclaration correcte des erreurs

    public function index()
    {
        if (isset($_POST['surname'], $_POST['name'], $_POST['birth_date'], $_POST['password'], $_POST['idRole'], $_POST['email'])) {
            $this->check('email', $_POST['email']);
            $this->check('name', $_POST['name']);
            $this->check('surname', $_POST['surname']);
            $this->check('password', $_POST['password']);
            $this->check('idRole', $_POST['idRole']); // Vérification de l'email

            if (empty($this->arrayError)) {
                $name = htmlspecialchars($_POST['name']);
                $surname = htmlspecialchars($_POST['surname']);
                $birth_date = htmlspecialchars($_POST['birth_date']);
                $password = htmlspecialchars($_POST['password']);
                $id_role = htmlspecialchars($_POST['idRole']);
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Vérification si l'email existe déjà
                if (User::findByEmail($email)) {
                    $this->errors['email'] = "Cette adresse e-mail est déjà utilisée.";
                }

                // Vérifier si l'utilisateur a plus de 18 ans
                $birthDate = new \DateTime($birth_date);
                $currentDate = new \DateTime();
                $age = $currentDate->diff($birthDate)->y; // Calcul de l'âge

                if ($age < 18) {
                    $this->errors['birth_date'] = "Vous devez avoir au moins 18 ans pour vous inscrire.";
                }

                // Si tout est OK, on enregistre l'utilisateur
                if (empty($this->errors)) {
                    $user = new User(null, $surname, $name, $birth_date, $passwordHash, $id_role, $email);
                    if ($user->save()) {
                        $this->redirectToRoute('/');
                    } else {
                        $this->errors['global'] = "Erreur lors de l'enregistrement de l'utilisateur.";
                    }
                }
            }
        }

        // Passer les erreurs à la vue
        $errors = $this->errors;
        require_once(__DIR__ . "/../Views/security/register.view.php");
    }
}