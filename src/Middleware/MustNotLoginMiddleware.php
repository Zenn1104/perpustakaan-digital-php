<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Middleware;

use BasoMAlif\PerpustakaanDigitalUkk\App\View;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\UserRepository;

class MustNotLoginMiddleware implements Middleware
{

    private UserRepository $userRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->userRepository = new UserRepository($connection);
    }


    function before(): void
    {
        session_start();
        $user = $_SESSION ?? '';
        if(isset($user)) {
            View::redirect("/");
        }
    }
}