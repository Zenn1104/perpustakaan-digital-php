<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Controller;

use BasoMAlif\PerpustakaanDigitalUkk\App\View;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\PeminjamanCreateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\PengembalianRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\PeminjamanRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Service\PeminjamanService;

class PeminjamanController
{
    private PeminjamanRepository $peminjamanRepository;
    private PeminjamanService $peminjamanService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->peminjamanRepository = new PeminjamanRepository($connection);
        $this->peminjamanService = new PeminjamanService($this->peminjamanRepository);
    }

    public function peminjaman(string $userId, string $bookId)
    {
        $userid = (int)$userId;
        $bookid = (int)$bookId;

        $peminjaman = new PeminjamanCreateRequest();
        $peminjaman->userId = $userid;
        $peminjaman->bookId = $bookid;

        try{
            $this->peminjamanService->pinjam($peminjaman);
            View::redirect("/peminjaman");
        } catch (ValidationException $exception) {
            View::redirect("/");
        }
    }

    public function pengembalian(string $peminjamanId)
    {
        $peminjamanid = (int)$peminjamanId;
        $pengembalian = new PengembalianRequest();
        $pengembalian->id = $peminjamanid;
        $this->peminjamanService->pengembalian($pengembalian);
        View::redirect("/peminjaman");
    }

    public function findAll()
    {
        $userid = $_SESSION['id_user'];
        $data = $this->peminjamanService->findByUserId($userid);
        $datas = $this->peminjamanService->findAll();
        View::render("Admin/Peminjaman" , [
            'title' => 'Data Peminjaman | Perpustakaan Digital',
            'datas' => $datas ?? '',
            'data' => $data ?? ''
        ]);
    }

    public function laporan()
    {
        $datas = $this->peminjamanService->findAll();
        View::render("Admin/laporan" , [
            'title' => 'Laporan Data Peminjaman | Perpustakaan Digital',
            'datas' => $datas
        ]);
    }

    public function cetak()
    {
        $datas = $this->peminjamanService->findAll();
        View::render("Admin/cetakLaporan" , [
            'title' => 'Laporan Data Peminjaman | Perpustakaan Digital',
            'datas' => $datas
        ]);
    }
}