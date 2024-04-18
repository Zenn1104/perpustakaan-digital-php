<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Config;

class Database 
{
    // membuat variable php data object agar dapat satu hal yang sama terus menerus dengan default null
    private static ?\PDO $pdo = null;

    // method class untuk membuat pdo tergantung dari parameter env 
    public static function getConnection(string $env = "test") : \PDO 
    {
        if(self::$pdo == null) {
            // memanggil configuration dari file config di folder luar 
            require_once __DIR__ . '/../../config/database.php';
            // mengambil config database dari function get database config
            $config = getDatabaseConfig();
            // create new php data object
            self::$pdo = new \PDO (
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password']
            );
        }
        return self::$pdo;
    }

    public static function beginTransaction() 
    {
        self::$pdo->beginTransaction();
    }

    public static function commitTransaction()
    {
        self::$pdo->commit();
    }

    public static function rollbackTransaction()
    {
        self::$pdo->rollback();
    }
}