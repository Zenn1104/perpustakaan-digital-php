<?php

require_once __DIR__ . '/../vendor/autoload.php';

use BasoMAlif\PerpustakaanDigitalUkk\App\Router;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Controller\BookController;
use BasoMAlif\PerpustakaanDigitalUkk\Controller\CategoryController;
use BasoMAlif\PerpustakaanDigitalUkk\Controller\HomeController;
use BasoMAlif\PerpustakaanDigitalUkk\Controller\KoleksiController;
use BasoMAlif\PerpustakaanDigitalUkk\Controller\PeminjamanController;
use BasoMAlif\PerpustakaanDigitalUkk\Controller\UserController;
use BasoMAlif\PerpustakaanDigitalUkk\Controller\UlasanController;
use BasoMAlif\PerpustakaanDigitalUkk\Middleware\MustEmployeMiddleware;
use BasoMAlif\PerpustakaanDigitalUkk\Middleware\MustLoginMiddleware;
use BasoMAlif\PerpustakaanDigitalUkk\Middleware\MustNotEmployeMiddleware;
use BasoMAlif\PerpustakaanDigitalUkk\Middleware\MustNotLoginMiddleware;

Database::getConnection('prod');

// Dashboard routing
Router::add('GET', '/', HomeController::class, 'index', [MustLoginMiddleware::class]);

// user routing
Router::add('GET', '/users/register', UserController::class, 'register', []);
Router::add('POST', '/users/register', UserController::class, 'postRegister', []);
Router::add('GET', '/users/tambah', UserController::class, 'create', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('POST', '/users/tambah', UserController::class, 'postCreate', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/users/login', UserController::class, 'login', []);
Router::add('POST', '/users/login', UserController::class, 'postLogin', []);
Router::add('GET', '/users', UserController::class, 'findAll', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/users/update/:id_user', UserController::class, 'update', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('POST', '/users/update/:id_user', UserController::class, 'postUpdate', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/users/delete/:id_user', UserController::class, 'delete', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/users/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);

// category routing
Router::add('GET', '/category/add', CategoryController::class, 'create', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('POST', '/category/add', CategoryController::class, 'postCreate', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/category', CategoryController::class, 'findAll', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/category/update/:id', CategoryController::class, 'update', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('POST', '/category/update/:id', CategoryController::class, 'postUpdate', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/category/delete/:id', CategoryController::class, 'delete', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);

// book routing
Router::add('GET', '/book/tambah', BookController::class, 'create', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('POST', '/book/tambah', BookController::class, 'postCreate', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/book/update/:id', BookController::class, 'update', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('POST', '/book/update/:id', BookController::class, 'postUpdate', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/book', BookController::class, 'findAll', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/book/:id', BookController::class, 'findById', [MustLoginMiddleware::class]);
Router::add('GET', '/book/delete/:id', BookController::class, 'delete', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);

// peminjaman routing
Router::add('GET', '/peminjaman', PeminjamanController::class, 'findAll', [MustLoginMiddleware::class]);
Router::add('GET', '/peminjaman/user/:userId/buku/:bookId', PeminjamanController::class, 'peminjaman', [MustLoginMiddleware::class, MustNotEmployeMiddleware::class]);
Router::add('GET', '/pengembalian/:peminjamanId', PeminjamanController::class, 'pengembalian', [MustLoginMiddleware::class, MustNotEmployeMiddleware::class]);

// ulasan routing
Router::add('GET', '/ulasan/add', UlasanController::class, 'create', [MustLoginMiddleware::class]);
Router::add('POST', '/ulasan/add', UlasanController::class, 'postCreate', [MustLoginMiddleware::class]);
Router::add('POST', '/ulasan/buku/:bukuid', UlasanController::class, 'comment', [MustLoginMiddleware::class]);
Router::add('GET', '/ulasan', UlasanController::class, 'findAll', [MustLoginMiddleware::class]);
Router::add('GET', '/ulasan/update/:id', UlasanController::class, 'update', [MustLoginMiddleware::class]);
Router::add('POST', '/ulasan/update/:id', UlasanController::class, 'postUpdate', [MustLoginMiddleware::class]);
Router::add('GET', '/ulasan/delete/:id', UlasanController::class, 'delete', [MustLoginMiddleware::class]);

// koleksi buku routing
Router::add('GET', '/koleksi/add/buku/:bukuid', KoleksiController::class, 'create', [MustLoginMiddleware::class]);
Router::add('GET', '/koleksi', KoleksiController::class, 'findAll', [MustLoginMiddleware::class]);
Router::add('GET', '/koleksi/delete/:koleksiId', KoleksiController::class, 'delete', [MustLoginMiddleware::class]);


// laporan peminjaman routing
Router::add('GET', '/laporan', PeminjamanController::class, 'laporan', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);
Router::add('GET', '/cetak_laporan', PeminjamanController::class, 'cetak', [MustLoginMiddleware::class, MustEmployeMiddleware::class]);

Router::run();