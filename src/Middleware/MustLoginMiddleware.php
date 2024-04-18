<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Middleware;

use BasoMAlif\PerpustakaanDigitalUkk\App\View;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\UserRepository;

class MustLoginMiddleware implements Middleware
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
        $userid = $_SESSION['id_user'];
        $user = $this->userRepository->findById($userid);
        if  ($user == null) {
            View::redirect("/users/login");
        }
    }
}