<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Service;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\Book;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\BookCreateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\BookCreateResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Model\BookUpdateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\BookUpdateResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\BookRepository;

class BookService
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
    
    public function create(BookCreateRequest $request) : BookCreateResponse
    {
        $this->ValidateCreateRequest($request);

        try{
            Database::beginTransaction();

            $book = new Book();
            $book->idCategory = $request->idCategory;
            $book->title = $request->title;
            $book->penulis = $request->penulis;
            $book->penerbit = $request->penerbit;
            $book->tahunTerbit = $request->tahunTerbit;
            $book->deskripsi = $request->deskripsi;

            $this->bookRepository->save($book);

            $res = new BookCreateResponse();
            $res->book = $book;

            Database::commitTransaction();
            return $res;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function ValidateCreateRequest(BookCreateRequest $request) 
    {
        if($request->idCategory == null || $request->title == null || $request->tahunTerbit == null || trim($request->idCategory) == "" || trim($request->title) == "") {
            throw new ValidationException("Category, Title, Tahun Terbit tidak boleh kosong!");
        }
    }

    public function update(BookUpdateRequest $request): BookUpdateResponse 
    {
        $this->ValidateUpdateRequest($request);

        try{
            Database::beginTransaction();
            $book = $this->bookRepository->findById($request->id);
            if ($book == null) {
                throw new ValidationException("Buku tidak ditemukan!");
            }

            $book->idCategory = $request->idCategory;
            $book->title = $request->title;
            $book->penulis = $request->penulis;
            $book->penerbit = $request->penerbit;
            $book->tahunTerbit = $request->tahunTerbit;
            $book->deskripsi = $request->deskripsi;

            $this->bookRepository->update($book);

            $res = new BookUpdateResponse();
            $res->book = $book;

            Database::commitTransaction();
            return $res;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function ValidateUpdateRequest(BookUpdateRequest $request)
    {
        if($request->idCategory == null || $request->title == null || $request->tahunTerbit == null || trim($request->idCategory) == "" || trim($request->title) == "") {
            throw new ValidationException("Category, Title, Tahun Terbit tidak boleh kosong!");
        }
    }

    public function findAll() : array
    {
        try {
            return $this->bookRepository->findAll();
        } catch (\Exception $exception) {
            return throw $exception;
        }
    }

    public function findById(string $bookid) 
    {
        return $this->bookRepository->findById($bookid);
    }

    public function delete(string $id) : void
    {
            $book = $this->bookRepository->findById($id);
            if ($book == null) {
                throw new ValidationException("Buku tidak ditemukan!");
            }
            $this->bookRepository->delete($book->id);   
    }
}