<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\App;

// sebuah object yang digunakan untuk membuat routing aplikasi
class Router 
{
    // attribut routes yang akan diisi data bertipe array 
    private static array $routes = [];

    // method class untuk menambahkan sebuah routing
    public static function add(string $method,
                               string $path,
                               string $controller,
                               string $function,
                               array $middlewares = []) : void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middlewares,
        ];
    }

    // method class untuk menjalankan aplikasi
    public static function run(): void {
        // mengisi variable path dengan default / atau index
        $path = '/';
        // mengecek apabila terdapat path info maka variable path diatas diganti menjadi path yang diakses dari path info
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        // mengisi variable methode dengan method yang diakses di browser
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            // Mengubah pola untuk menangkap parameter
            $pattern = "#^" . preg_replace('/:\w+/', '(\w+)', $route['path']) . "$#";
            if (preg_match($pattern, $path, $variables) && $method == $route['method']) {

                $parameter = $pattern;
                global $parameter;
                // Memanggil semua middleware
                foreach ($route['middleware'] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }

                $function = $route['function'];
                $controller = new $route['controller'];

                // Menghapus elemen pertama karena berisi string URL lengkap
                array_shift($variables);
                // Menangkap parameter dan memanggil fungsi dengan parameter tersebut
                call_user_func_array([$controller, $function], $variables);

                return;
            }
        }

        // mengembalikkan response 404/not found jika path yang diakses tidak ada
        http_response_code(404);
        echo 'CONTROLLER NOT FOUND';
    }
}