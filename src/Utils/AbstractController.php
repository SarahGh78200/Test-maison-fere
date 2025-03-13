<?php

namespace App\Utils;

abstract class AbstractController
{
    protected array $arrayError = [];

    public function redirectToRoute($route)
    {
        http_response_code(303);
        header("Location: {$route}");
        exit;
    }

    public function isNotEmpty($value)
    {
        if (empty($_POST[$value])) {
            $this->arrayError[$value] = "Le champ $value ne peut pas être vide.";
            return $this->arrayError;
        }
        return false;
    }

    protected function render(string $view, array $data = [])
    {
        extract($data); // Permet d'utiliser directement les clés du tableau comme variables
        require_once __DIR__ . "/../Views/$view.php"; // Charge la vue demandée
    }

    public function checkFormat($nameInput, $value)
    {
        $regexName = '/^[a-zA-Zà-üÀ-Ü -_]{2,255}$/';
        $regexPassword = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
        $regexTitle = '/^[a-zA-Zà-üÀ-Ü0-9 #?!@$%^,.;&*-]{4,255}$/';
        $regexContent = '/^[a-zA-Zà-üÀ-Ü0-9 #?!@$%^,.;&*-]{4,}$/';
        $regexRole = '/^[12]$/';
        $regexAvailability = '/^(disponible|indisponible)$/i';

        switch ($nameInput) {
            case 'pseudo':
                if (!preg_match($regexName, $value)) {
                    $this->arrayError['name'] = 'Merci de renseigner un pseudo correct!';
                }
                break;
            case 'mail':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->arrayError['mail'] = 'Merci de renseigner un e-mail correct!';
                }
                break;
            case 'password':
                if (!preg_match($regexPassword, $value)) {
                    $this->arrayError['password'] = 'Merci de donner un mot de passe avec au minimum : 8 caractères, 1 majuscule, 1 minuscule, 1 caractère spécial!';
                }
                break;
            case 'title':
                if (!preg_match($regexTitle, $value)) {
                    $this->arrayError['title'] = 'Merci de renseigner un titre correct!';
                }
                break;
            case 'description':
                if (!preg_match($regexTitle, $value)) {
                    $this->arrayError['description'] = 'Merci de renseigner une description correcte!';
                }
                break;
            case 'content':
                if (!preg_match($regexContent, $value)) {
                    $this->arrayError['content'] = 'Merci de renseigner un contenu correct!';
                }
                break;
            case 'idRole':
                if (!preg_match($regexRole, $value)) {
                    $this->arrayError['idRole'] = 'Merci de renseigner un rôle correct!';
                }
                break;
            case 'availability':
                if (!preg_match($regexAvailability, $value)) {
                    $this->arrayError['availability'] = 'La valeur doit être "disponible" ou "indisponible".';
                }
                break;
        }
    }

    public function check($nameInput, $value)
    {
        $this->isNotEmpty($nameInput);

        if (is_string($value)) {
            $value = htmlspecialchars($value);
        }

        $this->checkFormat($nameInput, $value);
        return $this->arrayError;
    }
}
