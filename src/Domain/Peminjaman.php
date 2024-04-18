<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Domain;

class Peminjaman
{
    public int $id;
    public ?int $userId = null;
    public ?string $username = null;
    public ?int $bookId = null;
    public ?string $title = null;
    public ?string $tanggalPeminjaman = null;
    public ?string $tanggalPengembalian = null;
    public ?string $statusPeminjaman = null;
}