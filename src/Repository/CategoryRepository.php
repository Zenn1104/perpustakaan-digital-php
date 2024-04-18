<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Repository;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\Category;

class CategoryRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Category $category) : Category
    {
        $statement = $this->connection->prepare("INSERT INTO kategoribuku (NamaKategori) VALUES (?)");
        $statement->execute([
            $category->name
        ]);
        return $category;
    }

    public function update(Category $category) : Category
    {
        $statement = $this->connection->prepare("UPDATE kategoribuku SET NamaKategori = ? WHERE id_kategori = ? ");
        $statement->execute([
            $category->name,
            $category->id
        ]);
        return $category;
    }

    public function findById(string $id) : ?Category
    {
        $statement = $this->connection->prepare("SELECT * FROM kategoribuku WHERE id_kategori = ?");
        $statement->execute([
            $id
        ]);

        try{
            if ($row = $statement->fetch()) {
                $category = new Category();
                $category->id = $row['id_kategori'];
                $category->name = $row['NamaKategori'];
                return $category;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }        
    }

    public function findAll(): array
    {
        $categories = [];
        $statement = $this->connection->prepare("SELECT * FROM `kategoribuku`");
        $statement->execute();

        try{
            while ($row = $statement->fetch()) {
                $category = new Category();
                $category->id = $row['id_kategori'];
                $category->name = $row['NamaKategori'];
                $categories[] = $category;
            }
        } finally {
            $statement->closeCursor();
        }
        return $categories;
    }

    public function delete(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM kategoribuku WHERE id_kategori = ?");
        $statement->execute([
            $id
        ]);
    }
}