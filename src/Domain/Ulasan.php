<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Domain;

class Ulasan
{
    public int $id;
    public ?int $userid = null;
    public ?string $username = null;
    public ?int $bookid = null;
    public ?string $title = null;
    public ?string $text = null;
    public ?string $rating = null;
}