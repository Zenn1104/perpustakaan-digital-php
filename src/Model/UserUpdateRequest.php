<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Model;

class UserUpdateRequest 
{
    public ?int $id = null;
    public ?string $username = null;    
    public ?string $password = null;    
    public ?string $email = null;
    public ?string $alamat = null;
    public ?string $level = null;
}