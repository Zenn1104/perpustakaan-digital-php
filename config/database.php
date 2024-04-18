<?php

// function untuk mendapatkan configuration database yang membalikkan data berupa array
function getDatabaseConfig() : array 
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=db_perpustakaan_baso_alif_test",
                "username" => "root",
                "password" => ""
            ],
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=db_perpustakaan_baso_alif",
                "username" => "root",
                "password" => ""
            ]
        ]
    ];
}