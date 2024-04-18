<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Service;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\Peminjaman;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\PeminjamanCreateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\PeminjamanCreateResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Model\PengembalianRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\PengembalianResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\PeminjamanRepository;

class PeminjamanService
{
    private PeminjamanRepository $peminjamanRepository;

    public function __construct(PeminjamanRepository $peminjamanRepository)
    {
        $this->peminjamanRepository = $peminjamanRepository;
    }

    public function pinjam(PeminjamanCreateRequest $request) : PeminjamanCreateResponse
    {
        $this->ValidatePeminjamanRequest($request);

        try {
            Database::beginTransaction();

            $tanggal = date("Y-m-d");
            $peminjaman = new Peminjaman();
            $peminjaman->userId = $request->userId;
            $peminjaman->bookId = $request->bookId;
            $peminjaman->tanggalPeminjaman = $tanggal;
            $peminjaman->tanggalPengembalian = date("Y-m-d", strtotime($tanggal . " +7 days"));
            $peminjaman->statusPeminjaman = "Dipinjam";

            $this->peminjamanRepository->save($peminjaman);

            $res = new PeminjamanCreateResponse();
            $res->peminjaman = $peminjaman;

            Database::commitTransaction();
            return $res;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function ValidatePeminjamanRequest(PeminjamanCreateRequest $request)
    {
        if ($request->userId == null || $request->bookId == null || trim($request->userId) == "" || trim($request->bookId) == "") {
            throw new ValidationException("User ID or Book ID tidak boleh kosong!");
        }
    }

    public function pengembalian(PengembalianRequest $request): PengembalianResponse
    {
        $this->ValidatePengembalianRequest($request);

        try{
            Database::beginTransaction();

            $tanggal = date("Y-m-d");
            $peminjaman = $this->peminjamanRepository->findById($request->id);
            if ($peminjaman->tanggalPengembalian < $tanggal) {
                $peminjaman->statusPeminjaman = "Didenda";
            } else {
                $peminjaman->statusPeminjaman = "Dikembalikan";
            }

            $this->peminjamanRepository->update($peminjaman);

            $res = new PengembalianResponse();
            $res->pengembalian = $peminjaman;

            Database::commitTransaction();
            return $res;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function ValidatePengembalianRequest(PengembalianRequest $request)
    {
        if ($request->id == null || trim($request->id) == ""){
            throw new ValidationException("Id tidak boleh kosong!");
        }
    }

    public function findAll() : array
    {
        return $this->peminjamanRepository->findAll();
    }

    public function findByUserId(string $userid) : ?array
    {
        return $this->peminjamanRepository->findByUserId($userid);
    }

    public function delete(string $id): void
    {
        $peminjaman = $this->peminjamanRepository->findById($id);
        if ($peminjaman == null) {
            throw new ValidationException("Peminjaman tidak ditemukan");
        }
        $this->peminjamanRepository->delete($peminjaman->id);
    }
}