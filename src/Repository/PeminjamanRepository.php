<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Repository;

use BasoMAlif\PerpustakaanDigitalUkk\Domain\Peminjaman;

class PeminjamanRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Peminjaman $peminjaman): Peminjaman
    {
        $statement = $this->connection->prepare("INSERT INTO peminjaman (BukuID, id_user, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) VALUES (?, ?, ?, ?, ?)");
        $statement->execute([
            $peminjaman->bookId,
            $peminjaman->userId,
            $peminjaman->tanggalPeminjaman,
            $peminjaman->tanggalPengembalian,
            $peminjaman->statusPeminjaman
        ]);
        return $peminjaman;
    }

    public function update(Peminjaman $peminjaman): Peminjaman
    {
        $statement = $this->connection->prepare("UPDATE peminjaman SET BukuID= ? , TanggalPeminjaman= ? , TanggalPengembalian = ?, StatusPeminjaman= ? WHERE PeminjamanID = ? ");
        $statement->execute([
            $peminjaman->bookId,
            $peminjaman->tanggalPeminjaman,
            $peminjaman->tanggalPengembalian,
            $peminjaman->statusPeminjaman,
            $peminjaman->id
        ]);
        return $peminjaman;
    }

    public function findById(string $id) : ?Peminjaman
    {
        $statement = $this->connection->prepare("SELECT * FROM peminjaman WHERE PeminjamanID = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()){
                $peminjaman = new Peminjaman();
                $peminjaman->id = $row['PeminjamanID'];
                $peminjaman->userId = $row['id_user'];
                $peminjaman->bookId = $row['BukuID'];
                $peminjaman->tanggalPeminjaman = $row['TanggalPeminjaman'];
                $peminjaman->tanggalPengembalian = $row['TanggalPengembalian'];
                $peminjaman->statusPeminjaman = $row['StatusPeminjaman'];
                return $peminjaman;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll() : array
    {
        $peminjamans = [];
        $statement = $this->connection->prepare("SELECT * FROM peminjaman 
                                                LEFT JOIN buku ON buku.BukuID = peminjaman.BukuID
                                                 LEFT JOIN user ON user.id_user = peminjaman.id_user
                                                ");
        $statement->execute();

        try {
            while ($row = $statement->fetch()) {
                $peminjaman = new Peminjaman();
                $peminjaman->id = $row['PeminjamanID'];
                $peminjaman->userId = $row['id_user'];
                $peminjaman->username = $row['Username'];
                $peminjaman->bookId = $row['BukuID'];
                $peminjaman->title = $row['Judul'];
                $peminjaman->tanggalPeminjaman = $row['TanggalPeminjaman'];
                $peminjaman->tanggalPengembalian = $row['TanggalPengembalian'];
                $peminjaman->statusPeminjaman = $row['StatusPeminjaman'];
                $peminjamans[] = $peminjaman;
            }
        } finally {
            $statement->closeCursor();
        }
        return $peminjamans;
    }

    public function findByUserId(string $userid) : ?array
    {
        $peminjamans = [];
        $statement = $this->connection->prepare("SELECT * FROM peminjaman 
                                                 LEFT JOIN user ON user.id_user = peminjaman.id_user
                                                LEFT JOIN buku ON buku.BukuID = peminjaman.BukuID WHERE user.id_user = ?");
        $statement->execute([$userid]);

        try {
            while ($row = $statement->fetch()) {
                $peminjaman = new Peminjaman();
                $peminjaman->id = $row['PeminjamanID'];
                $peminjaman->userId = $row['id_user'];
                $peminjaman->username = $row['Username'];
                $peminjaman->bookId = $row['BukuID'];
                $peminjaman->title = $row['Judul'];
                $peminjaman->tanggalPeminjaman = $row['TanggalPeminjaman'];
                $peminjaman->tanggalPengembalian = $row['TanggalPengembalian'];
                $peminjaman->statusPeminjaman = $row['StatusPeminjaman'];
                $peminjamans[] = $peminjaman;
            }
        } finally {
            $statement->closeCursor();
        }
        return $peminjamans;
    }

    public function delete(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM peminjaman WHERE PeminjamanID = ?");
        $statement->execute([$id]);
    }
}