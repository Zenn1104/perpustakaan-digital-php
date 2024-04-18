<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Service;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\Koleksi;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\KoleksiCreateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\KoleksiResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\KoleksiRepository;

class KoleksiService
{
    private KoleksiRepository $koleksiRepository;

    public function __construct(KoleksiRepository $koleksiRepository)
    {
        $this->koleksiRepository = $koleksiRepository;
    }

    public function create(KoleksiCreateRequest $request): KoleksiResponse
    {
        $this->ValidateKoleksiCreateRequest($request);

        try{
            Database::beginTransaction();

            $koleksi = new Koleksi();
            $koleksi->userId = $request->userId;
            $koleksi->bookId = $request->bookId;

            $this->koleksiRepository->save($koleksi);

            $res = new KoleksiResponse();
            $res->koleksi = $koleksi;

            Database::commitTransaction();
            return $res;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function ValidateKoleksiCreateRequest(KoleksiCreateRequest $request)
    {
        if($request->userId == null || $request->bookId == null || trim($request->userId) == "" || trim($request->bookId) == "") {
            throw new ValidationException("UserId or BookId tidak boleh kosong!");
        }
    }

    public function findAll(string $userid): ?array
    {
            $koleksi = $this->koleksiRepository->findAll($userid);
            return $koleksi;
    }

    public function delete(string $koleksiid): void
    {
            $koleksi = $this->koleksiRepository->findById($koleksiid);
            $this->koleksiRepository->delete($koleksi->koleksiId);
    }
}