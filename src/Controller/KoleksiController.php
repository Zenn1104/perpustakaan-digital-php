<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Controller;
use BasoMAlif\PerpustakaanDigitalUkk\App\View;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\KoleksiCreateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\BookRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\KoleksiRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\UserRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Service\KoleksiService;

class KoleksiController
{
    private KoleksiRepository $koleksiRepository;
    private UserRepository $userRepository;
    private BookRepository $bookRepository;
    private KoleksiService $koleksiService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->koleksiRepository = new KoleksiRepository($connection);
        $this->userRepository = new UserRepository($connection);
        $this->bookRepository = new BookRepository($connection);
        $this->koleksiService = new KoleksiService($this->koleksiRepository);
    }

    public function create(string $bookid)
    {
        $userid = $_SESSION['id_user'];
        $bookId = (int)$bookid;

        $user = $this->userRepository->findById($userid);
        $book = $this->bookRepository->findById($bookId);

        $request = new KoleksiCreateRequest();
        $request->userId = $user->id;
        $request->bookId = $book->id;

        try{
            $this->koleksiService->create($request);
            View::redirect("/koleksi");
        } catch (ValidationException $exception) {
            View::redirect("/error");
        }
    }

    public function findAll() 
    {
        $userid = $_SESSION['id_user'];
        
        $koleksis = $this->koleksiService->findAll($userid);
        View::render("Admin/koleksi", [
            'title' => 'Koleksi Buku | Perpustakaan Digital',
            'koleksis' => $koleksis
        ]);
    }

    public function delete(string $koleksiid)
    {
        $koleksiId = (int)$koleksiid;
        
        try{
            $this->koleksiService->delete($koleksiId);
            View::redirect("/koleksi");
        } catch (ValidationException $exception) {
            View::redirect("/error");
        }
    }
}