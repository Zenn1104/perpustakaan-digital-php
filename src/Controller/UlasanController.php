<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Controller;

use BasoMAlif\PerpustakaanDigitalUkk\App\View;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UlasanCreateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UlasanUpdateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\BookRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\UlasanRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\UserRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Service\BookService;
use BasoMAlif\PerpustakaanDigitalUkk\Service\UlasanService;

class UlasanController
{
    private UlasanRepository $ulasanRepository;
    private UserRepository $userRepository;
    private BookRepository $bookRepository;
    private UlasanService $ulasanService;
    private BookService $bookService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->ulasanRepository = new UlasanRepository($connection);
        $this->userRepository = new UserRepository($connection);
        $this->bookRepository = new BookRepository($connection);
        $this->ulasanService = new UlasanService($this->ulasanRepository);
        $this->bookService = new BookService($this->bookRepository);
    }

    public function create() 
    {
        $userid = $_SESSION['id_user'];
        $user = $this->userRepository->findById($userid);
        $books = $this->bookService->findAll();
        $ulasan = $this->ulasanService->findAll();
        View::render("Admin/tambahUlasan", [
            'title' => 'Tambah Ulasan | Perpustakaan Digital',
            'username' => $user->username,
            'ulasan' => $ulasan,
            'books' => $books
        ]);
    }

    public function postCreate()
    {
        session_start();
        $userid = $_SESSION['id_user'];
        $user = $this->userRepository->findById($userid);

        $books = $this->bookService->findAll();
        $ulasan = $this->ulasanService->findAll();

        $request = new UlasanCreateRequest();
        $request->userid = $user->id;
        $request->bookid = $_POST['bookid'];
        $request->text = $_POST['ulasan'];
        $request->rating = $_POST['rating'];

        try {
            $this->ulasanService->create($request);
            View::redirect("/ulasan");
        } catch (ValidationException $exception) {
            View::render("Admin/tambahUlasan", [
                'title' => 'Tambah Ulasan | Perpustakaan Digital',
                'error' => $exception,
                'userid' => $user->id,
                'books' => $books,
                'ulasan' => $ulasan,
            ]);
        }
    }

    public function comment(string $bookid)
    {
        session_start();
        $userid = $_SESSION['id_user'];
        $user = $this->userRepository->findById($userid);

        $book = $this->bookService->findById($bookid);

        $request = new UlasanCreateRequest();
        $request->userid = $user->id;
        $request->bookid = $book->id;
        $request->text = $_POST['text'];
        $request->rating = $_POST['rating'];

        try {
            $this->ulasanService->create($request);
            View::redirect("/book/$book->id");
        } catch (ValidationException $exception) {
            View::redirect("/");
        }
    }

    public function update(string $id)
    {
        $ulasanid = (int)$id;
        $ulasan = $this->ulasanRepository->findById($ulasanid);

        $books = $this->bookService->findAll();

        View::render('Admin/updateUlasan', [
            'title' => 'Update Ulasan | Perpustakaan Digital',
            'books' => $books,
            'ulasan' => [
                'id' => $ulasan->id,
                'userid' => $ulasan->userid,
                'username' => $ulasan->username,
                'bookid' => $ulasan->bookid,
                'title' => $ulasan->title,
                'text' => $ulasan->text,
                'rating' => $ulasan->rating
            ]
        ]);
    }

    public function postUpdate(string $id)
    {
        $ulasanid = (int)$id;
        $ulasan = $this->ulasanRepository->findById($ulasanid);

        $books = $this->bookService->findAll();

        $request = new UlasanUpdateRequest();
        $request->id = $ulasan->id;
        $request->userid = $ulasan->userid;
        $request->bookid = $ulasan->bookid;
        $request->text = $_POST['text'];
        $request->rating = $_POST['rating'];

        try {
            $this->ulasanService->update($request);
            View::redirect("/ulasan");
        } catch (ValidationException $exception) {
            View::render("Admin/updateUlasan", [
                'title' => 'Update Ulasan | Perpustakaan Digital',
                'books' => $books,
                'error' => $exception->getMessage(),
                'ulasan' => [
                    'id' => $ulasan->id,
                    'userid' => $ulasan->userid,
                    'username' => $ulasan->username,
                    'bookid' => $ulasan->bookid,
                    'title' => $ulasan->title,
                    'text' => $ulasan->text,
                    'rating' => $ulasan->rating
                ],
            ]);
        }
    }

    public function findAll()
    {
        $userid = $_SESSION['id_user'];
        $ulasan = $this->ulasanService->findByUserId($userid);
        $ulasans = $this->ulasanService->findAll();
        View::render("Admin/ulasan", [
            'title' => 'Ulasan Buku | Perpustakaan Digital',
            'datas' => $ulasans,
            'data' => $ulasan
        ]);
    }

    public function delete(string $id)
    {
        $ulasanid = (int)$id;
        $this->ulasanService->delete($ulasanid);
        View::redirect("/ulasan");
    }
}