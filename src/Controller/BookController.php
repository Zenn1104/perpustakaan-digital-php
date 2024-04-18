<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Controller;

use BasoMAlif\PerpustakaanDigitalUkk\App\View;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\BookCreateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\BookUpdateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\BookRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\CategoryRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\UlasanRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Service\BookService;
use BasoMAlif\PerpustakaanDigitalUkk\Service\UlasanService;

class BookController
{
    private BookService $bookService;
    private BookRepository $bookRepository;
    private CategoryRepository $categoryRepository;
    private UlasanRepository $ulasanRepository;
    private UlasanService $ulasanService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->categoryRepository = new CategoryRepository($connection);
        $this->bookRepository = new BookRepository($connection);
        $this->ulasanRepository = new UlasanRepository($connection);
        $this->bookService = new BookService($this->bookRepository);
        $this->ulasanService = new UlasanService($this->ulasanRepository);   
    }

    public function create()
    {
        $categories = $this->categoryRepository->findAll();
        View::render('Admin/tambahBuku', [
            'title' => 'Tambah Buku | Perpustakaan Digital',
            'categories' => $categories
        ]);
    }

    public function postCreate()
    {
        $categories = $this->categoryRepository->findAll();
        $request = new BookCreateRequest();
        $request->idCategory = $_POST['idCategory'];
        $request->title = $_POST['title'];
        $request->penulis = $_POST['penulis'];
        $request->penerbit = $_POST['penerbit'];
        $request->tahunTerbit = $_POST['tahunTerbit'];
        $request->deskripsi = $_POST['deskripsi'];

        try {
            $this->bookService->create($request);
            View::redirect("/book");
        } catch (ValidationException $exception) {
            View::render('Admin/tambahBuku', [
                'title' => 'Tambah Buku | Perpustakaan Digital',
                'categories' => $categories,
                'error' => $exception->getMessage()
            ]); 
        }
    }

    public function findAll()
    {
        $books = $this->bookService->findAll();
        $categories = [];
        foreach ($books as $book) {
            $category = $this->categoryRepository->findById($book->id);
            $categories[] = $category;
        }   
        try {
            View::render("Admin/book" , [
                'title' => 'Daftar Buku | Perpustakaan',
                'books' => $books,
                'category' => $categories
            ]);
        } catch (ValidationException $exception) {
            View::render("Admin/book" , [
                'title' => 'Daftar Buku | Perpustakaan',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function update(string $id)
    {
        $bookId = (int)$id;
        $book = $this->bookRepository->findById($bookId);
        $categories = $this->categoryRepository->findAll();
        $categoryid = $this->categoryRepository->findById($book->idCategory);

        View::render("Admin/updateBuku", [
            'title' => 'Update Buku | Perpustakaan Digital',
            'categories' => $categories,
            'categoryid' => $categoryid->name,
            'book' => [
                'id' => $book->id,
                'idCategory' => $book->idCategory,
                'title' => $book->title,
                'penulis' => $book->penulis,
                'penerbit' => $book->penerbit,
                'tahunTerbit' => $book->tahunTerbit,
                'deskripsi' => $book->deskripsi
            ]
        ]);
        
    }

    public function postUpdate(string $id)
    {
        $bookId = (int)$id;
        $book = $this->bookRepository->findById($bookId);
        $categories = $this->categoryRepository->findAll();
        $categoryid = $this->categoryRepository->findById($book->idCategory);

        $request = new BookUpdateRequest();
        $request->id = $book->id;
        $request->idCategory = $_POST['idCategory'];
        $request->title = $_POST['title'];
        $request->penulis = $_POST['penulis'];
        $request->penerbit = $_POST['penerbit'];
        $request->tahunTerbit = $_POST['tahunTerbit'];
        $request->deskripsi = $_POST['deskripsi'];

        try{
            $this->bookService->update($request);
            View::redirect("/book");
        } catch (ValidationException $exception) {
            View::render("admin/updateBuku", [
                'title' => 'Update Buku | Perpustakaan Digital',
                'categories' => $categories,
                'categoryid' => $categoryid->name,
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function findById(string $bookid) 
    {
        $userid = $_SESSION['id_user'];
        $book = $this->bookService->findByid($bookid);
        $ulasans = $this->ulasanService->findByBookId($book->id);
        View::render("Admin/bookbyid", [
            'userid' => $userid,
            'ulasans' => $ulasans,
            'book' => [
                'id' => $book->id,
                'title' => $book->title,
                'penulis' => $book->penulis,
                'penerbit' => $book->penerbit,
                'tahunTerbit' => $book->tahunTerbit,
                'deskripsi' => $book->deskripsi
            ]
        ]);
    }

    public function delete(string $id)
    {
        $bookId = (int)$id;
        $this->bookService->delete($bookId);
        View::redirect("/book");
    }
}