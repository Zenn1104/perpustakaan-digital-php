<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Model;

class BookUpdateRequest
{
    public ?int $id = null;
    public ?int $idCategory = null;
    public ?string $title = null; 
    public ?string $penulis = null;
    public ?string $penerbit = null;
    public ?string $tahunTerbit = null;
    public ?string $deskripsi = null;   
}