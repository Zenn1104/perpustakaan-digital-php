<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Controller;

use BasoMAlif\PerpustakaanDigitalUkk\App\View;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\User;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UserCreateOrUpdateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UserLoginRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UserUpdateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\UserRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Service\UserService;


class UserController
{
    private UserService $userService;
    private UserRepository $userRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->userRepository = new UserRepository($connection);
        $this->userService = new UserService($this->userRepository);
    }

    public function register()
    {
        View::render('/register', [
            'title' => 'Register | Perpustakaan Digital'
        ]);
    }

    public function postRegister()
    {
        $request = new UserCreateOrUpdateRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->email = $_POST['email'];
        $request->alamat = $_POST['alamat'];
        $request->level = $_POST['level'];

        try{
            $this->userService->create($request);
            View::redirect("/users/login");
        } catch (ValidationException $exception) {
            View::render('/register', [
                'title' => 'Register | Perpustakaan Digital',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function login()
    {
        View::render('/login', [
            'title' => 'Login | Perpustakaan Digital',       
        ]);
    }

    public function postLogin()
    {
        $request = new UserLoginRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        try{
            $res = $this->userService->login($request);
            session_start();
            $_SESSION['id_user'] = $res->user->id;
            $_SESSION['username'] = $res->user->username;
            $_SESSION['password'] = $res->user->password;
            $_SESSION['email'] = $res->user->email;
            $_SESSION['alamat'] = $res->user->alamat;
            $_SESSION['level'] = $res->user->level;
            View::redirect("/");
        } catch (ValidationException $exception) {
            View::render('/login', [
                'title' => 'Login | Perpustakaan Digital',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function create()
    {
        View::render('Admin/tambahUser', [
            'title' => 'Tambah User | Perpustakaan Digital'
        ]);
    }

    public function postCreate()
    {
        $request = new UserCreateOrUpdateRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->email = $_POST['email'];
        $request->alamat = $_POST['alamat'];
        $request->level = $_POST['level'];

        try{
            $this->userService->create($request);
            View::redirect("/users");
        } catch (ValidationException $exception) {
            View::render('/register', [
                'title' => 'Tambah User | Perpustakaan Digital',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function findAll()
    {
        $users = $this->userService->findAll();
        View::render('/Admin/users', [
            'title' => 'Daftar Users | Perpustakaan Digital',
            'users' => $users            
        ]);
    }

    public function update(string $parameter) 
    {
        $userId = $parameter;
        $user = $this->userRepository->findById($userId);

        View::render('Admin/updateUser', [
            'title' => 'Update User | Perpustakaan Digital',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'password' => $user->password,
                'email' => $user->email,
                'alamat' => $user->alamat,
                'level' => $user->level,
            ]
        ]);
    }

    public function postUpdate(string $parameter)
    {
        $userId = $parameter;
        $user = $this->userRepository->findById($userId);

        $request = new UserUpdateRequest();
        $request->id = $user->id;
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->email = $_POST['email'];
        $request->alamat = $_POST['alamat'];
        $request->level = $_POST['level'];


        try{
            $this->userService->update($request);
            View::redirect("/users");
        } catch (ValidationException $exception) {
            View::render('Admin/updateUser', [
                'title' => 'Update User | Perpustakaan Digital',
                'error' => $exception->getMessage(),
                'user' => [
                    'id' => $user->id,
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'alamat' => $_POST['alamat'],
                    'level' => $_POST['level'],
                ]
                ]);
        }

    }

    public function delete(string $parameter)
    {
        $userId = $parameter;
        $this->userService->delete($userId);
        View::redirect('/users');
    }

    public function logout() 
    {
        session_start();

        unset($_SESSION['id_user']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['email']);
        unset($_SESSION['alamat']);
        unset($_SESSION['level']);

        session_unset();
        session_destroy();
        View::redirect("/users/login");
    }
}