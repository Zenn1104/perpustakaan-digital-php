<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Model;

class UserCreateOrUpdateRequest 
{
    public ?string $username = null;    
    public ?string $password = null;    
    public ?string $email = null;
    public ?string $alamat = null;
    public ?string $level = null;
}