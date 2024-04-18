<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Middleware;
use BasoMAlif\PerpustakaanDigitalUkk\App\View;

class MustEmployeMiddleware implements Middleware
{
    function before(): void
    {
        $userlevel = $_SESSION['level'];
        if ($userlevel == 'Peminjam') {
            View::redirect("/");
        }
    }
}