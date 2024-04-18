<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Service;

use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\User;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UserCreateOrUpdateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UserCreateOrUpdateResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UserLoginRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UserLoginResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Model\UserUpdateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(UserCreateOrUpdateRequest $request): UserCreateOrUpdateResponse
    {
        $this->validateUserCreateRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException("username telah digunakan!");
            }

            $user = new User();
            $user->username = $request->username;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);
            $user->email = $request->email;
            $user->alamat = $request->alamat;
            $user->level = $request->level;

            $this->userRepository->save($user);

            $res = new UserCreateOrUpdateResponse();
            $res->user = $user;

            Database::commitTransaction();
            return $res;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
        
    }

    private function validateUserCreateRequest(UserCreateOrUpdateRequest $request)
    {
        if ($request->username == null || $request->password == null || $request->email == null || trim($request->username) == "" || trim($request->password) == "" || trim($request->email) == "") {
            throw new ValidationException("username, password, dan email tidak boleh kosong!");
        }
    }

    public function login(UserLoginRequest $request) : UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findByUsername($request->username);
        if ($user == null) {
            throw new ValidationException("Username atau Password salah");
        }

        if (password_verify($request->password, $user->password)) {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        } else {
            throw new ValidationException("Username atau Password salah");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request) 
    {
        if ($request->username == null || $request->password == null || trim($request->username) == "" || trim($request->password) == "") {
         throw new ValidationException("username, password tidak boleh kosong!");   
        }
    }

    public function findAll()
    {
        return $this->userRepository->findAll();
    }

    public function update(UserUpdateRequest $request) : UserCreateOrUpdateResponse
    {
        $this->validateUserUpdateRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findById($request->id);
            if($user == null) {
                throw new ValidationException("User tidak ditemukan!");
            }

            
            $fieldsToUpdate = ['username', 'password', 'email', 'alamat', 'level'];
            foreach ($fieldsToUpdate as $field) {
                if (!empty(trim($request->$field))) {
                    $user->$field = $field === 'password' ? password_hash($request->$field, PASSWORD_BCRYPT) : $request->$field;
                }
            }
            
            $this->userRepository->update($user);
            

            Database::commitTransaction();

            $response = new UserCreateOrUpdateResponse();
            $response->user = $user;
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }


    }

    private function validateUserUpdateRequest(UserUpdateRequest $request)
    {
        if ($request->username == null || $request->password == null || $request->email == null || trim($request->username) == "" || trim($request->password) == "" || trim($request->email) == "") {
            throw new ValidationException("username, password, dan email tidak boleh kosong!");
        }
    }

    public function delete(string $id): void
    {
        $user = $this->userRepository->findById($id);
        if ($user == null) {
            throw new ValidationException("User tidak ditemukan");
        }
        $this->userRepository->deleteById($user->id);
    }
}