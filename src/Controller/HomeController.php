<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Controller;

use BasoMAlif\PerpustakaanDigitalUkk\App\View;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\BookRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Service\BookService;
use BasoMAlif\PerpustakaanDigitalUkk\Service\UserService;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
// use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\UserRepository;

class HomeController
{

    private UserService $userService;
    private BookService $bookService;
    private BookRepository $bookRepository;
    private UserRepository $userRepository;


    public function __construct()
    {
        $connection = Database::getConnection();
        $this->userRepository = new UserRepository($connection);
        $this->bookRepository = new BookRepository($connection);
        $this->userService = new UserService($this->userRepository);
        $this->bookService = new BookService($this->bookRepository);
    }

    function index() : void 
    {
        $userid = $_SESSION['id_user'];
        $user = $this->userRepository->findById($userid);
        $books = $this->bookService->findAll();
        $model = [
            "title" => "Dasboard | Perpustakaan Digital",
            "user" => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'alamat' => $user->alamat,
                'level' => $user->level
            ],
            "books" => $books,
        ];
        
        View::render('Home/index', $model);
    }

    function hello() : void 
    {
        echo 'HomeController.hello()';
    }

    function world() : void 
    {
        echo 'HomeController.world()';
    }

    function login() : void {
        $request = [
            "username" => $_POST['username'],
            "password" => $_POST['password']
        ];
    }
}