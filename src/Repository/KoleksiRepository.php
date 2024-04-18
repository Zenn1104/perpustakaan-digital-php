<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Repository;

use BasoMAlif\PerpustakaanDigitalUkk\Domain\Book;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\Koleksi;

class KoleksiRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Koleksi $koleksi): Koleksi
    {
        $statement = $this->connection->prepare("INSERT INTO `koleksibuku` (user_id, buku_id) VALUES(?,?)");
        $statement->execute([
            $koleksi->userId,
            $koleksi->bookId
        ]);
        return $koleksi;
    }

    public function findAll(string $userid): ?array
{
    $collections = [];
    $statement = $this->connection->prepare("SELECT * FROM koleksibuku LEFT JOIN buku ON koleksibuku.buku_id = buku.BukuID
                                             LEFT JOIN user ON koleksibuku.user_id = user.id_user
                                             WHERE koleksibuku.user_id = ?");
    $statement->execute([$userid]);

    try {
        while ($row = $statement->fetch()) {
            $koleksi = new Koleksi();
            $koleksi->koleksiId = $row['koleksi_id'];
            $koleksi->userId = $row['user_id'];
            $koleksi->bookId = $row['buku_id'];
            $koleksi->username = $row['Username'];
            $koleksi->title = $row['Judul'];
            $koleksi->penulis = $row['Penulis'];
            $koleksi->penerbit = $row['Penerbit'];
            $koleksi->deskripsi = $row['Deskripsi'];
            $collections[] = $koleksi;
        }
    } finally {
        $statement->closeCursor();
    }

    return $collections;
}


    public function findById(string $koleksiid) : ?Koleksi
    {
        $statement = $this->connection->prepare("SELECT * FROM `koleksibuku` 
                                                 LEFT JOIN `user` ON `koleksibuku`.`user_id` = `user`.`id_user` 
                                                 LEFT JOIN `buku` ON `koleksibuku`.`buku_id` = `buku`.`BukuID`
                                                 WHERE `koleksibuku`.`koleksi_id` = ?");
        $statement->execute([$koleksiid]);

        try {
            if ($row = $statement->fetch()) {
                $koleksi = new Koleksi();
                $koleksi->koleksiId = $row['koleksi_id'];
                $koleksi->userId = $row['user_id'];
                $koleksi->bookId = $row['buku_id'];
                $koleksi->username = $row['Username'];
                $koleksi->title = $row['Judul'];
                $koleksi->penerbit = $row['Penerbit'];
                $koleksi->deskripsi = $row['Deskripsi'];
                return $koleksi;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(string $koleksiid): void
    {
        $statement = $this->connection->prepare("DELETE FROM koleksibuku WHERE koleksi_id = ?");
        $statement->execute([$koleksiid]);
    }
}