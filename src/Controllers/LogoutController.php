<?php

namespace App\Controllers;

use App\Utils\AbstractController;

error_reporting(E_ALL);
ini_set('display_errors', 1);


class LogoutController extends AbstractController
{
    public function logout()
    {
        session_destroy();
        $this->redirectToRoute('/');
    }
}
