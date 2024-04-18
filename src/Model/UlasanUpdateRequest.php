<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Model;

class UlasanUpdateRequest
{
    public ?int $id = null;
    public ?int $userid = null;
    public ?int $bookid = null;
    public ?string $text = null;
    public ?string $rating = null;
}