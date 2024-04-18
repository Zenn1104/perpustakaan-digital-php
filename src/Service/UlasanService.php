<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Service;

use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\Ulasan;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UlasanCreateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UlasanCreateResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UlasanUpdateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UlasanUpdateResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\UlasanRepository;

class UlasanService
{
    private UlasanRepository $ulasanRepository;

    public function __construct(UlasanRepository $ulasanRepository)
    {
        $this->ulasanRepository = $ulasanRepository;
    }

    public function create(UlasanCreateRequest $request) : UlasanCreateResponse
    {
        $this->ValidateUlasanCreateRequest($request);

        try {
            Database::beginTransaction();

            $ulasan = new Ulasan();
            $ulasan->userid = $request->userid;
            $ulasan->bookid = $request->bookid;
            $ulasan->text = $request->text;
            $ulasan->rating = $request->rating;

            $this->ulasanRepository->save($ulasan);

            $res = new UlasanCreateResponse();
            $res->ulasan = $ulasan;

            Database::commitTransaction();
            return $res;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function ValidateUlasanCreateRequest(UlasanCreateRequest $request) 
    {
        if ($request->userid == null || $request->bookid == null || $request->text == null || $request->rating == null || trim($request->userid) == "" || trim($request->bookid) == "" || trim($request->text) == "" || trim($request->rating) == "") {
            throw new ValidationException("Ulasan dan rating tidak boleh kosong!");
        }
    }

    public function update(UlasanUpdateRequest $request) : UlasanUpdateResponse
    {
        $this->ValidateUlasanUpdateRequest($request);

        try{
            Database::beginTransaction();

            $ulasan = $this->ulasanRepository->findById($request->id);
            if ($ulasan == null) {
                throw new ValidationException("Ulasan tidak ditemukan");
            }

            $ulasan->text = $request->text;
            $ulasan->rating = $request->rating;

            $this->ulasanRepository->update($ulasan);

            $res = new UlasanUpdateResponse();
            $res->ulasan = $ulasan;

            Database::commitTransaction();
            return $res;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function ValidateUlasanUpdateRequest(UlasanUpdateRequest $request) 
    {
        if ($request->text == null || $request->rating == null || trim($request->text) == "" || trim($request->rating) == "") {
            throw new ValidationException("Ulasan dan rating tidak boleh kosong!");
        }
    }

    public function findAll() : array
    {
       return $this->ulasanRepository->findAll();
    }


    public function findByUserId(string $userid): ?array
    {
        return $this->ulasanRepository->findByUserId($userid);
    }

    public function findByBookId(string $bookid): ?array
    {
        return $this->ulasanRepository->findByBookId($bookid);
    }

    public function delete(string $id) : void
    {
        $ulasan = $this->ulasanRepository->findById($id);
        if ($ulasan == null) {
            throw new ValidationException("Ulasan tidak ditemukan!");
        }
        $this->ulasanRepository->delete($ulasan->id);
    }
}