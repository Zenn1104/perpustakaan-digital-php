<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Domain;

use BasoMAlif\PerpustakaanDigitalUkk\Domain\Book;

class Koleksi
{
    public int $koleksiId;
    public int $userId;
    public string $username;
    public int $bookId;
    public string $title;
    public string $penerbit;
    public string $deskripsi;
}