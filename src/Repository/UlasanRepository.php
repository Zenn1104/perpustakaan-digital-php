<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Repository;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\Ulasan;

class UlasanRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Ulasan $ulasan) : Ulasan
    {
        $statement = $this->connection->prepare("INSERT INTO ulasanbuku (BukuID, id_user, Ulasan, Rating) VALUES (?, ?, ?, ?)");
        $statement->execute([
            $ulasan->bookid,
            $ulasan->userid,
            $ulasan->text,
            $ulasan->rating
        ]);
        return $ulasan;
    }

    public function update(Ulasan $ulasan) : Ulasan
    {
        $statement = $this->connection->prepare("UPDATE `ulasanbuku` SET `Ulasan` = ? , `Rating` = ? WHERE `BukuID` = ? AND `id_user` = ? ");
        $statement->execute([
            $ulasan->text,
            $ulasan->rating,
            $ulasan->bookid,
            $ulasan->userid
        ]);
        return $ulasan;
    }

    public function findById(string $id) : ?Ulasan
    {
        $statement = $this->connection->prepare("SELECT * FROM ulasanbuku
                                                 LEFT JOIN user ON user.id_user = ulasanbuku.id_user 
                                                 LEFT JOIN buku ON buku.BukuID = ulasanbuku.BukuID WHERE UlasanID = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $ulasan = new Ulasan();
                $ulasan->id = $row['UlasanID'];
                $ulasan->userid = $row['id_user'];
                $ulasan->username = $row['Username'];
                $ulasan->bookid = $row['BukuID'];
                $ulasan->title = $row['Judul'];
                $ulasan->text = $row['Ulasan'];
                $ulasan->rating = $row['Rating'];
                return $ulasan;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll() : array
    {
        $ulasans = [];
        $statement = $this->connection->prepare("SELECT * FROM ulasanbuku
                                                 LEFT JOIN user ON user.id_user = ulasanbuku.id_user 
                                                 LEFT JOIN buku ON buku.BukuID = ulasanbuku.BukuID");
        $statement->execute();

        try {
            while ($row = $statement->fetch()) {
                $ulasan = new Ulasan();
                $ulasan->id = $row['UlasanID'];
                $ulasan->userid = $row['id_user'];
                $ulasan->username = $row['Username'];
                $ulasan->bookid = $row['BukuID'];
                $ulasan->title = $row['Judul'];
                $ulasan->text = $row['Ulasan'];
                $ulasan->rating = $row['Rating'];
                $ulasans[] = $ulasan;
            }
        } finally {
            $statement->closeCursor();
        }
        return $ulasans;
    }

    public function findByUserId(string $userid) : ?array
    {
        $ulasans = [];
        $statement = $this->connection->prepare("SELECT * FROM ulasanbuku
                                                 LEFT JOIN user ON user.id_user = ulasanbuku.id_user 
                                                 LEFT JOIN buku ON buku.BukuID = ulasanbuku.BukuID WHERE user.id_user = ?");
        $statement->execute([$userid]);

        try {
            while ($row = $statement->fetch()) {
                $ulasan = new Ulasan();
                $ulasan->id = $row['UlasanID'];
                $ulasan->userid = $row['id_user'];
                $ulasan->username = $row['Username'];
                $ulasan->bookid = $row['BukuID'];
                $ulasan->title = $row['Judul'];
                $ulasan->text = $row['Ulasan'];
                $ulasan->rating = $row['Rating'];
                $ulasans[] = $ulasan;
            }
        } finally {
            $statement->closeCursor();
        }
        return $ulasans;
    }


    public function findByBookId(string $bookid) : ?array
    {
        $ulasans = [];
        $statement = $this->connection->prepare("SELECT * FROM ulasanbuku
                                                 LEFT JOIN user ON user.id_user = ulasanbuku.id_user 
                                                 LEFT JOIN buku ON buku.BukuID = ulasanbuku.BukuID WHERE buku.BukuID = ?");
        $statement->execute([$bookid]);

        try {
            while ($row = $statement->fetch()) {
                $ulasan = new Ulasan();
                $ulasan->id = $row['UlasanID'];
                $ulasan->userid = $row['id_user'];
                $ulasan->username = $row['Username'];
                $ulasan->bookid = $row['BukuID'];
                $ulasan->title = $row['Judul'];
                $ulasan->text = $row['Ulasan'];
                $ulasan->rating = $row['Rating'];
                $ulasans[] = $ulasan;
            }
        } finally {
            $statement->closeCursor();
        }
        return $ulasans;
    }

    public function delete(string $id) : void
    {
        $statement = $this->connection->prepare("DELETE FROM ulasanbuku WHERE UlasanID = ? ");
        $statement->execute([$id]);
    }
}