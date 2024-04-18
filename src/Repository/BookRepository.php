<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Repository;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\Book;

class BookRepository 
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Book $book) : Book
    {
        $statement = $this->connection->prepare("INSERT INTO buku (id_kategori, Judul, Penulis, Penerbit, TahunTerbit, Deskripsi) VALUES (?,?,?,?,?,?)");
        $statement->execute([
            $book->idCategory,
            $book->title,
            $book->penulis,
            $book->penerbit,
            $book->tahunTerbit,
            $book->deskripsi
        ]);
        return $book;
    }

    public function update(Book $book): Book
    {
        $statement = $this->connection->prepare("UPDATE `buku` SET `id_kategori` = ?, `Judul` = ?, `Penulis` = ?, Penerbit = ?, `TahunTerbit` = ?, `Deskripsi` = ? WHERE `buku`.`BukuID` = ? ");
        $statement->execute([
            $book->idCategory,
            $book->title,
            $book->penulis,
            $book->penerbit,
            $book->tahunTerbit,
            $book->deskripsi,
            $book->id
        ]);
        return $book;
    }

    public function findById(string $id): ?Book
    {
        $statement = $this->connection->prepare("SELECT * FROM buku WHERE BukuID = ?");
        $statement->execute([$id]);

        try{
            if ($row = $statement->fetch()) {
                $book = new Book();
                $book->id = $row['BukuID'];
                $book->idCategory = $row['id_kategori'];
                $book->title = $row['Judul'];
                $book->penulis = $row['Penulis'];
                $book->penerbit = $row['Penerbit'];
                $book->tahunTerbit = $row['TahunTerbit'];
                $book->deskripsi = $row['Deskripsi'];
                return $book;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(): array
    {
        $books = [];
        $statement = $this->connection->prepare("SELECT * FROM `buku` LEFT 
        JOIN `kategoribuku` ON `buku`.`id_kategori` = `kategoribuku`.`id_kategori`");
        $statement->execute();

        try {
            while ($row = $statement->fetch()) {
                $book = new Book();
                $book->id = $row['BukuID'];
                $book->idCategory = $row['id_kategori'];
                $book->title = $row['Judul'];
                $book->penulis = $row['Penulis'];
                $book->penerbit = $row['Penerbit'];
                $book->tahunTerbit = $row['TahunTerbit'];
                $book->deskripsi = $row['Deskripsi'];
                $books[] = $book;
            }
        } finally {
            $statement->closeCursor();
        }

        return $books;
    }

    public function delete(string $id) : void
    {
        $statement = $this->connection->prepare("DELETE FROM buku WHERE buku.BukuID = ?");
        $statement->execute([$id]);
    }
}