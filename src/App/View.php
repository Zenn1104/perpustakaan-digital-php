<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\App;

// sebuah object class untuk mengatasi tampilan dan redirect
class View 
{
    // method class untuk render dengan cara require file 
    public static function render(string $view, $model) 
    {
        require __DIR__ . '/../View/header.php';
        require __DIR__ . '/../View/' . $view . '.php';
        require __DIR__ . '/../View/footer.php';
    }

    // method class untuk redirect dengan builder function header 
    public static function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }
}