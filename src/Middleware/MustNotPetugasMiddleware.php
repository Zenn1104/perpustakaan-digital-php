<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Middleware;

use BasoMAlif\PerpustakaanDigitalUkk\App\View;

class MustNotPetugasMiddleware implements Middleware
{
    function before(): void
    {
        $userlevel = $_SESSION;
        if ($userlevel == null) {
            View::redirect("/");
        }
    }
}