<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Domain;

class Book 
{
    public int $id;
    public int $idCategory;
    public string $title;
    public string $penulis;
    public string $penerbit;
    public string $tahunTerbit;
    public string $deskripsi;
}